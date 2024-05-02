<?php


namespace Modules\Transaction\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Transaction\Entities\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TransactionManager
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
            'type' => ['required', Rule::in(Transaction::defaultTypes())],
            'from_address' => ['required'],
            'to_address' => ['required'],
            'amount' => ['required'],
            'status' => ['required'],
            'note' => ['nullable'],
        ];
        if ($id) {
            $rules['user_id'] = ['required', 'exists:users,id'];
            $rules['type'] = ['required', Rule::in(Transaction::defaultTypes())];
            $rules['from_address'] = ['required'];
            $rules['to_address'] = ['required'];
            $rules['amount'] = ['required'];
            $rules['status'] = ['required'];
            $rules['note'] = ['nullable'];
        }

        return $rules;
    }

    public function create(array $data): Model
    {
        $data['status'] = Transaction::STATUS_PROCESS;
        $this->validate($data);
        $model = Transaction::create($data);
        return $model;
    }

    public function update(Model $model, array $data): Model
    {
        $this->validate($data, $model->id);
        $model->update($data);
        return $model;
    }
}
