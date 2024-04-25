<?php


namespace App\Services;


use Illuminate\Database\Eloquent\Model;

interface ManagerInterface
{
    public function updateFields(Model $model, array $data): Model;

    public function create(array $data): Model;

    public function find(string $id): ?Model;

    public static function modelClass(): string;

    public static function rules($id = null): array;
}
