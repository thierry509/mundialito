@props(['game'])
@php
    $teamA = $game->teamA()->first();
    $teamB = $game->teamB()->first();
@endphp

<div id="{{ $game->id }}" class="divide-y divide-gray-200">
    <div class="p-4 hover:bg-gray-50/50 transition duration-200 rounded-lg shadow-[5px_5px_10px_0_rgba(7,7,7,0.1)]">
        <!-- En-tête avec date, statut et lieu -->
        <div class="flex justify-between items-center mb-3 text-xs text-gray-600">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span v-if="game.date_time"> {{ formatDate($game->date_time) }}</span>
                <span v-else>à déterminer</span>
            </div>

            <div class="flex items-center space-x-3">
                <div class="flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="font-medium">{{ $game->location}}</span>
                </div>
                <span class="px-2 py-1 text-xs font-semibold rounded-full capitalize {{ statusClass($game->status) }}">
                    {{  gameStatus($game->status) }}
                </span>
            </div>
        </div>

        <!-- Contenu du match -->
        <div class="flex items-center justify-between py-2">
            <!-- Équipe A -->
            <div class="flex items-center space-x-3 w-2/5">
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                    <span class="text-xs font-bold text-primary">
                        {{ substr($teamA->name, 0, 2) }}
                    </span>
                </div>
                <span class="text-sm font-medium truncate">{{ $teamA->name }}</span>
            </div>

            <!-- Score -->
            <div class="flex flex-col items-center w-1/5">
                @if ($game->status === 'soon' || $game->status === 'postponed')
                    <span
                        class="px-2 py-1 text-xs font-semibold rounded-full capitalize {{ statusClass($game->status) }}">
                        {{  gameStatus($game->status) }}
                    </span>
                @else
                    <div class="flex items-center my-1 space-x-2">
                        <span
                            class="w-12 h-8 rounded-md text-center flex items-center justify-center text-sm font-bold transition-all">{{ $game->team_b_goals }}</span>
                        <span class="text-sm font-medium text-gray-500">-</span>
                        <span
                            class="w-12 h-8 rounded-md text-center flex items-center justify-center text-sm font-bold transition-all">{{ $game->team_b_goals }}</span>

                    </div>
                @endif

            </div>

            <!-- Équipe B -->
            <div class="flex items-center justify-end space-x-3 w-2/5">
                <span class="text-sm font-medium truncate">{{ $teamB->name }}</span>
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                    <span class="text-xs font-bold text-primary">
                        {{ substr($teamB->name, 0, 2) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
