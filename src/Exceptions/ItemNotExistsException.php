<?php

namespace Nox0121\EloquentVolumeable\Exceptions;

use Exception;

class ItemNotExistsException extends Exception
{
    public static function create()
    {
        return new static("The Item not exists!");
    }
}
