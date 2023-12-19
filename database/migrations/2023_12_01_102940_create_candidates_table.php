<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('candidate_slug')->unique();
            $table->string('candidate_name')->nullable();
            $table->string('candidate_username')->nullable();
            $table->string('candidate_phone')->nullable();
            $table->string('candidate_email')->unique();
            $table->enum('candidate_role', ['admin', 'user', 'developer'])->default('user');
            $table->string('candidate_gender')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('password_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('candidate_last_login')->nullable();
            $table->string('candidate_profile_picture')->nullable()->default('assets/img/default.jpg');
            $table->rememberToken();
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
        Schema::dropIfExists('candidates');
    }
};
