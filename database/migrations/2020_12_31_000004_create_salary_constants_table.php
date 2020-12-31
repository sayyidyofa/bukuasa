<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryConstantsTable extends Migration
{
    public function up()
    {
        Schema::create('salary_constants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->decimal('nominal', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
