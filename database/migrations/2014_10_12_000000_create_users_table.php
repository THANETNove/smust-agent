<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('code_admin')->nullable();
            $table->string('email')->unique();
            $table->string('prefix')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('id_card_number')->nullable();
            $table->string('provinces')->nullable();
            $table->string('status')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('property_type')->nullable();
            $table->string('characteristics')->nullable();
            $table->string('image')->nullable();
            $table->string('plans')->nullable();
            $table->string('card_image')->nullable();
            $table->string('line_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->text('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};