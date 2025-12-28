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
        Schema::create('poll_round_options', function (Blueprint $table) {
            $table->id();

            $table->foreignId('poll_round_id')
                ->constrained('poll_rounds')
                ->onDelete('cascade');

            $table->string('label');
            $table->text('description')->nullable();

            $table->string('content_type');

            $table->string('youtube_url')->nullable();
            $table->string('image_path')->nullable();

            $table->unsignedInteger('position')->default(0);

            $table->index(['poll_round_id', 'position']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_round_options');
    }
};
