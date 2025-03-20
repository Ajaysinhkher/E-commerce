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
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->timestamp('created_at')->useCurrent(); // Auto set created_at
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // Auto set updated_at
            $table->enum('status', ['active', 'inactive'])->default('active'); // Default status: active
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
