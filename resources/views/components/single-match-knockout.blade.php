@props([
    'game' => null,
    'teams' => [],
    'position' => 0,
    'stage' => 'round16',
    'class' => 'my-[50px]',
])

<div class="flex flex-col bg-white rounded-lg w-60 p-1 text-sm cursor-pointer {{ $class }}">
    @if ($game)
        <div class="px-1">
            <Link href="`/edition/championnat/match?year=${year}#${game.id}`">
            <div class="flex justify-between">
                <span>{{ $game->team_a->name }}</span>
                <span>{{ $game->team_a_goals }}</span>
            </div>
            <div class="flex justify-between">
                <span>{{ $game->team_b->name }}</span>
                <span>{{ $game->team_a_goals }}</span>
            </div>
            </Link>
        </div>
    @else
        <div
            class="flex justify-center items-center border-2 border-dotted border-gray-300 w-full rounded-lg py-2 px-4 hover:bg-gray-50 cursor-pointer transition-colors">
            <div class="flex items-center gap-2 text-gray-500">
                <span class="font-medium">à déterminer</span>
            </div>
        </div>
    @endif
</div>
