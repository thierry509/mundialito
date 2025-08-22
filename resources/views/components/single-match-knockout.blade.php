@props([
    'game' => null,
    'teams' => [],
    'position' => 0,
    'stage' => 'round16',
    'class' => 'my-[50px]',
])
<div class="flex flex-col bg-white rounded-lg w-60 p-1 text-sm cursor-pointer {{ $class }}">
    @if ($game != null)
        <a href="{{ route('games') }}?year={{ $game->championship->year }}#{{ $game->id }}">
            <div class="px-1">
                <div class="flex justify-between">
                    <span>{{ $game->teamA()->first()->name ?? 'N/A' }}</span>
                    @if ($game->status == 'finished')
                        <span>
                            {{ $game->team_a_goals }}
                            @if ($game->shootout_score_a !== null)
                                <span class="mx-2 text-sm">({{ $game->shootout_score_a }})</span>
                            @endif
                        </span>
                    @endif
                </div>
                <div class="flex justify-between">
                    <span>{{ $game->teamB()->first()->name ?? 'N/A' }}</span>
                    @if ($game->status == 'finished')
                        <span>
                            {{ $game->team_b_goals }}
                            @if ($game->shootout_score_b !== null)
                                <span class="mx-2 text-sm">({{ $game->shootout_score_b }})</span>
                            @endif
                        </span>
                    @endif
                </div>
            </div>
        </a>
    @else
        <div
            class="flex justify-center items-center border-2 border-dotted border-gray-300 w-full rounded-lg py-2 px-4 hover:bg-gray-50 cursor-pointer transition-colors">
            <div class="flex items-center gap-2 text-gray-500">
                <span class="font-medium">à déterminer</span>
            </div>
        </div>
    @endif
</div>
