<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('nominal', 15, 2);
            $table->decimal('markup', 15, 2)->nullable();
            $table->string('keterangan')->nullable();
            $table->date('from');
            $table->date('to');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
