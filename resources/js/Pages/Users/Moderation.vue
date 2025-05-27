<template>

    <Head>
        <title>Moderation</title>
    </Head>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Modération des Utilisateurs</h1>

        <!-- Barre de recherche -->
        <div class="mb-6">
            <form @submit.prevent="submitSearch" class="relative">
                <input type="text" v-model="search" placeholder="Rechercher un utilisateur..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-3 top-2.5 text-gray-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </form>
        </div>

        <!-- Tableau des utilisateurs -->
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 w-full text-sm text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Telephone
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="userTable">
                    <tr v-for="user in users.data" :key="user.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ user.first_name }} {{ user.last_name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ user.email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ user.phone }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div v-if="auth?.user.id === user.id" class="h-7 w-40 bg-gray-200 border capitalize border-gray-300 rounded px-2 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">{{ roles(user.roles) }}</div>
                            <select v-else v-model="user.roles"
                                class="h-7 w-40 border border-gray-300 rounded px-2 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="user">Utilisateur</option>
                                <option value="editor">Editeur</option>
                                <option value="reporter">Jornaliste</option>
                                <option value="admin">Administrateur</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button v-if="auth?.user.id !== user.id" class="text-blue-600 hover:text-blue-900 mr-3"
                                @click="save(user.id, user.roles)">Enregistrer</button>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>


        <!-- Pagination dynamique -->
        <div class="mt-6 flex flex-col md:flex-row justify-between items-center">
            <!-- Résumé -->
            <div class="text-sm text-gray-600 mb-4 md:mb-0">
                Affichage de <span class="font-semibold">{{ users.from }}</span>
                à <span class="font-semibold">{{ users.to }}</span>
                sur <span class="font-semibold">{{ users.total }}</span> utilisateurs
            </div>

            <!-- Liens de pagination -->
            <div class="flex flex-wrap gap-1">
                <template v-for="(link, index) in users.links" :key="index">
                    <component :is="link.url ? Link : 'span'" :href="link.url || ''" v-html="link.label"
                        class="px-3 py-1 text-sm border rounded" :class="{
                            'bg-blue-500 text-white font-semibold border-blue-500': link.active,
                            'bg-white text-gray-700 hover:bg-gray-100': !link.active && link.url,
                            'text-gray-400 cursor-not-allowed': !link.url
                        }" />
                </template>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useToasterStore } from '../../store/Toast';
import { roles } from '../../Utils/utils';
const props = defineProps({
    users: Object,
    filters: Object,
    auth: Object,
});

const search = ref(props.filters?.search || '');

function submitSearch() {
    router.get('', { search: search.value }, {
        preserveState: true,
        preserveScroll: true,
    });
}

const save = (userId, role) => {
    router.put('', { userId: userId, roles: role }, {
        onSuccess: () => {
            useToasterStore().success({ text: 'Modification reussie avec success' });
        }
    });
}
</script>
