<?php

namespace App\Http\Controllers;

use App\Services\ManagerInterface;

abstract class BaseCrudController
{
    /**
     * @var ManagerInterface
     */
    protected $manager;

    protected function getManager(): ManagerInterface
    {
        return $this->manager;
    }
}
