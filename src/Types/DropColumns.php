<?php

namespace Franzl\EasyMigrations\Types;

class DropColumns extends AddColumns
{
    public function up()
    {
        parent::down();
    }

    public function down()
    {
        parent::up();
    }
}
