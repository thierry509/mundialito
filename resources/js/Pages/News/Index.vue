<template>

    <Head>
        <title>actualités</title>
    </Head>
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-8 flex justify-between items-center">
                <h1 class="text-3xl font-bold text-primary">Actualités</h1>
                <Link href="/edition/actualites/creer">

                <button class="bg-primary hover:bg-green-700 text-white px-4 py-2 rounded-md flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nouvelle actualité
                </button>
                </Link>

            </div>
            <!-- News Table -->
            <div v-if="news?.length > 0" class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Mes actualités</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    <div v-for="item in news" :key="item?.id" class="px-6 py-4 hover:bg-gray-50 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div v-if="item.image" class="flex-shrink-0">
                                    <img class="h-12 w-12 rounded-md object-cover" :src="item?.image?.url"
                                        :alt="item?.image?.description">
                                </div>
                                <div>
                                    <a :href="`/actualites/${item.slug}`" class="text-lg font-medium text-primary">{{
                                        item.title }}</a>
                                    <p class="text-sm text-gray-500">Publié le {{ (item.created_at_local) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-6">
                                <div class="text-center">
                                    <!-- <p class="text-sm text-gray-500">Vues</p>
                                    <p class="font-medium">1245</p> -->
                                </div>
                                <div class="flex space-x-2">
                                    <Link :href="`/edition/actualites/modifier/${item.slug}`">
                                    <button class="text-accent hover:text-blue-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    </Link>
                                    <button class="text-danger hover:text-red-700" @click="deleteNews(item.slug)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <EmptyView v-else model="Actualite" class="bg-white rounded-2xl py-8" />
        </div>
    </div>
</template>
<script setup>
import { Link, Head } from '@inertiajs/vue3';
import EmptyView from '../../components/ui/EmptyView.vue'
import { formatDate } from '../../Utils/utils';
import { useToasterStore } from '../../store/Toast';
import { useConfirmStore } from '../../store/confirmStore';
import { router } from '@inertiajs/vue3';

defineProps({
    news: {
        type: Array,
        default: [],
    },
})

const confirm = useConfirmStore();
const deleteNews = async (slug) => {
    const isConfirmed = await confirm.show({
        title: 'Confirmation de suppression',
        message: 'Attention : la suppression entraînera la perte définitive des données.',
    })
    if (isConfirmed) {
        router.delete(`/edition/actualites/supprimer/${slug}`, {
            onSuccess: () => {
                useToasterStore().success({ text: 'Actualité supprimée' })
            }
        });
    }
}
</script>
