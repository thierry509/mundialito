import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        hmr: {
            host: '192.168.150.85',
        },
        port:5173,
    },
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/index.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    // Permet à Vite de gérer correctement les URLs des assets dans les templates Vue
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],

});
