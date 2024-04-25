<?php

namespace App\Services;


use Illuminate\Http\Request;

interface HandlerInterface
{
    public function handle(array $data, Request $request);
}
