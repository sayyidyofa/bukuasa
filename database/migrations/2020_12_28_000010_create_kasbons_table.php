<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasbonsTable extends Migration
{
    public function up()
    {
        Schema::create('kasbons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('nominal', 15, 2);
            $table->date('cut_start');
            $table->date('cut_end');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
