<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('weight_kg', 7, 2);
            $table->integer('amount_unit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
