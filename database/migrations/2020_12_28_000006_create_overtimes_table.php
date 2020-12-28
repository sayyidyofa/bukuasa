<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOvertimesTable extends Migration
{
    public function up()
    {
        Schema::create('overtimes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dept');
            $table->date('date');
            $table->time('start_hour');
            $table->time('end_hour');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
