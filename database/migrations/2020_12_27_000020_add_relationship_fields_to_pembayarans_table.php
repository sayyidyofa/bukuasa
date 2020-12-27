<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPembayaransTable extends Migration
{
    public function up()
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id', 'customer_fk_2867525')->references('id')->on('pelanggans');
            $table->unsignedBigInteger('faktur_id');
            $table->foreign('faktur_id', 'faktur_fk_2868944')->references('id')->on('fakturs');
        });
    }
}
