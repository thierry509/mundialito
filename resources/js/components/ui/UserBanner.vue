<template>
    <div class="flex items-center justify-center w-full">
            <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header avec dégradé -->
                <div class="gradient-bg py-6 px-8 text-center">
                    <div
                        class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-white">Inscription confirmée</h1>
                    <p class="text-white/90 mt-1">Votre demande a été enregistrée avec succès</p>
                </div>

                <!-- Contenu principal -->
                <div class="p-8">
                    <div class="bg-green-50/50 border border-green-100 rounded-lg p-5 mb-6">
                        <h2 class="font-semibold text-green-800 flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                                    clip-rule="evenodd" />
                            </svg>
                            Vous êtes journaliste ou membre de l'equipe de Mundialito ?
                        </h2>
                        <p class="text-green-700 text-sm mb-3">Contactez nos administrateurs pour accéder à des
                            fonctionnalités supplémentaires :</p>

                        <ul class="space-y-4">
                            <li v-for="user in users" :key="user.id" class="flex items-center space-x-4 bg-green-50 p-4 rounded-lg border border-green-200">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-gray-700 font-semibold">{{ user.first_name }} {{ user.last_name }}</p>
                                    <p class="text-gray-500 text-sm">
                                        <a :href="'mailto:' + user.email" class="text-blue-600 hover:underline">{{ user.email }}</a>
                                    </p>
                                    <p class="text-gray-500 text-sm">
                                        <a :href="'tel:' + user.phone" class="text-blue-600 hover:underline">{{ user.phone }}</a>
                                    </p>
                                    <p v-if="user.phone" class="text-gray-500 text-sm">
                                        <a :href="'https://wa.me/' + user.phone + '?text=' + encodeURIComponent('Bonjour, je viens de créer un compte sur le site de Mundialito. J\'ai besoin d\'avoir plus d\'accès sur le site pour collaborer.')" target="_blank" class="text-green-600 hover:underline">
                                            Contacter via WhatsApp
                                        </a>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="text-center mb-6">
                        <p class="text-gray-600 mb-4">Merci pour votre inscription. Vous recevrez bientôt plus
                            d'informations par email.</p>
                        <a href="/">
                            <button
                                class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                                Retour à l'accueil
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Footer technique -->
                <div class="bg-gray-50 px-8 py-4 border-t border-gray-100">
                    <p class="text-xs text-gray-500 text-center">
                        Assistance technique :
                        <a href="tel:+50940281374" class="text-green-600 hover:underline font-medium">Desir
                            Thierry
                            (+509 40281374)</a> •
                        <a href="mailto:contact@desirthierry.net"
                            class="text-green-600 hover:underline font-medium">contact@desirthierry.net</a>
                    </p>
                </div>
            </div>
        </div>
</template>
<script setup>
    defineProps({
        users: Array,
    });
</script>
