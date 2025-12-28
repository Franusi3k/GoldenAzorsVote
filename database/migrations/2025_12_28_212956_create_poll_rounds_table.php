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
        Schema::create('poll_rounds', function (Blueprint $table) {
            $table->id();

            $table->foreignId('poll_id')
                ->constrained('polls')
                ->onDelete('cascade');

            $table->string('title');
            $table->text('description')->nullable();

            $table->unsignedInteger('max_votes')->default(1);
            $table->unsignedInteger('position')->default(0);

            $table->index(['poll_id', 'position']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_rounds');
    }
};
