z<?php

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
            $table->increments('id');
            $table->integer('malzeme_id')->unsigned();
            $table->foreign('malzeme_id')->references('id')->on('malzemeler');
            $table->string('cikaran_kisi');
            $table->string('cikarilan_kisi');
            $table->string('teslim_birimi');
            $table->date('cikarma_tarihi');
            $table->text('gerekce');
            $table->boolean('onay')->default(false);
            $table->text('aciklama')->nullable();
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
