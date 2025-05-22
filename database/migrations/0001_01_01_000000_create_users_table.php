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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('role_id')->nullable()->constrained('user_roles');
            $table->foreignId('organization_id')->nullable()->constrained('organizations');
            $table->string('phone', 20)->nullable();
            $table->string('whatsapp_id', 50)->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->foreignId('user_status_id')->nullable()->constrained('user_statuses')->default(4); // Default is 'pending_verification'
            $table->timestamp('phone_verified_at')->nullable();
            $table->json('settings')->default(json_encode([]));
            $table->timestamp('last_login_at')->nullable();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('user_statuses');
    }
};
