<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepartmentForeignKeyToDepartmentSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('department_sub', function (Blueprint $table) {
            $table->addColumn('integer','idDepartment')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('department_sub', function (Blueprint $table) {
            $table->dropColumn('idDepartment');
        });
    }
}
