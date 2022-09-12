<?php

namespace App\Exception;

use RuntimeException;

class ActionNotFoundException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Action not found');
    }
}