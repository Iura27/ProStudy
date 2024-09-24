import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Adicione o arquivo CSS aqui
                'resources/js/app.jsx',
            ],
            refresh: true,
        }),
        react(),
    ],
});
