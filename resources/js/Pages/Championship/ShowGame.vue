<template>
    <div class="my-8">
        <div class="text-center mb-8">
            <div class="text-sm uppercase tracking-wider text-primary font-semibold mb-1">Mundialito {{
                game.championship.year }}</div>
            <h1 class="text-2xl font-bold mb-1">{{ game.team_a.name }} vs {{ game.team_b.name }}</h1>
            <div class="text-gray-500 text-sm">{{ game.location }} • <span v-if="game.date_time"> {{
                formatDate(game.date_time) }}</span></div>
        </div>

        <!-- Score -->
        <div class="flex items-center justify-center mb-8">
            <div class="text-center px-6">
                <div class="text-sm md:text-xl font-bold">{{ game.team_a.name }}</div>
            </div>

            <div class="mx-4 px-6 py-3 bg-white rounded-xl shadow-sm border border-gray-100">
                <div v-if="game.team_a_goals !== null && game.team_b_goals !== null"
                    class="text-xl md:text-3xl font-bold"><span v-if="game.shootout_score_a !== null"
                        class="text-sm md:text-xl mr-2">({{ game.shootout_score_a }})</span>{{ game.team_a_goals }} - {{
                            game.team_b_goals }}<span v-if="game.shootout_score_b !== null" class="text-sm md:text-xl ml-2">({{
                        game.shootout_score_b }})</span></div>
                <div v-else class="text-xl md:text-3xl font-bold">VS</div>
            </div>

            <div class="text-center px-6">
                <div class="text-sm md:text-xl font-bold">{{ game.team_b.name }}</div>
            </div>
        </div>

        <div class="flex justify-between items-center mb-6 mx-10 sm:mx-20 lg:mx-40">
            <div class="">
                <button v-if="auth?.user.roles == 'admin'" @click="deleteGame"
                    class="px-3 py-1.5 text-xs font-medium rounded-md bg-red-500/10 text-red-500 hover:bg-red-500/20 transition flex flex-col md:flex-row justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span class="hidden md:block mx-1.5">Suprimmer</span>
                </button>
            </div>
            <button
                v-if="auth?.user.roles == 'admin' && game.status != 'postponed' && game.status != 'finished' && !game?.team_a_goals"
                @click="postpone"
                class="px-3 py-1.5 text-xs font-medium rounded-md bg-orange-500/10 text-orange-600 hover:bg-orange-500/20 transition inline-flex items-center justify-center">
                <svg fill="currentColor" viewBox="0 0 36 36" version="1.1" class="h-4 w-4"
                    preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <title>redo-line</title>
                        <path
                            d="M24,4.22a1,1,0,0,0-1.41,1.42l5.56,5.49h-13A11,11,0,0,0,10.07,32,1,1,0,0,0,11,30.18a9,9,0,0,1-5-8,9.08,9.08,0,0,1,9.13-9h13l-5.54,5.48A1,1,0,0,0,24,20l8-7.91Z"
                            class="clr-i-outline clr-i-outline-path-1"></path>
                        <rect x="0" y="0" width="36" height="36" fill-opacity="0"></rect>
                    </g>
                </svg>
                <span class="hidden md:block mx-1.5">Reporter</span>
            </button>
            <button
                v-if="auth?.user.roles == 'admin' && game.status == 'postponed' || (!game.date_time && game.team_a_goals == null && game.team_b_goals == null)"
                @click="unpostpone"
                class="px-3 py-1.5 text-xs font-medium rounded-md bg-blue-500/10 text-blue-600 hover:bg-blue-600/20 transition inline-flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 13l-3 3m0 0l-3-3m3 3V8" />
                </svg>
                <span class="hidden md:block mx-1.5">Replanifier</span>
            </button>

            <button
                v-if="auth?.user.roles == 'admin' && game.team_a_goals != null && game.team_b_goals != null && game.status != 'finished' && game.status != 'posponed'"
                @click="end"
                class="px-3 py-1.5 text-xs font-medium rounded-md bg-primary/10 text-primary hover:bg-primary/20 transition flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="hidden md:block mx-1.5"> Terminer</span>
            </button>

            <!-- <button v-if="game.status != 'postponed' && game.status != 'live'" @click="live"
                    class="px-3 py-1.5 text-xs font-medium rounded-md bg-primary/10 text-primary hover:bg-primary/20 transition flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline animate-pulse" viewBox="0 0 24 24"
                        fill="currentColor">
                        <circle cx="12" cy="12" r="8" fill="red" />
                    </svg>
                    <span class="hidden md:block mx-1.5">En direct</span>
                </button> -->

            <button v-if="game.status != 'postponed'" @click="updateScore" style="justify-self: end !important;"
                class="hidden !justify-self-end px-3 py-1.5 text-xs font-medium rounded-md bg-primary text-white hover:bg-primary/90 transition flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span class="hidden md:block mx-1.5"> Mettre à jour</span>
            </button>
        </div>

        <div v-if="game.type === 'knockout' && game.team_a_goals == game.team_b_goals" class="flex justify-center mb-6">
            <button
                class="flex bg-primary items-center justify-center hover:bg-primary-700 text-white px-4 py-2 rounded-lg"
                @click="openShoots">
                <svg class="w-5 h-5 text-white mr-2" fill="currentColor" version="1.1" id="Capa_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 566.09 566.09" xml:space="preserve">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <g>
                                <path
                                    d="M546.965,77.451H19.125C8.568,77.451,0,86.019,0,96.576v372.938c0,10.566,8.568,19.125,19.125,19.125 s19.125-8.559,19.125-19.125v-54.832l24.862-6.541v73.574c0,2.641,2.142,4.781,4.781,4.781s4.781-2.141,4.781-4.781v-76.088 l24.863-6.541v70.428c0,10.566,8.568,19.125,19.125,19.125c10.557,0,19.125-8.559,19.125-19.125v-75.621h70.925v80 c0,2.641,2.142,4.781,4.781,4.781s4.781-2.141,4.781-4.781v-80h55.769v75.621c0,2.639,2.142,4.781,4.781,4.781 c2.64,0,4.781-2.143,4.781-4.781v-75.621h66.947v80c0,2.641,2.143,4.781,4.781,4.781s4.781-2.141,4.781-4.781v-80h62.635v75.621 c0,10.566,8.568,19.125,19.125,19.125S459,480.08,459,469.514v-72.828l30.59,8.004v77.025c0,2.641,2.143,4.781,4.781,4.781 c2.641,0,4.781-2.141,4.781-4.781v-74.52l28.688,7.516v54.803c0,10.566,8.568,19.125,19.125,19.125s19.125-8.559,19.125-19.125 V96.576C566.09,86.019,557.521,77.451,546.965,77.451z M63.103,398.254l-24.863,6.541v-75.363h24.863V398.254z M63.103,319.869 H38.24v-82.352l24.863,8.798V319.869z M63.103,236.169l-24.863-8.797v-79.866l24.863,19.029V236.169z M59.632,115.701h75.936 l17.901,18.637H85.575c-0.449,0-0.861,0.144-1.272,0.258L59.632,115.701z M97.528,389.207l-24.862,6.541v-66.316h24.862V389.207z M97.528,319.869H72.666V249.7l24.862,8.798V319.869z M97.528,248.352l-24.862-8.788V173.86l24.862,19.029V248.352z M206.703,384.33h-70.925v-54.898h70.925V384.33z M206.703,319.869h-70.925v-54.897h70.925V319.869z M206.703,255.409h-70.925 v-54.898h70.925V255.409z M206.703,190.948h-70.925v-7.506c0-5.948-2.773-11.561-7.497-15.186l-31.814-24.355h66.201 l44.045,45.843v1.205H206.703z M272.043,384.33h-55.778v-54.898h55.778V384.33z M272.043,319.869h-55.778v-54.897h55.778V319.869z M272.043,255.409h-55.778v-54.898h55.778V255.409z M272.043,190.948h-55.778v-3.127c0-1.233-0.479-2.419-1.339-3.309 l-39.015-40.602h96.132V190.948z M272.043,134.338H166.722l-17.901-18.637h123.222V134.338z M281.606,115.701h134.392 l-17.902,18.637h-116.49V115.701z M348.553,384.33h-66.947v-54.898h66.947V384.33z M348.553,319.869h-66.947v-54.897h66.947 V319.869z M348.553,255.409h-66.947v-54.898h66.947V255.409z M349.893,184.503c-0.861,0.889-1.34,2.075-1.34,3.309v3.127h-66.947 v-47.048h107.3L349.893,184.503z M420.75,384.33h-62.635v-54.898h62.635V384.33z M420.75,319.869h-62.635v-54.897h62.635V319.869z M420.75,255.409h-62.635v-54.898h62.635V255.409z M428.246,168.256c-4.723,3.615-7.496,9.228-7.496,15.186v7.506h-62.635v-1.205 l44.035-45.843h57.91L428.246,168.256z M489.59,394.811L459,386.807v-57.365h30.59V394.811z M489.59,319.869H459v-57.604 l30.59-8.845V319.869z M489.59,243.456L459,252.301V192.88l30.59-23.418V243.456z M472.559,134.338H411.35l17.9-18.637h67.646 L472.559,134.338z M527.84,404.824l-28.688-7.508v-67.885h28.688V404.824z M527.84,319.869h-28.688v-69.222l28.688-8.3V319.869z M527.84,232.402l-28.688,8.3v-78.556l28.688-21.955V232.402z">
                                </path>
                            </g>
                        </g>
                    </g>
                </svg>
                Tire Au but
            </button>
        </div>


        <div class="mx-10 sm:mx-20 lg:mx-40">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-base md:text-lg font-semibold text-gray-900">Événements du match</h1>
                    <p class="text-md md:text-base text-gray-500">Gestion des actions du jeu</p>
                </div>
                <button @click="openEvent"
                    class="bg-primary hover:bg-primary-700 text-white px-3 py-1 rounded-lg flex items-center space-x-2 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="hidden md:block text-base">Nouvel Événement</span>
                </button>
            </div>


            <!-- Events List -->
            <div class="space-y-3">
                <template v-if="events.length > 0" v-for="event in events" :key="event.id">
                    <div
                        class="event-card bg-white p-4 rounded-xl border border-gray-100 shadow-xs flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div class="bg-gray-100 p-2 rounded-lg">
                                <svg v-if="event.type === 'goal'" class="h-7 w-7 text-yellow-500" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M9.19762 11.9582L9.91426 11.737L9.19762 11.9582ZM9.54558 10.8683L9.08995 10.2726L9.54558 10.8683ZM9.91896 14.2952L9.20232 14.5164L9.91896 14.2952ZM14.0579 14.2952L13.3413 14.074L14.0579 14.2952ZM14.4313 10.8683L13.9757 11.4641V11.4641L14.4313 10.8683ZM14.7793 11.9582L15.4959 12.1794L14.7793 11.9582ZM12.5948 9.46375L13.0504 8.86802L12.5948 9.46375ZM11.3821 9.46375L11.8377 10.0595L11.3821 9.46375ZM20.1847 17.75C20.5989 17.75 20.9347 17.4142 20.9347 17C20.9347 16.5858 20.5989 16.25 20.1847 16.25V17.75ZM14.7793 19.7351L14.0677 19.4982L14.7793 19.7351ZM13.4801 21.2631C13.3492 21.6561 13.5617 22.0807 13.9547 22.2116C14.3477 22.3424 14.7724 22.1299 14.9033 21.7369L13.4801 21.2631ZM3.99769 16.25C3.58348 16.25 3.24769 16.5858 3.24769 17C3.24769 17.4142 3.58348 17.75 3.99769 17.75V16.25ZM9.40314 19.7351L10.1147 19.4982L9.40314 19.7351ZM9.27917 21.7369C9.41002 22.1299 9.83469 22.3424 10.2277 22.2116C10.6207 22.0807 10.8332 21.6561 10.7024 21.2631L9.27917 21.7369ZM8.22071 17.3775L7.78185 17.9857L8.22071 17.3775ZM5.556 5.45942C5.4489 5.05928 5.03772 4.82173 4.63759 4.92882C4.23746 5.03591 3.9999 5.44709 4.10699 5.84723L5.556 5.45942ZM5.24951 7.21519L4.52501 7.40909V7.40909L5.24951 7.21519ZM3.59168 11.5885L3.17811 10.9628L3.17811 10.9628L3.59168 11.5885ZM1.62739 11.9879C1.28185 12.2163 1.18689 12.6816 1.4153 13.0271C1.64372 13.3727 2.109 13.4676 2.45454 13.2392L1.62739 11.9879ZM19.934 5.84732C20.0411 5.44719 19.8035 5.036 19.4034 4.92891C19.0033 4.82182 18.5921 5.05938 18.485 5.45951L19.934 5.84732ZM18.7915 7.21528L18.067 7.02137L18.7915 7.21528ZM20.4493 11.5886L20.0357 12.2143L20.4493 11.5886ZM21.5864 13.2393C21.932 13.4677 22.3973 13.3728 22.6257 13.0272C22.8541 12.6817 22.7591 12.2164 22.4136 11.988L21.5864 13.2393ZM16.0903 3.83623C16.4288 3.5975 16.5096 3.12956 16.2709 2.79107C16.0322 2.45257 15.5642 2.3717 15.2257 2.61044L16.0903 3.83623ZM14.3376 4.15456L14.7699 4.76746L14.3376 4.15456ZM9.66562 4.10403L9.22021 4.70744V4.70744L9.66562 4.10403ZM8.61539 2.39659C8.28213 2.15059 7.81255 2.22133 7.56656 2.55459C7.32056 2.88784 7.3913 3.35742 7.72456 3.60341L8.61539 2.39659ZM14.7793 11.3678L14.0627 11.589L14.7793 11.3678ZM9.19762 11.3678L9.91426 11.589L9.19762 11.3678ZM21.2269 12C21.2269 17.1095 17.0899 21.25 11.9885 21.25V22.75C17.92 22.75 22.7269 17.9362 22.7269 12H21.2269ZM11.9885 21.25C6.88701 21.25 2.75 17.1095 2.75 12H1.25C1.25 17.9362 6.05695 22.75 11.9885 22.75V21.25ZM2.75 12C2.75 6.89055 6.88701 2.75 11.9885 2.75V1.25C6.05695 1.25 1.25 6.06376 1.25 12H2.75ZM11.9885 2.75C17.0899 2.75 21.2269 6.89055 21.2269 12H22.7269C22.7269 6.06376 17.92 1.25 11.9885 1.25V2.75ZM12.1392 10.0595L13.9757 11.4641L14.887 10.2726L13.0504 8.86802L12.1392 10.0595ZM14.0626 11.737L13.3413 14.074L14.7746 14.5164L15.4959 12.1794L14.0626 11.737ZM13.1036 14.25H10.8733V15.75H13.1036V14.25ZM10.6356 14.074L9.91426 11.737L8.48098 12.1794L9.20232 14.5164L10.6356 14.074ZM10.0012 11.4641L11.8377 10.0595L10.9265 8.86802L9.08995 10.2726L10.0012 11.4641ZM20.1847 16.25H18.5696V17.75H20.1847V16.25ZM14.0677 19.4982L13.4801 21.2631L14.9033 21.7369L15.4909 19.972L14.0677 19.4982ZM18.5696 16.25C17.892 16.25 17.3207 16.2489 16.8555 16.302C16.3711 16.3574 15.9264 16.4781 15.5228 16.7693L16.4006 17.9857C16.5201 17.8994 16.6846 17.8313 17.0258 17.7923C17.3863 17.7511 17.8574 17.75 18.5696 17.75V16.25ZM15.4909 19.972C15.7161 19.2956 15.8662 18.8484 16.0193 18.5189C16.1643 18.2069 16.2809 18.072 16.4006 17.9857L15.5228 16.7693C15.1193 17.0605 14.8645 17.4444 14.659 17.8868C14.4615 18.3117 14.282 18.8545 14.0677 19.4982L15.4909 19.972ZM3.99769 17.75H5.61279V16.25H3.99769V17.75ZM8.69154 19.972L9.27917 21.7369L10.7024 21.2631L10.1147 19.4982L8.69154 19.972ZM5.61279 17.75C6.325 17.75 6.79611 17.7511 7.15658 17.7923C7.49784 17.8313 7.66228 17.8994 7.78185 17.9857L8.65958 16.7693C8.25598 16.4781 7.81137 16.3574 7.32692 16.302C6.86168 16.2489 6.29041 16.25 5.61279 16.25V17.75ZM10.1147 19.4982C9.90043 18.8545 9.7209 18.3117 9.52346 17.8868C9.31791 17.4445 9.06311 17.0605 8.65958 16.7693L7.78185 17.9857C7.90148 18.072 8.01815 18.2069 8.16314 18.5189C8.31624 18.8484 8.46634 19.2956 8.69154 19.972L10.1147 19.4982ZM4.10699 5.84723L4.52501 7.40909L5.97401 7.02128L5.556 5.45942L4.10699 5.84723ZM3.17811 10.9628L1.62739 11.9879L2.45454 13.2392L4.00526 12.2142L3.17811 10.9628ZM4.52501 7.40909C4.70933 8.09777 4.83021 8.55381 4.88378 8.91324C4.93452 9.25362 4.9114 9.43069 4.85896 9.56902L6.26156 10.1007C6.43795 9.63541 6.43932 9.17465 6.3674 8.69211C6.29831 8.22862 6.14941 7.67663 5.97401 7.02128L4.52501 7.40909ZM4.00526 12.2142C4.57077 11.8404 5.04807 11.5262 5.407 11.2252C5.78074 10.9119 6.08516 10.5661 6.26156 10.1007L4.85896 9.56902C4.80654 9.70729 4.70659 9.855 4.44321 10.0759C4.16501 10.3091 3.77244 10.57 3.17811 10.9628L4.00526 12.2142ZM18.485 5.45951L18.067 7.02137L19.516 7.40918L19.934 5.84732L18.485 5.45951ZM20.0357 12.2143L21.5864 13.2393L22.4136 11.988L20.8629 10.9629L20.0357 12.2143ZM18.067 7.02137C17.8916 7.67672 17.7427 8.22871 17.6736 8.6922C17.6017 9.17474 17.603 9.6355 17.7794 10.1008L19.182 9.56911C19.1296 9.43078 19.1065 9.25372 19.1572 8.91333C19.2108 8.5539 19.3316 8.09787 19.516 7.40918L18.067 7.02137ZM20.8629 10.9629C20.2685 10.5701 19.876 10.3092 19.5978 10.0759C19.3344 9.85509 19.2344 9.70739 19.182 9.56911L17.7794 10.1008C17.9558 10.5662 18.2602 10.912 18.634 11.2253C18.9929 11.5263 19.4702 11.8405 20.0357 12.2143L20.8629 10.9629ZM15.2257 2.61044L13.9054 3.54166L14.7699 4.76746L16.0903 3.83623L15.2257 2.61044ZM10.111 3.50061L8.61539 2.39659L7.72456 3.60341L9.22021 4.70744L10.111 3.50061ZM13.9054 3.54166C13.3231 3.9523 12.9373 4.22303 12.6189 4.39721C12.3174 4.56214 12.1438 4.60125 11.9966 4.59965L11.9803 6.09957C12.478 6.10495 12.9109 5.94721 13.3387 5.7132C13.7496 5.48845 14.2159 5.15817 14.7699 4.76746L13.9054 3.54166ZM9.22021 4.70744C9.76562 5.11004 10.2247 5.45033 10.6306 5.68391C11.0533 5.92712 11.4827 6.09418 11.9803 6.09957L11.9966 4.59965C11.8494 4.59806 11.6767 4.5552 11.3788 4.38379C11.0642 4.20276 10.6843 3.92375 10.111 3.50061L9.22021 4.70744ZM13.9757 11.4641C14.0179 11.4963 14.0475 11.5399 14.0627 11.589L15.4959 11.1465C15.3911 10.807 15.1828 10.4989 14.887 10.2726L13.9757 11.4641ZM14.0627 11.589C14.0773 11.6364 14.0779 11.6876 14.0626 11.737L15.4959 12.1794C15.6023 11.8349 15.5974 11.4754 15.4959 11.1465L14.0627 11.589ZM18.1938 9.14203L14.4923 10.6748L15.0662 12.0607L18.7677 10.5279L18.1938 9.14203ZM13.0504 8.86802C12.7371 8.62838 12.3624 8.50841 11.9885 8.50841V10.0084C12.0419 10.0084 12.0945 10.0253 12.1392 10.0595L13.0504 8.86802ZM11.9885 8.50841C11.6146 8.50841 11.2398 8.62838 10.9265 8.86802L11.8377 10.0595C11.8824 10.0253 11.935 10.0084 11.9885 10.0084V8.50841ZM12.7385 9.25841V5.34961H11.2385V9.25841H12.7385ZM13.3413 14.074C13.3259 14.1241 13.2962 14.166 13.2572 14.1967L14.1852 15.3752C14.4575 15.1608 14.6671 14.8646 14.7746 14.5164L13.3413 14.074ZM13.2572 14.1967C13.214 14.2308 13.1607 14.25 13.1036 14.25V15.75C13.5063 15.75 13.8846 15.6119 14.1852 15.3752L13.2572 14.1967ZM16.5291 16.887L14.2886 14.2954L13.1538 15.2765L15.3944 17.868L16.5291 16.887ZM10.8733 14.25C10.8162 14.25 10.7629 14.2308 10.7197 14.1967L9.79172 15.3752C10.0923 15.6119 10.4706 15.75 10.8733 15.75V14.25ZM10.7197 14.1967C10.6807 14.166 10.651 14.1241 10.6356 14.074L9.20232 14.5164C9.3098 14.8646 9.51943 15.1608 9.79172 15.3752L10.7197 14.1967ZM8.81059 17.8407L10.8456 15.2492L9.66584 14.3228L7.63084 16.9143L8.81059 17.8407ZM9.91426 11.737C9.89899 11.6876 9.89961 11.6364 9.91426 11.589L8.48099 11.1465C8.37949 11.4754 8.37465 11.8349 8.48098 12.1794L9.91426 11.737ZM9.91426 11.589C9.9294 11.5399 9.95905 11.4963 10.0012 11.4641L9.08995 10.2726C8.79412 10.4989 8.58579 10.807 8.48099 11.1465L9.91426 11.589ZM9.48889 10.6766L5.85153 9.14373L5.269 10.526L8.90636 12.0589L9.48889 10.6766Z"
                                            fill="currentColor"></path>
                                    </g>
                                </svg>
                                <svg v-if="event.type === 'yellow_card' || event.type === 'red_card'"
                                    :class="`h-7 w-7 text-${event.type === 'yellow_card' ? 'yellow' : 'red'}-500`"
                                    version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 34.598 34.598"
                                    xml:space="preserve" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <g>
                                                <path style="fill:currentColor;"
                                                    d="M22.433,5.915L19.737,0L1.094,8.498l11.898,26.1l0.023-0.012v0.012h20.489V5.915L22.433,5.915 L22.433,5.915z M2.695,9.421l16.69-7.608l1.87,4.102h-8.239v26.147L2.695,9.421z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-primary">{{ event.team.name }}</p>
                                <h3 class="font-medium text-gray-900">{{ strEvent(event.type) }}</h3>
                                <p class="text-sm text-gray-500">{{ event.minute }}' <span v-if="event.added_time"> + {{
                                    event.added_time }}</span> • {{ event.player_name }} </p>
                            </div>
                        </div>
                        <button @click="deleteEvent(event)"
                            class="text-gray-400 hover:text-red-500 p-1 rounded-full hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </template>
                <template v-else>
                    <EmptyView  model="Évènement"/>
                </template>
            </div>
        </div>
    </div>
    <ShootsOnGoal :game="game" :show="showShoots" @close="showShoots = false" />
    <Event :show="showEvent" :game="game" @close="showEvent = false" />
    <UnpostponeGame :show="showUnpostpone" :game="game" @close="showUnpostpone = false" />
    <CreateOrUpdateResults :show="showCreateorUpdateResult" :game="game" @close="showCreateorUpdateResult = false" />
</template>
<script setup>
import EmptyView from '../../components/ui/EmptyView.vue';
import Event from '../../components/modal/Event.vue'
import { formatDate, gameStatus, statusClass, strEvent } from '../../Utils/utils';
import { useConfirmStore } from '../../store/confirmStore';
import { useToasterStore } from '../../store/Toast';
import UnpostponeGame from '../../components/modal/UnpostponeGame.vue';
import CreateOrUpdateResults from '../../components/modal/CreateOrUpdateResults.vue';

import { router, useForm } from '@inertiajs/vue3'
import { ref } from 'vue';
import ShootsOnGoal from '../../components/modal/ShootsOnGoal.vue';

const props = defineProps({
    game: Object,
    events: Array,
    auth: Object,
});

const showShoots = ref(false);
const openShoots = async () => {
    showShoots.value = true;
}
const showEvent = ref(false);
const openEvent = async () => {
    showEvent.value = true;
}

const confirm = useConfirmStore();

const deleteEvent = async (event) => {
    const isConfirmed = await confirm.show({
        title: 'Confirmation de suppression',
        message: 'Attention : la suppression entraînera la perte définitive des données.',
    })
    if (isConfirmed) {
        router.delete(`/edition/championnat/match/event/${event.id}`, {
            onSuccess: () => {
                useToasterStore().success({ text: 'Evenement suprimmer' })
            }
        });
    }
}


const score = useForm({
    gameId: props.game.id,
    teamAGoal: props.game.team_a_goals,
    teamBGoal: props.game.team_b_goals,
});


const deleteGame = async () => {
    const isConfirmed = await confirm.show({
        title: 'Confirmation de suppression',
        message: 'Attention : la suppression entraînera la perte définitive des données.',
    })
    if (isConfirmed) {
        router.delete(`/edition/championnat/match/supprimer/${props.game.id}`, {
            onSuccess: () => {
                useToasterStore().success({ text: 'Match supprimé' })
            }
        });
    }
}

const showCreateorUpdateResult = ref(false);

const updateScore = async () => {
    showCreateorUpdateResult.value = true;
}


const postpone = async () => {
    const isConfirmed = await confirm.show({
        title: "Reporter le match",
        message: `Le match ${props.game.team_a.name} - ${props.game.team_b.name} sera reporté. Confirmez-vous cette décision ?`
    })

    if (isConfirmed) {
        router.put(`/edition/championnat/match/reporte/${props.game.id}`, {},
            {
                onSuccess: () => {
                    useToasterStore().success({ text: 'Match Repoter' })
                }
            }
        );
    }
}

const live = async () => {
    const isConfirmed = await confirm.show({
        title: "Match en cours",
        message: `Voulez-vous marquer le match ${props.game.team_a.name} vs ${props.game.team_b.name} comme étant en cours ?`,
    })

    if (isConfirmed) {
        router.put(`/edition/championnat/match/en-direct/${props.game.id}`, {},
            {
                onSuccess: () => {
                    useToasterStore().success({ text: 'Match Repoter' })
                }
            }
        );
    }
}



const showUnpostpone = ref(false);

const unpostpone = () => {
    showUnpostpone.value = true
}

const end = async () => {
    const isConfirmed = await confirm.show({
        title: "Marquer le match comme terminé",
        message: `Cette action enregistrera le score final et clôturera le match. Confirmez-vous ?`
    })

    if (isConfirmed) {
        router.put(`/edition/championnat/match/terminer/${props.game.id}`, {}, {
            onSuccess: () => {
                useToasterStore().success({ text: 'Match Marqur comme terminer' })
            }
        })
    }
}
</script>
