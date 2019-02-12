<?php

namespace Nox0121\EloquentVolumeable\Exceptions;

use Exception;

class ItemExistsException extends Exception
{
    public static function create()
    {
        return new static("The Item exists!");
    }
}
