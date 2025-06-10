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

                        <div class="space-y-2">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">+1 234 567 890</span>
                            </div>

                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">contact@organisation.com</span>
                            </div>
                        </div>
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
