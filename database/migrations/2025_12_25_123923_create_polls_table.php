<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->id();

            $table->foreignId('owner_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            $table->text('description')->nullable();

            $table->string('poll_type');
            $table->string('status');
            $table->timestamp('opens_at');
            $table->timestamp('closes_at')->nullable();
            $table->timestamps();

            $table->index('owner_id');
            $table->index(['status', 'poll_type']);
            $table->index('opens_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('polls');
    }
};
