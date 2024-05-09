<?php


namespace Modules\ServiceAccount\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\ServiceAccount\Entities\ServiceAccount;
use Illuminate\Support\Facades\Validator;

class ServiceAccountManager
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
            'user_id' => ['required', 'exists:users,id'],
            'address' => ['required'],
            'file' => ['required', 'image'],
        ];
        if ($id) {
            $rules['user_id'] = ['required', 'exists:users,id'];
            $rules['address'] = ['required'];
            $rules['file'] = ['nullable', 'image'];
        }

        return $rules;
    }

    public function create(array $data, Request $request): Model
    {
        $this->validate($data);
        if ($request->hasFile('file')) {
            $data['qrcode'] = Storage::disk('service_accounts/qrcodes')->putFile(null, $request->file('file'));
        }
        $model = ServiceAccount::create($data);
        return $model;
    }

    public function update(Model $model, array $data, Request $request): Model
    {
        $this->validate($data, $model->id);
        if ($request->hasFile('file')) {
            if (Storage::disk('service_accounts/qrcodes')->exists($model->qrcode)) {
                Storage::disk('service_accounts/qrcodes')->delete($model->qrcode);
            }
            $data['qrcode'] = Storage::disk('service_accounts/qrcodes')->putFile(null, $request->file('file'));
        }
        $model->update($data);
        return $model;
    }
}
