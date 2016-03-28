<?php

namespace Franzl\EasyMigrations\Types;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenameTable extends Migration
{
    protected $oldName;

    protected $newName;

    public function __construct($oldName, $newName)
    {
        $this->oldName = $oldName;
        $this->newName = $newName;
    }

    public function up()
    {
        Schema::rename($this->oldName, $this->newName);
    }

    public function down()
    {
        Schema::rename($this->newName, $this->oldName);
    }
}
