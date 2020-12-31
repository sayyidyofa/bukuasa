<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSalaryConstantsTable extends Migration
{
    public function up()
    {
        Schema::table('salary_constants', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id', 'role_fk_2891010')->references('id')->on('roles');
        });
    }
}
