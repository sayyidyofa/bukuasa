<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWeldingsTable extends Migration
{
    public function up()
    {
        Schema::table('weldings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_2867913')->references('id')->on('users');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_fk_2867914')->references('id')->on('products');
        });
    }
}
