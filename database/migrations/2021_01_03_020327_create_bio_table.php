<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 150);
            $table->string('other_name', 150);
            $table->string('last_name', 150);
            $table->string('objective', 3000);
            $table->string('gender', 10);
            $table->date('date_of_birth');
            $table->string('residential_address', 2000);
            $table->string('current_location', 2000);
            $table->string('state_of_origin', 2000);
            $table->string('nationality', 20);
            $table->string('profile_picture', 6000);
            $table->string('email')->unique();
            $table->string('phone_number', 20);
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
        Schema::dropIfExists('bio');
    }
}
