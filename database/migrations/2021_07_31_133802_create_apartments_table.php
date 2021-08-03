<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('name');
            $table->string('image')->nullable();
            $table->integer('price')->nullable();
            $table->string('date')->nullable();
            $table->string('title')->nullable();
            $table->string('href')->nullable();
            $table->string('address')->nullable();
            $table->integer('room')->nullable();
            $table->text('description')->nullable();
            $table->string('area')->nullable();
            $table->string('metro')->nullable();
            $table->string('appliances')->nullable();
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
        Schema::dropIfExists('apartments');
    }
}
