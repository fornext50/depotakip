<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMalzemeCikisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('malzeme_cikis', function (Blueprint $table) {
            $table->integer('malzeme_id')->unsigned();
            $table->foreign('malzeme_id')->references('id')->on('malzemeler')->onDelete('cascade');
            $table->string('cikaran_kisi');
            $table->string('cikarilan_kisi');
            $table->date('cikarma_tarihi');
            $table->text('gerekce');
            $table->text('aciklama');
            $table->string('ip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('malzeme_cikis');
    }
}
