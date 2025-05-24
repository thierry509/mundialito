<template>
    <ToastNotification />
    <ConfirmModal />
    <div class="flex flex-col h-screen w-full max-w-[100vw] overflow-x-hidden"> <!-- Header -->
        <header class="bg-white shadow-lg z-50">
            <nav class="flex justify-between items-center p-4">
                <!-- Logo/Brand -->
                <div class="flex items-center">
                    <button id="openAside" class="md:hidden text-gray-500 mr-4" @click="toggleAside">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <span class="text-base sm:text-xl font-bold text-primary">Mundialito</span>
                    <SelectedYear />
                </div>

                <!-- Boutons droite -->
                <div class="flex items-center space-x-4">
                    <!-- Bouton Mode Lecteur -->
                    <a href="/">
                        <button
                            class="p-2 text-gray-500 hover:text-accent rounded-full hover:bg-gray-100 transition flex justify-center items-center">
                            <span class="hidden md:block"> Mode visiteur </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </a>
                    <!-- Avatar avec dropdown -->
                    <div class="relative">
                        <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none"
                            @click="toggleUserMenu">
                            <div
                                class="w-8 h-8 rounded-full bg-accent flex items-center justify-center text-white font-semibold">
                                JP
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userMenu"
                            class="hidden absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-xl py-1 z-50 border border-gray-100">
                            <!-- Menu items with subtle hover effects -->
                            <a href="#"
                                class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Mon Profil
                            </a>

                            <a href="#"
                                class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Paramètres
                            </a>

                            <!-- Divider -->
                            <div class="border-t border-gray-100 my-1"></div>

                            <!-- Logout with distinct style -->
                            <div @click="logout"
                                class="cursor-pointer flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <svg class="w-5 h-5 mr-3 text-red-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Déconnexion
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="flex flex-1 overflow-hidden border-t">
            <!-- Aside -->
            <aside id="aside"
                class="bg-white w-64 md:w-72 h-full shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 fixed md:relative z-20 max-w-[90vw]">
                <!-- Contenu de l'aside -->
                <div class="p-4 overflow-y-auto h-[calc(100%-60px)]">
                    <nav>
                        <ul class="space-y-2">
                            <li>
                                <Link href="/edition"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-light hover:text-primary transition">
                                <svg viewBox="0 -0.5 25 25" fill="none" class="w-5 h-5 mr-3"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.918 10.0005H7.082C6.66587 9.99708 6.26541 10.1591 5.96873 10.4509C5.67204 10.7427 5.50343 11.1404 5.5 11.5565V17.4455C5.5077 18.3117 6.21584 19.0078 7.082 19.0005H9.918C10.3341 19.004 10.7346 18.842 11.0313 18.5502C11.328 18.2584 11.4966 17.8607 11.5 17.4445V11.5565C11.4966 11.1404 11.328 10.7427 11.0313 10.4509C10.7346 10.1591 10.3341 9.99708 9.918 10.0005Z"
                                            stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.918 4.0006H7.082C6.23326 3.97706 5.52559 4.64492 5.5 5.4936V6.5076C5.52559 7.35629 6.23326 8.02415 7.082 8.0006H9.918C10.7667 8.02415 11.4744 7.35629 11.5 6.5076V5.4936C11.4744 4.64492 10.7667 3.97706 9.918 4.0006Z"
                                            stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.082 13.0007H17.917C18.3333 13.0044 18.734 12.8425 19.0309 12.5507C19.3278 12.2588 19.4966 11.861 19.5 11.4447V5.55666C19.4966 5.14054 19.328 4.74282 19.0313 4.45101C18.7346 4.1592 18.3341 3.9972 17.918 4.00066H15.082C14.6659 3.9972 14.2654 4.1592 13.9687 4.45101C13.672 4.74282 13.5034 5.14054 13.5 5.55666V11.4447C13.5034 11.8608 13.672 12.2585 13.9687 12.5503C14.2654 12.8421 14.6659 13.0041 15.082 13.0007Z"
                                            stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.082 19.0006H17.917C18.7661 19.0247 19.4744 18.3567 19.5 17.5076V16.4936C19.4744 15.6449 18.7667 14.9771 17.918 15.0006H15.082C14.2333 14.9771 13.5256 15.6449 13.5 16.4936V17.5066C13.525 18.3557 14.2329 19.0241 15.082 19.0006Z"
                                            stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                                Dashboard
                                </Link>
                            </li>



                            <li>
                                <Link :href="`/edition/equipes`"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-light hover:text-primary transition">
                                <svg fill="currentColor" class="w-5 h-5 mr-3" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-width="1.5"
                                        d="M6 13.5l4 2.5 4-2.5V5H6v8.5zM4.5 10a2 2 0 1 0-4 0 2 2 0 0 0 4 0zm13-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM4.485 6.199A6.71 6.71 0 0 1 10 3.3a6.715 6.715 0 0 1 5.456 2.823 1.4 1.4 0 0 0 2.281-1.624A9.518 9.518 0 0 0 10 .5a9.506 9.506 0 0 0-7.817 4.107 1.402 1.402 0 0 0 .355 1.948 1.401 1.401 0 0 0 1.947-.356zm10.971 7.678A6.713 6.713 0 0 1 10 16.7a6.71 6.71 0 0 1-5.515-2.899 1.4 1.4 0 0 0-2.302 1.592A9.506 9.506 0 0 0 10 19.5a9.518 9.518 0 0 0 7.737-3.999 1.401 1.401 0 0 0-2.281-1.624z">
                                    </path>
                                </svg>
                                Équipes
                                </Link>
                            </li>
                            <li>
                                <Link :href="`/edition/championnat/groupes?year=${year.year}`"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-light hover:text-primary transition">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                                Groupes
                                </Link>
                            </li>

                            <li>
                                <Link :href="`/edition/championnat/match?year=${year.year}`"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-light hover:text-primary transition">

                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Match
                                </Link>
                            </li>

                            <li>
                                <Link :href="`/edition/championnat/elimination?year=${year.year}`"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-light hover:text-primary transition">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 21h8m-4-4v4m0-4c-5.523 0-10-4.477-10-10V5a2 2 0 012-2h2.5a2 2 0 012 2h5a2 2 0 012-2H20a2 2 0 012 2v2c0 5.523-4.477 10-10 10z" />
                                </svg>
                                Elimination
                                </Link>
                            </li>


                            <li>
                                <Link href="/edition/actualites"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-light hover:text-primary transition">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                    </path>
                                </svg>
                                Actualites
                                </Link>
                            </li>


                            <li>
                                <Link :href="`/edition/championnat/parametre?year=${year.year}`"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-light hover:text-primary transition">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Parametre
                                </Link>
                            </li>
                        </ul>
                    </nav>

                </div>
            </aside>

            <!-- Contenu principal -->
            <main class="flex-1 overflow-y-auto bg-gray-100 w-full max-w-[100vw]">
                <slot></slot>
            </main>
        </div>
    </div>
</template>
<script setup>
import { Link, router } from '@inertiajs/vue3';
import SelectedYear from '@/components/Championship/SelectedYear.vue';
import ToastNotification from '@/components/ui/ToastNotification.vue';
import { useYearStore } from '@/store/year';
import ConfirmModal from '../components/modal/ConfirmModal.vue';
const year = useYearStore();
const aside = document.getElementById('aside');
const openAsideButton = document.getElementById('openAside');

document.addEventListener('click', (event) => {
    const aside = document.getElementById('aside');
    const openAsideButton = document.getElementById('openAside');
    if (!aside.contains(event.target) && !openAsideButton.contains(event.target)) {
        console.log(!aside.contains(event.target) && !openAsideButton.contains(event.target))
        aside.classList.add('-translate-x-full');
        aside.classList.remove('translate-x-0');
    }
})

document.addEventListener('click', (event) => {
    const userMenu = document.getElementById('userMenu');
    const userMenuButton = document.getElementById('userMenuButton')
    if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
        userMenu.classList.add('hidden')
    }
})



const toggleAside = () => {
    const aside = document.getElementById('aside');
    if (aside.classList.contains('-translate-x-full')) {
        aside.classList.remove('-translate-x-full');
        aside.classList.add('translate-x-0');
    } else {
        aside.classList.add('-translate-x-full');
        aside.classList.remove('translate-x-0');
    }
};

const toggleUserMenu = () => {
    const userMenu = document.getElementById('userMenu');
    userMenu.classList.toggle('hidden');
};

const logout = () => {
    router.post('/edition/deconnexion', {}, {})
}
</script>
