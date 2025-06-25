import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import { ZiggyVue, route } from 'ziggy-js'
import { Ziggy } from './ziggy'
import { router } from '@inertiajs/vue3';

createInertiaApp({
    resolve: name => {
        // Convertit la notation par points en chemin de fichier
        const path = name.replace(/\./g, '/')
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })

        // Essayer d'abord avec le chemin complet
        let page = pages[`./Pages/${path}.vue`]

        // Si non trouvé, essayer avec index.vue
        if (!page) {
            page = pages[`./Pages/${path}/index.vue`]
        }

        if (!page) {
            throw new Error(`Page not found: ${name} (tried: ./Pages/${path}.vue and ./Pages/${path}/index.vue)`)
        }

        // Logique des layouts (seulement si la page existe)
        const layoutName = name.split('.')[0] // Prend le premier segment (avant le premier point)
        const layouts = import.meta.glob('./Layouts/*.vue', { eager: true })

        let layout = layouts['./Layouts/Layout.vue'] // Layout par défaut
        if (layouts[`./Layouts/${layoutName}Layout.vue`]) {
            layout = layouts[`./Layouts/${layoutName}Layout.vue`]
        }

        if (page.default.layout === undefined && layout) {
            page.default.layout = layout.default
        }

        return page
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
        const pinia = createPinia();
        pinia.use(piniaPluginPersistedstate)
        app.config.globalProperties.$route = route;
        app.use(plugin)
        app.use(ZiggyVue, Ziggy)
        app.use(pinia);
        app.mount(el)
    },
});


