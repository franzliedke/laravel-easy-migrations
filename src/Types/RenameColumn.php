<?php

namespace Franzl\EasyMigrations\Types;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumn extends Migration
{
    protected $tableName;

    protected $oldName;

    protected $newName;

    public function __construct($tableName, $oldName, $newName)
    {
        $this->tableName = $tableName;
        $this->oldName = $oldName;
        $this->newName = $newName;
    }

    public function up()
    {
        Schema::table($this->tableName, function (Blueprint $table) {
            $table->renameColumn($this->oldName, $this->newName);
        });
    }

    public function down()
    {
        Schema::table($this->tableName, function (Blueprint $table) {
            $table->renameColumn($this->newName, $this->oldName);
        });
    }
}
