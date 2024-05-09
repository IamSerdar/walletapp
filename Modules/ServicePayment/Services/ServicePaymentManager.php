<?php


namespace Modules\ServicePayment\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\ServicePayment\Entities\ServicePayment;
use Illuminate\Support\Facades\Validator;

class ServicePaymentManager
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
            'from_address' => ['required'],
            'to_address' => ['required'],
            'amount' => ['required'],
            'status' => ['required'],
        ];
        if ($id) {
            $rules['user_id'] = ['required', 'exists:users,id'];
            $rules['from_address'] = ['required'];
            $rules['to_address'] = ['required'];
            $rules['amount'] = ['required'];
            $rules['status'] = ['required'];
        }

        return $rules;
    }

    public function create(array $data): Model
    {
        $data['status'] = ServicePayment::STATUS_PROCESS;
        $this->validate($data);
        $model = ServicePayment::create($data);
        return $model;
    }

    public function update(Model $model, array $data): Model
    {
        $this->validate($data, $model->id);
        $model->update($data);
        return $model;
    }
}
