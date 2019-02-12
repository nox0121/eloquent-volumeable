<?php

namespace Nox0121\EloquentVolumeable\Test;

use Illuminate\Support\Collection;
use Nox0121\EloquentVolumeable\Exceptions\ItemExistsException;
use Nox0121\EloquentVolumeable\Exceptions\ItemNotExistsException;

class VolumeableTest extends TestCase
{
    /** @test */
    public function testVolumeColumnDefaultNullable()
    {
        /** arrange */
        /** act */
        /** assert */
        foreach (Dummy::all() as $dummy) {
            $this->assertEquals(null, $dummy->volume_column);
        }
    }

    /** @test */
    public function testInsertFirstItemWithIndex0()
    {
        /** arrange */
        $dummy = Dummy::find(1);
        $attachments = Attachment::all();
        $expected = [
            0 => $attachments->first()->id
        ];

        /** act */
        $dummy->insertEntry(0, $attachments->first()->id);

        /** assert */
        $this->assertEquals(serialize($expected), $dummy->volume_column);
    }

    /** @test */
    public function testInsertFirstItemWithIncorrectlyIndex()
    {
        /** arrange */
        $dummy = Dummy::find(1);
        $attachments = Attachment::all();
        $expected = [
            0 => $attachments->find(1)->id
        ];

        /** act */
        $dummy->insertEntry(1, $attachments->find(1)->id);

        /** assert */
        $this->assertEquals(serialize($expected), $dummy->volume_column);
    }

    /** @test */
    public function testInsertSecondItemToHead()
    {
        /** arrange */
        $dummy = Dummy::find(1);
        $attachments = Attachment::all();
        $expected = [
            0 => $attachments->find(2)->id,
            1 => $attachments->find(1)->id
        ];

        /** act */
        $dummy->insertEntry(0, $attachments->find(1)->id);
        $dummy->insertEntry(0, $attachments->find(2)->id);

        /** assert */
        $this->assertEquals(serialize($expected), $dummy->volume_column);
    }

    /** @test */
    public function testInsertSecondItemToTail()
    {
        /** arrange */
        $dummy = Dummy::find(1);
        $attachments = Attachment::all();
        $expected = [
            0 => $attachments->find(1)->id,
            1 => $attachments->find(2)->id
        ];

        /** act */
        $dummy->insertEntry(0, $attachments->find(1)->id);
        $dummy->insertEntry(1, $attachments->find(2)->id);

        /** assert */
        $this->assertEquals(serialize($expected), $dummy->volume_column);
    }

    /** @test */
    public function testInsertItemWithSameValue()
    {
        /** arrange */
        $dummy = Dummy::find(1);
        $attachments = Attachment::all();
        $this->expectException(ItemExistsException::class);

        /** act */
        $dummy->insertEntry(0, $attachments->find(1)->id);
        $dummy->insertEntry(1, $attachments->find(1)->id);

        /** assert */
    }

    /** @test */
    public function testDeleteLastItem()
    {
        /** arrange */
        $dummy = Dummy::find(1);
        $attachments = Attachment::all();
        $expected = null;

        /** act */
        $dummy->insertEntry(0, $attachments->find(1)->id);
        $dummy->deleteEntry(0);

        /** assert */
        $this->assertEquals($expected, $dummy->volume_column);
    }

    /** @test */
    public function testDeleteNotExistItem()
    {
        /** arrange */
        $dummy = Dummy::find(1);
        $attachments = Attachment::all();
        $this->expectException(ItemNotExistsException::class);

        /** act */
        $dummy->insertEntry(0, $attachments->find(1)->id);
        $dummy->deleteEntry(1);

        /** assert */
    }

    /** @test */
    public function testGetEntries()
    {
        /** arrange */
        $dummy = Dummy::find(1);
        $attachments = Attachment::all();
        $expected = [
            0 => $attachments->find(1)->id,
            1 => $attachments->find(2)->id
        ];

        /** act */
        $dummy->insertEntry(0, $attachments->find(1)->id);
        $dummy->insertEntry(1, $attachments->find(2)->id);
        $result = $dummy->getEntries();

        /** assert */
        $this->assertEquals($expected, $result);
    }
}
