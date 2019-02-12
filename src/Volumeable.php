<?php

namespace Nox0121\EloquentVolumeable;

interface Volumeable
{
    /**
     * Insert an entry by a specific index. If index doesn't exist, value is appended.
     */
    public function insertEntry($index, $value);

    /**
     * Delete an entry by a specific index
     */
    public function deleteEntry($index);
}
