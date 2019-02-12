<?php

namespace Nox0121\EloquentVolumeable\Test;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'attachments';
    protected $guarded = [];
    public $timestamps = false;
}
