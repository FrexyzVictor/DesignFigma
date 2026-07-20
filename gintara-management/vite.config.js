import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/customers.css',
                'resources/js/customers.js',
                // ...other existing entries (app.js, dll)
            ],
            refresh: true,
        }),
    ],
});