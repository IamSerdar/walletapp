<?php


namespace App\Exceptions;


use Throwable;

class ApiErrorException extends \DomainException
{
    /**
     * @var array
     */
    protected $meta;

    /**
     * @var string|null
     */
    protected $description;

    public function __construct($errorCode, array $meta = null, $message = null, Throwable $previous = null)
    {
        parent::__construct($errorCode, 0, $previous);
        $this->meta = is_array($meta) ? $meta : [];
        $this->description = $message;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }
}
