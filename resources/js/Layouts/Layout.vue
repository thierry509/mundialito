<template>
    <ToastNotification />
    <ConfirmModal/>
    <div class="flex flex-col h-screen">
        <!-- Header -->
        <header class="bg-white shadow-lg z-10">
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
                    <span class="text-xl font-bold text-primary">Mundialito</span>

                    <SelectedYear />
                </div>

                <!-- Boutons droite -->
                <div class="flex items-center space-x-4">
                    <!-- Bouton Mode Lecteur -->
                    <a href="/">
                        <button
                            class="p-2 text-gray-500 hover:text-accent rounded-full hover:bg-gray-100 transition flex justify-center items-center">
                            Mode visiteur
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
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-30">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-light">Mon Profil</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-light">Paramètres</a>
                            <div class="border-t border-gray-200"></div>
                            <a href="#" class="block px-4 py-2 text-sm text-danger hover:bg-red-50">Déconnexion</a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="flex flex-1 overflow-hidden border-t">
            <!-- Aside -->
            <aside id="aside"
                class="bg-white w-64 md:w-72 h-full shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 fixed md:relative z-20">
                <!-- En-tête avec bouton de fermeture -->
                <div class="flex justify-end items-center px-4 pt-4 pb-0 mb-0 top-0 right-0">
                    <button id="closeAside" class="md:hidden text-gray-500 hover:text-danger transition"
                        @click="toggleAside">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Contenu de l'aside -->
                <div class="p-4 overflow-y-auto h-[calc(100%-60px)]">
                    <nav>
                        <ul class="space-y-2">
                            <li>
                                <Link href="/edition"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-light hover:text-primary transition">
                                Dashboard
                                </Link>
                            </li>



                            <li>
                                <Link :href="`/edition/equipes`"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-light hover:text-primary transition">
                                Équipes
                                </Link>
                            </li>
                            <li>
                                <Link :href="`/edition/championnat/groupes?year=${year.year}`"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-light hover:text-primary transition">
                                Groupes
                                </Link>
                            </li>
                            <li>
                                <Link :href="`/edition/championnat/elimination?year=${year.year}`"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-light hover:text-primary transition">
                                Elimination
                                </Link>
                            </li>
                            <li>
                                <Link :href="`/edition/championnat/match?year=${year.year}`"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-light hover:text-primary transition">
                                Match
                                </Link>
                            </li>

                            <li>
                                <Link href="/edition/actualites"
                                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-light hover:text-primary transition">

                                Actualites
                                </Link>
                            </li>
                        </ul>
                    </nav>

                </div>
            </aside>

            <!-- Contenu principal -->
            <main class="flex-1 p-6 md:p-8 overflow-y-auto bg-gray-100">
                <slot></slot>
            </main>
        </div>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
import SelectedYear from '@/components/Championship/SelectedYear.vue';
import ToastNotification from '@/components/ui/ToastNotification.vue';
import { useYearStore } from '@/store/year';
import { computed } from 'vue';
import ConfirmModal from '../components/modal/ConfirmModal.vue';
const year = useYearStore();

const toggleAside = () => {
    const aside = document.getElementById('aside');
    const openAsideButton = document.getElementById('openAside');
    const closeAsideButton = document.getElementById('closeAside');

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
</script>
