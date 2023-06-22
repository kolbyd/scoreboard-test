import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    server: {
        hmr: {
            host: 'scoreboard.kolbyd.ca',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/Components/Manager/index.jsx',
                'resources/js/Components/Scorebug/index.jsx'
            ],
            refresh: true,
        }),
        react(),
    ],
});
