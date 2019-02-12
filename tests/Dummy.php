<?php

namespace Nox0121\EloquentVolumeable\Test;

use Nox0121\EloquentVolumeable\Volumeable;
use Nox0121\EloquentVolumeable\VolumeableTrait;
use Illuminate\Database\Eloquent\Model;

class Dummy extends Model implements Volumeable
{
    use VolumeableTrait;

    protected $table = 'dummies';
    protected $guarded = [];
    public $timestamps = false;
}
