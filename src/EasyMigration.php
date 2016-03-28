<?php

namespace Franzl\EasyMigrations;

use Illuminate\Database\Migrations\Migration;

abstract class EasyMigration extends Migration
{
    /**
     * @return \Illuminate\Database\Migrations\Migration
     */
    abstract public function change();

    public function up()
    {
        $this->change()->up();
    }

    public function down()
    {
        $this->change()->down();
    }
}
