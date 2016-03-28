<?php

namespace Franzl\EasyMigrations\Types;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTable extends Migration
{
    protected $tableName;

    protected $blueprint;

    public function __construct($tableName, callable $blueprint)
    {
        $this->tableName = $tableName;
        $this->blueprint = $blueprint;
    }

    public function up()
    {
        Schema::create($this->tableName, $this->blueprint);
    }

    public function down()
    {
        Schema::drop($this->tableName);
    }
}
