<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaktursTable extends Migration
{
    public function up()
    {
        Schema::create('fakturs', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            //$table->integer('no_faktur')->unique();
            $table->date('tgl_faktur');
            $table->decimal('tagihan', 15, 2);
            $table->decimal('diskon_markup', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
