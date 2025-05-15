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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time');
            $table->string('location');
            $table->enum('type', ['group','knockout']);
            $table->string('stage');
            $table->enum('status', ['soon', 'live', 'postponed', 'finished'])->default('soon');
            $table->foreignId('championship_id')->constrained();
            $table->foreignId('team_a_id')->constrained('teams');
            $table->foreignId('team_b_id')->constrained('teams');
            $table->integer('team_a_goals')->nullable();
            $table->integer('team_b_goals')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
