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
use Modules\ServiceAccount\Entities\ServiceAccount;
use Modules\ServicePayment\Entities\ServicePayment;
use Modules\Transaction\Entities\Transaction;

class User extends Authenticatable
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
        'timer',
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
        'last_active_at' => 'datetime',
    ];


    /**
    * The attributes that should be cast.
    *
    * @var array
    */

    const ROLE_ADMIN = 'admin';
    const ROLE_CUSTOMER = 'customer';


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {

        });
    }

    public static function defaultRoles(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_CUSTOMER,
        ];
    }

    public function serviceAccount()
    {
        return $this->hasOne(ServiceAccount::class);
    }

    public function servicePayments()
    {
        return $this->hasMany(ServicePayment::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
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

    // /*
    //  * Helpers
    //  */

    public function isRoleAdmin()
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    public function isRoleCustomer()
    {
        return $this->hasRole(self::ROLE_CUSTOMER);
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

    public function balance() {
        $income = $this->transactions()->where('type', 'income')->get()->sum('amount');
        $withdraw = $this->transactions()->where('type', 'withdraw')->get()->sum('amount');
        return round($income - $withdraw, 2);
    }
}
