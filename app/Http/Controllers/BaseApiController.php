<?php


namespace App\Http\Controllers;


use App\Exceptions\ApiErrorException;
use App\Services\HandlerInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BaseApiController
{
    public function success(array $data = null, int $status = 200, string $message = null)
    {
        $response['success'] = 1;
        $response = array_merge($response, $data);


        if ($message) {
            $response['message'] = $message;
        }
        return response()->json($response, $status);
    }

    public function error(array $errors, int $status = 400, string $message = null)
    {
        $response = [
            'success' => 0,
            'errors' => $errors,
        ];
        if ($message) {
            $response['message'] = $message;
        }
        return response()->json($response, $status);
    }

    public function singleError(string $errorCode, string $errorMessage = null, int $status = 400, array $meta = [])
    {
        $response = [
            'success' => 0,
            'error' => [
                'code' => $errorCode,
                'message' => $errorMessage,
                'meta' => $meta,
            ],
        ];
        return response()->json($response, $status);
    }

    public function handle(HandlerInterface $handler, array $data, Request $request)
    {
        try {
            try {
                try {
                    [$response , $message] = $handler->handle($data, $request);
                    return $this->success($response, 200, $message);
                } catch (ModelNotFoundException $exception) {
                    throw new ApiErrorException(Str::snake(last(explode("\\",$exception->getModel()))).'.not_found', []);
                }
            } catch (ApiErrorException $exception) {
                return $this->singleError($exception->getMessage(), $exception->getDescription(), 400, $exception->getMeta());
            }
        } catch (\DomainException $exception) {
            return $this->singleError($exception->getMessage());
        }
    }
}
