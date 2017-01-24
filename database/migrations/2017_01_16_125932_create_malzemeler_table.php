<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMalzemelerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('malzemeler', function (Blueprint $table) {
            $table->increments('id');
            $table->string('madi');
            $table->string('mkimlik');
            $table->string('mgrubu');
            $table->string('mmarka')->nullable();
            $table->string('mmodel')->nullable();
            $table->float('mfiyat')->default(0);
            $table->string('mdurum');
            $table->boolean('deleted')->default(false);
            $table->text('mozellik')->nullable();
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
        Schema::drop('malzemeler');
    }
}
