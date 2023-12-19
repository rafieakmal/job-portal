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
        Schema::create('candidate_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('verification_slug')->unique();
            $table->string('verification_token')->nullable();
            $table->string('verification_key')->nullable();
            $table->string('verification_code')->nullable();
            $table->string('verification_receiver')->nullable();
            $table->enum('verification_type', ['email', 'wa']);
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
        Schema::dropIfExists('candidate_verifications');
    }
};
