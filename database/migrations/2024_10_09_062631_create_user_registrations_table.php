<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_registrations', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Name field
            $table->string('email'); // Email field, should be unique
            $table->string('nid')->unique(); // NID field, should be unique
            $table->foreignId('vaccine_center_id')->constrained()->onDelete('cascade'); // Foreign key for vaccine center
            $table->date('scheduled_date'); // Scheduled date for vaccination
            $table->boolean('vaccinated')->default(false); // Vaccination status
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_registrations');
    }
}
