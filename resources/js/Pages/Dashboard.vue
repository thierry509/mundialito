<template>

    <Head>
        <title>Tableau de bord</title>
    </Head>
    <div class="p-6 md:p-8">

        <div class="max-w-7xl mx-auto grid grid-cols-1 gap-6">
            <!-- Header -->
            <div class="col-span-full">
                <h1 class="text-3xl font-bold text-gray-900">Tableau de bord</h1>
                <p class="text-gray-500">Bienvenue dans votre espace d'administration</p>
            </div>

            <!-- Quick Actions Grid -->
            <div class="col-span-full grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Gestion des matchs -->
                <Link href="/edition/matchs">
                <div
                    class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:border-blue-200 transition-all hover:shadow-md flex items-start">
                    <div class="p-3 rounded-lg bg-blue-50 text-blue-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Gestion des matchs</h3>
                        <p class="text-sm text-gray-500 mt-1">Planifier et modifier les rencontres</p>
                    </div>
                </div>
                </Link>
                <!-- Gestion des équipes -->
                <Link href="/edition/equipes"
                    class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:border-purple-200 transition-all hover:shadow-md flex items-start">
                <div class="p-3 rounded-lg bg-purple-50 text-purple-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Gestion des équipes</h3>
                    <p class="text-sm text-gray-500 mt-1">Ajouter ou modifier des équipes</p>
                </div>
                </Link>
                <!-- Paramètres -->
                <a href="#"
                    class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:border-gray-200 transition-all hover:shadow-md flex items-start">
                    <div class="p-3 rounded-lg bg-gray-50 text-gray-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Paramètres</h3>
                        <p class="text-sm text-gray-500 mt-1">Configurer votre espace</p>
                    </div>
                </a>
                <a href="#"
                    class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:border-gray-200 transition-all hover:shadow-md flex items-start">
                    <div class="p-3 rounded-lg bg-red-50 text-red-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V7a2 2 0 00-2-2H7a2 2 0 00-2 2v4m0 0h14">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Actualites</h3>
                        <p class="text-sm text-gray-500 mt-1">Gerer vos articles</p>
                    </div>
                </a>
            </div>

            <!-- Stats and Championships Grid -->
            <div class="col-span-full grid grid-cols-1 lg:grid-cols-3 gap-6">
                <ListChampionship v-if="auth?.user.roles == 'admin'"/>
            </div>
        </div>

    </div>
</template>
<script setup>
import { Link, Head } from '@inertiajs/vue3';
import ListChampionship from '../components/Championship/ListChampionship.vue';

defineProps({
    auth: Object,
});

</script>
