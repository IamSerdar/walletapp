<?php

namespace Modules\ServiceAccount\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\User;

class ServiceAccount extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','address','qrcode'];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {

        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getQRCode()
    {
        return asset('storage/service_accounts/qrcodes/' . $this->qrcode);
    }

}
