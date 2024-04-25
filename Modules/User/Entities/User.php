<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Garden\Entities\Garden;
use Modules\Garden\Entities\HasGarden;
use Modules\Group\Entities\Group;
use Webmozart\Assert\Assert;
use Illuminate\Support\Str;
use Modules\Gallery\Entities\Gallery;
use Modules\Garden\Entities\Absent;
use Modules\Notification\Entities\Notification;
use Modules\Payment\Entities\Payment;

class User extends Authenticatable implements HasGarden
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'username',
        'password',
        'withdraw_password',
        'balance',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'birthday' => 'date',
        'last_active_at' => 'datetime',

    ];


    /**
    * The attributes that should be cast.
    *
    * @var array
    */

    const ROLE_ADMIN = 'admin';
    const ROLE_DIRECTOR = 'director';
    const ROLE_EDUCATOR = 'educator';
    const ROLE_ACCOUNTANT = 'accountant';
    const ROLE_PARENT = 'parent';
    const ROLE_CHILD = 'child';


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $model->gardens()->sync([], true);
            $model->parents()->sync([], true);
            $model->children()->sync([], true);
            $model->notifications()->detach();
            $model->galleries()->detach();
            $garden = $model->gardenAdmin;
            if ($garden) {
                $garden->admin_id = null;
                $garden->save();
            }
        });
    }

    public static function defaultRoles(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_DIRECTOR,
            self::ROLE_EDUCATOR,
            self::ROLE_ACCOUNTANT,
            self::ROLE_PARENT,
            self::ROLE_CHILD,
        ];
    }

    public function generateUserName( int $number = null)
    {
        $user = $this;
        $gardenCode = $user->getGardenCode();
        $year = $user->birthday ? date('Y', strtotime($user->birthday)) : rand(2050,2099);
        $this->username = self::generateUserNameByAttr(
            $user->role,
            $gardenCode,
            $year,
            $number
        );
        $this->save();
    }

    public static function generateUserNameByAttr(
        string $role,
        string $gardenCode = null,
        string $year = null,
        int $forceNumber = null
    ): string {
        if (in_array($role, [User::ROLE_DIRECTOR])) {
            [$latest, $numberLen, $prefix] = static::preGenerateUserNameDirector($gardenCode);
        }
        else if (in_array($role, [User::ROLE_EDUCATOR])) {
            [$latest, $numberLen, $prefix] = static::preGenerateUserNameEducator($gardenCode);
        }
        else if (in_array($role, [User::ROLE_ACCOUNTANT])) {
            [$latest, $numberLen, $prefix] = static::preGenerateUsernameAccountant($gardenCode);
        }
        else if (in_array($role, [User::ROLE_CHILD])) {
            [$latest, $numberLen, $prefix] = static::preGenerateUserNameChild($gardenCode, $year);
        }
        else if (in_array($role, [User::ROLE_PARENT])) {
            [$latest, $numberLen, $prefix] = static::preGenerateUserNameParent();
        }
        else if (in_array($role, [User::ROLE_ADMIN])) {
            [$latest, $numberLen, $prefix] = static::preGenerateUserNameAdmin();
        }

        return static::generateByPrefix($prefix, $latest ?? "", $numberLen, null, $forceNumber);
    }

    private static function generateByPrefix(string $prefix, string $latest, int $len, int $add = null, int $forceNumber = null): string
    {
        $add = $add ?? 1;
        if ($forceNumber > 0) {
            $number = $forceNumber;
        } else {
            $latest = str_replace($prefix, "", $latest);
            $lastNumber = array_filter(preg_split("/\D+/", $latest));
            $lastNumber = abs((int)last($lastNumber));
            $lastNumber = $lastNumber < 0 ? 1 : $lastNumber;
            $number = $lastNumber+$add;
        }
        $number = (string)sprintf("%0{$len}d",$number);
        $newUID = $prefix.$number;
        return !($forceNumber > 0) && User::query()->where('username', $newUID)->count() > 0
            ? static::generateByPrefix($prefix, $latest, $len, $add+1, $forceNumber)
            : $newUID;
    }

    private static function preGenerateUserNameDirector(string $gardenCode)
    {
        $prefix = Str::lower("{$gardenCode}a");
        $numberLen = 4;
        $last = static::preGenerateGetLatestByPrefix($prefix);
        return [$last, $numberLen, $prefix];
    }

    private static function preGenerateUserNameEducator(string $gardenCode)
    {
        $prefix = Str::lower("{$gardenCode}m");
        $numberLen = 4;
        $last = static::preGenerateGetLatestByPrefix($prefix);
        return [$last, $numberLen, $prefix];
    }

    private static function preGenerateUsernameAccountant(string $gardenCode)
    {
        $prefix = Str::lower("{$gardenCode}b");
        $numberLen = 4;
        $last = static::preGenerateGetLatestByPrefix($prefix);
        return [$last, $numberLen, $prefix];
    }

    private static function preGenerateUserNameChild(string $gardenCode, $year)
    {
        $year = substr((string)$year, -2);
        $prefix = Str::lower("{$gardenCode}s{$year}");
        $numberLen = 3;
        $last = static::preGenerateGetLatestByPrefix($prefix);
        return [$last, $numberLen, $prefix];
    }

    private static function preGenerateUsernameParent()
    {
        $prefix = "e";
        $numberLen = 7;
        $last = static::preGenerateGetLatestByPrefix($prefix);
        return [$last, $numberLen, $prefix];
    }

    private static function preGenerateUsernameAdmin()
    {
        $prefix = "a";
        $numberLen = 4;
        $last = static::preGenerateGetLatestByPrefix($prefix);
        return [$last, $numberLen, $prefix];
    }

    private static function preGenerateGetLatestByPrefix(string $prefix)
    {
        $query = static::query()->latest('id');
        return optional($query->where('username','like',$prefix.'%')->first())->username;
    }

    /*
    * Mutators
    */

    public function getRoleCodeAttribute()
    {
        return $this->roleCode();
    }

    public function setRoleCodeAttribute(string $role)
    {
       Assert::inArray($role, self::defaultRoles());
       $this->role = $role;
    }

    public function getRoleNameAttribute()
    {
        return __('main.'.$this->roleCode());
    }

    public function getImageUrl()
    {
        return asset('storage/users/'. $this->avatar);
    }

    public function getGardenId()
    {
        return auth()->user()->gardenAdmin->id ?? (count($this->gardens) ? $this->gardens()->first()->id : null);
    }

    public function getGroupId()
    {
        return $this->group_id;
    }


    public function getGardenName()
    {
        return auth()->user()->gardenAdmin->name ?? (count($this->gardens) ? $this->gardens()->first()->name : null);
    }

    public function getGardenCode()
    {
        return count($this->gardens) ? $this->gardens()->first()->code : null;
    }

    public function gardens()
    {
        return $this->belongsToMany(Garden::class, 'user_gardens');
    }

    public function payments()
    {
        return $this->belongsToMany(Payment::class, 'payment_childrens');
    }

    public function addGarden($id)
    {
        $id = is_object($id) ? $id->id : $id;
        $gardens = $this->gardens()->pluck('gardens.id');
        $gardens->add($id);
        $this->gardens()->sync($gardens->unique(),true);
    }

    public function removeGarden($id)
    {
        $id = is_object($id) ? $id->id : $id;
        $gardens = $this->gardens()->pluck('gardens.id');
        $gardens = $gardens->filter(function ($item) use ($id) {
            return $item != $id;
        });
        $this->gardens()->sync($gardens->unique(),true);
    }

    public function children()
    {
        return $this->belongsToMany(
            User::class,
            'user_parents',
            'parent_id',
            'user_id',
            'id',
            'id'
        );
    }

    public function verifyPhone()
    {
        $this->phone_verified = true;
    }

    public function addChild($id)
    {
        $id = is_object($id) ? $id->id : $id;
        $children = $this->children()->pluck('users.id');
        $children->add($id);
        $this->children()->sync($children->unique(), true);
    }

    public function removeChild($id)
    {
        $id = is_object($id) ? $id->id : $id;
        $children = $this->children()->pluck('users.id');
        $children = $children->filter(function ($item) use ($id) {
            return $item != $id;
        });
        $this->children()->sync($children->unique(), true);
    }

    public function parents()
    {
        return $this->belongsToMany(
            User::class,
            'user_parents',
            'user_id',
            'parent_id',
            'id',
            'id'
        );
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function transactions()
    {
        return $this->hasMany(Payment::class, 'payer_id');
    }

    public function absents()
    {
        return $this->hasMany(Absent::class, 'child_id');
    }

    public function gardenAdmin()
    {
        return $this->hasOne(Garden::class, 'admin_id');
    }

    public function notifications()
    {
        return $this->belongsToMany(
            Notification::class,
            'notification_items',
            'user_id',
            'notification_id',
            'id',
            'id'
        )->withPivot('read_at');
    }

    public function galleries()
    {
        return $this->belongsToMany(
            Gallery::class,
            'gallery_items',
            'user_id',
            'gallery_id',
            'id',
            'id'
        );
    }

    // /*
    //  * Helpers
    //  */

    public function isRoleAdmin()
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    public function isRoleDirector()
    {
        return $this->hasRole(self::ROLE_DIRECTOR);
    }

    public function isRoleEducator()
    {
        return $this->hasRole(self::ROLE_EDUCATOR);
    }

    public function isRoleAccountant()
    {
        return $this->hasRole(self::ROLE_ACCOUNTANT);
    }

    public function isRoleParent()
    {
        return $this->hasRole(self::ROLE_PARENT);
    }

    public function isRoleChild()
    {
        return $this->hasRole(self::ROLE_CHILD);
    }

    public function hasRole($role): bool
    {
        return $this->role == $role;
    }

    public function hasRoles($roles): bool
    {
        return in_array($this->role, $roles);
    }

    public function roleCode(): ?string
    {
        return @$this->role;
    }

    public function roleName()
    {
        return __('app.role_'.$this->roleCode());
    }

    public function paymentDate()
    {
        return optional(Payment::query()
                    ->whereStatus(Payment::STATUS_SUCCESS)
                    ->where(function ($query){
                        $query->where('children', 'like','%['.$this->id.']%')
                            ->orWhere('children', 'like','%['.$this->id.',%')
                            ->orWhere('children', 'like','%,'.$this->id.',%')
                            ->orWhere('children', 'like','%,'.$this->id.']%');
                    })
                    ->latest()->first())->created_at;

    }

    /*
     * Scopes
     */

    public function scopeRole($query, $roles)
    {
        if(!is_array($roles))
            $roles = [$roles];

        return $query->whereIn('role', $roles);
    }

    public function scopeWhereRole($query, string $role)
    {
        Assert::inArray($role, self::defaultRoles());
        return $query->role($role);
    }

    public function scopeWhereInRole($query, array $roles)
    {

        foreach ($roles as $role){
            Assert::inArray($role, self::defaultRoles());
        }
        return $query->role($roles);
    }

        public function scopeWhereGardens($query, $ids)
        {
            $ids = is_iterable($ids) ? $ids : [$ids];
            return $query->whereHas('gardens', function ($qb) use ($ids) {
                return $qb->whereIn('gardens.id', $ids);
            });
        }

}
