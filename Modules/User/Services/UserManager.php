<?php


namespace Modules\User\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Validator;

class UserManager
{
    public function validate(array $data, $id = null): array
    {
        $rules = $this->rules($id);
        $validator = Validator::make( $data, $rules);
        return $validator->validate();
    }

    public function rules($id = null): array
    {
        $rules = [
            'role' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'withdraw_password' => ['nullable'],
            'balance' => ['nullable'],
            'status' => ['nullable'],
        ];
        if ($id) {
            $rules['role'] = ['required'];
            $rules['username'] = ['required'];
            $rules['password'] = ['required'];
            $rules['withdraw_password'] = ['nullable'];
            $rules['balance'] = ['nullable'];
            $rules['status'] = ['nullable'];
        }

        return $rules;
    }

    public function create(array $data): Model
    {
        if (array_key_exists('status', $data) && $data['status']){
            $data['status'] = true;
        }else{
            $data['status'] = false;
        }
        $data['role'] = User::ROLE_CUSTOMER;
        $this->validate($data);
        $model = User::create($data);
        return $model;
    }

    public function update(Model $model, array $data): Model
    {
        if (array_key_exists('status', $data) && $data['status']){
            $data['status'] = true;
        }else{
            $data['status'] = false;
        }
        $data['role'] = User::ROLE_CUSTOMER;
        $this->validate($data, $model->id);
        $model->update($data);
        return $model;
    }
}
