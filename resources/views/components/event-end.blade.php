@props([
    "label" => null,
])
<!-- Ligne événement -->
<div class="relative flex items-center justify-center my-8 sm:my-16">
    <!-- Trait de séparation -->
    <div class="w-full border-t border-gray-300"></div>

    <!-- Badge au centre -->
    <div
        class="absolute bg-gradient-to-r from-green-500 to-blue-600 text-white
               px-3 py-1.5 sm:px-6 sm:py-2
               rounded-full shadow-lg
               text-xs sm:text-sm md:text-base
               font-semibold uppercase tracking-wider">
        {{ $label }}
    </div>
</div>
