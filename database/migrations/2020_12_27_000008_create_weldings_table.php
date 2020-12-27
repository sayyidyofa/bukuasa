<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeldingsTable extends Migration
{
    public function up()
    {
        Schema::create('weldings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('weight_kg', 6, 2);
            $table->integer('amount_unit');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
