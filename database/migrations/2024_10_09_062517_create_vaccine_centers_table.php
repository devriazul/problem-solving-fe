<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccineCentersTable extends Migration
{
    public function up()
    {
        Schema::create('vaccine_centers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('daily_limit')->default(100); // Example field for daily limit
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vaccine_centers');
    }
}
