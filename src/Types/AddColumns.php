<?php

namespace Franzl\EasyMigrations\Types;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumns extends Migration
{
    protected $tableName;

    protected $columns;

    public function __construct($tableName, $columnDefinitions)
    {
        $this->tableName = $tableName;
        $this->columns = $columnDefinitions;
    }

    public function up()
    {
        Schema::table($this->tableName, function (Blueprint $table) {
            foreach ($this->columns as $columnName => $options) {
                $type = array_shift($options);
                $table->addColumn($type, $columnName, $options);
            }
        });
    }

    public function down()
    {
        Schema::table($this->tableName, function (Blueprint $table) {
            $table->dropColumn(array_keys($this->columns));
        });
    }
}
