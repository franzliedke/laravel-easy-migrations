<?php

namespace Franzl\EasyMigrations;

use Franzl\EasyMigrations\Types\AddColumns;
use Franzl\EasyMigrations\Types\CreateTable;
use Franzl\EasyMigrations\Types\RenameColumn;
use Franzl\EasyMigrations\Types\RenameTable;
use Franzl\EasyMigrations\Types\Reversed;

class Easy
{
    public static function createTable($tableName, callable $blueprint)
    {
        return new CreateTable($tableName, $blueprint);
    }

    public static function dropTable($tableName, callable $blueprint)
    {
        return new Reversed(
            new CreateTable($tableName, $blueprint)
        );
    }

    public static function renameTable($oldName, $newName)
    {
        return new RenameTable($oldName, $newName);
    }

    public static function renameColumn($tableName, $oldName, $newName)
    {
        return new RenameColumn($tableName, $oldName, $newName);
    }

    public static function addColumns($tableName, $columnDefinitions)
    {
        return new AddColumns($tableName, $columnDefinitions);
    }

    public static function dropColumns($tableName, $columnDefinitions)
    {
        return new Reversed(
            new AddColumns($tableName, $columnDefinitions)
        );
    }
}
