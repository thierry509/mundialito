<template>

    <Head>
        <title>Les Matchs de la compétition </title>
    </Head>
    <div class="min-h-screen bg-gray-100 p-6">
        <div class="max-w-7xl mx-auto">
            <!-- En-tête -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">
                    Signalements ({{ reports.length }})
                </h1>
                <p class="text-gray-600">Gestion des commentaires signalés</p>
            </div>

            <!-- Liste des signalements -->
            <div v-if="reports.length > 0" class="space-y-4">
                <div v-for="report in reports" :key="report.id" class="bg-white p-6 rounded-lg border border-gray-200">
                    <!-- Commentaire signalé -->
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-900 mb-2">Commentaire signalé :</h3>
                        <div class="bg-gray-50 p-4 rounded border">
                            <p class="text-gray-800">{{ report.comment.content }}</p>
                            <p class="text-xs text-gray-500 mt-2">
                                Par <span class="font-medium">{{ report.comment.user.name }}</span>
                                le {{ formatDateTime(report.comment.created_at) }}
                            </p>
                        </div>
                    </div>

                    <!-- Raison du signalement -->
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-900 mb-2">Raison du signalement :</h3>
                        <p class="text-gray-700">{{ report.reason }}</p>
                        <p class="text-xs text-gray-500 mt-2">
                            Signalé par <span class="font-medium">{{ report.user.name }}</span>
                            le {{ formatDateTime(report.created_at) }}
                        </p>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                        <button @click="rejectReport(report.id)"
                            class="px-4 py-2 text-sm text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition">
                            Ignorer le signalement
                        </button>
                        <button @click="deleteComment(report.comment_id)"
                            class="px-4 py-2 text-sm text-white bg-red-600 rounded-md hover:bg-red-700 transition">
                            Supprimer le commentaire
                        </button>
                    </div>
                </div>
            </div>

            <!-- Aucun signalement -->
            <div v-else class="bg-white p-8 rounded-lg border border-gray-200 text-center">
                <p class="text-gray-500 text-lg">Aucun signalement à traiter</p>
                <p class="text-gray-400 text-sm mt-2">Tous les signalements ont été traités</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { useConfirmStore } from '../../store/confirmStore'
import { router } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    reports: Array
})

const form = useForm({})

const confirmStore = useConfirmStore();

const deleteComment = async (commentId) => {
    const isConfirmed = await confirmStore.show({
        title: 'Confirmation de suppression',
        message: 'Attention : la suppression entraînera la perte définitive des données.',
    });

    if (isConfirmed) {
        router.delete(`/comments/${commentId}`, {
            onSuccess: () => window.location.reload()
        });
    }
}

const rejectReport = async (reportId) => {
    const isConfirmed = await confirmStore.show({
        title: 'Ignorer le signalement',
        message: 'Le commentaire restera visible. Confirmez-vous l’ignorance de ce signalement ?',
    });

    if (isConfirmed) {
        form.put(`/reports/${reportId}/reject`, {
            onSuccess: () => window.location.reload()
        });
    }
}

const formatDateTime = (date) => {
    return new Date(date).toLocaleDateString('fr-FR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    })
}
</script>
