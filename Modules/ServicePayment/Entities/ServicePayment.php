<?php

namespace Modules\ServicePayment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class ServicePayment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','from_address','to_address','amount','status'];

    const STATUS_PROCESS = 'process';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAIL = 'fail';


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {

        });
    }

    public static function defaultStatus(): array
    {
        return [
            self::STATUS_PROCESS,
            self::STATUS_SUCCESS,
            self::STATUS_FAIL,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
