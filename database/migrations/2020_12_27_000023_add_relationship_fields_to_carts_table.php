<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCartsTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('faktur_id');
            $table->foreign('faktur_id', 'faktur_fk_2868937')->references('id')->on('fakturs');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_fk_2868938')->references('id')->on('products');
        });
    }
}
