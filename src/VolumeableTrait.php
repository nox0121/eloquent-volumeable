<?php

namespace Nox0121\EloquentVolumeable;

use Illuminate\Database\Eloquent\Builder;
use Nox0121\EloquentVolumeable\Exceptions\ItemExistsException;
use Nox0121\EloquentVolumeable\Exceptions\ItemNotExistsException;

trait VolumeableTrait
{
    /**
     * Insert an entry by a specific index. If index doesn't exist, value is appended.
     */
    public function insertEntry($index, $value)
    {
        $volumeColumnName = $this->determineVolumeColumnName();

        $origin = $this->$volumeColumnName;

        $list = ($origin === null) ? [] : unserialize($this->$volumeColumnName);

        if (in_array($value, $list)) {
            throw ItemExistsException::create();
        }

        array_splice($list, $index, 0, $value);

        $this->$volumeColumnName = serialize($list);
    }

    /**
     * Delete an entry by a specific index
     */
    public function deleteEntry($index)
    {
        $volumeColumnName = $this->determineVolumeColumnName();

        $origin = $this->$volumeColumnName;

        $list = ($origin === null) ? [] : unserialize($this->$volumeColumnName);

        if (! array_key_exists($index, $list)) {
            throw ItemNotExistsException::create();
        }

        array_splice($list, $index, 1);

        $this->$volumeColumnName = empty($list) ? null : serialize($list);
    }

    /*
     * Determine the column name of the volume column.
     */
    protected function determineVolumeColumnName()
    {
        if (isset($this->volumeable['volume_column_name']) &&
            ! empty($this->volumeable['volume_column_name'])
        ) {
            return $this->volumeable['volume_column_name'];
        }

        return 'volume_column';
    }
}
