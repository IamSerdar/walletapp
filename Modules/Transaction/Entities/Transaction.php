<?php

namespace Modules\Transaction\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','type','from','to','amount','status','note'];

    const TYPE_INCOME = 'income';
    const TYPE_WITHDRAW = 'withdraw';

    const STATUS_PROCESS = 'process';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAIL = 'fail';


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {

        });
    }

    public static function defaultTypes(): array
    {
        return [
            self::TYPE_INCOME,
            self::TYPE_WITHDRAW,
        ];
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
