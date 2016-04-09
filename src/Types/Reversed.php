<?php

namespace Franzl\EasyMigrations\Types;

use Illuminate\Database\Migrations\Migration;

class Reversed extends Migration
{
    /**
     * @var \Illuminate\Database\Migrations\Migration
     */
    protected $reversed;

    public function __construct(Migration $reversed)
    {
        $this->reversed = $reversed;
    }

    public function up()
    {
        $this->reversed->down();
    }

    public function down()
    {
        $this->reversed->up();
    }
}
