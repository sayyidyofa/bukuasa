<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCrewsTable extends Migration
{
    public function up()
    {
        Schema::table('crews', function (Blueprint $table) {
            $table->unsignedBigInteger('delivery_id');
            $table->foreign('delivery_id', 'delivery_fk_2869086')->references('id')->on('deliveries');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_2869087')->references('id')->on('users');
        });
    }
}
