<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToKasbonsTable extends Migration
{
    public function up()
    {
        Schema::table('kasbons', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_2870985')->references('id')->on('users');
        });
    }
}
