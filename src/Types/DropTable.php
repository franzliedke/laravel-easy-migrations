<?php

namespace Franzl\EasyMigrations\Types;

class DropTable extends CreateTable
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
