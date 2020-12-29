<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFaktursTable extends Migration
{
    public function up()
    {
        Schema::table('fakturs', function (Blueprint $table) {
            $table->unsignedBigInteger('pelanggan_id');
            $table->foreign('pelanggan_id', 'pelanggan_fk_2879706')->references('id')->on('pelanggans');
        });
    }
}
