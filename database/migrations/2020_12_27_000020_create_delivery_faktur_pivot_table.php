<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryFakturPivotTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_faktur', function (Blueprint $table) {
            $table->unsignedBigInteger('delivery_id');
            $table->foreign('delivery_id', 'delivery_id_fk_2869121')->references('id')->on('deliveries')->onDelete('cascade');
            $table->unsignedBigInteger('faktur_id');
            $table->foreign('faktur_id', 'faktur_id_fk_2869121')->references('id')->on('fakturs')->onDelete('cascade');
        });
    }
}
