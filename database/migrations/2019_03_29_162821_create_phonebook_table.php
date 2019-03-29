<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonebookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phonebook', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name',75);
            $table->string('email')->unique();
            $table->string('phone',15);
            $table->string('country', 30);
            $table->string('city', 30);
            $table->string('state',2);
            $table->string('postal_code',5);

            $table->softDeletes();
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
        Schema::dropIfExists('phonebook');
    }
}
