<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // Clés étrangères (obligatoires)
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');

            // Nom du joueur (champ texte, pas de relation)
            $table->string('player_name');

            $table->enum('type', [
                'goal',
                'yellow_card',
                'red_card',
                'assist',
                'substitution'
            ]);

            // Minute de l'événement
            $table->unsignedSmallInteger('minute');
            $table->unsignedSmallInteger('added_time')->nullable();


            // Infos supplémentaires (optionnel)
            $table->text('notes')->nullable();

            $table->timestamps();

            // Index pour optimiser les requêtes
            $table->index(['game_id', 'team_id', 'type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};
