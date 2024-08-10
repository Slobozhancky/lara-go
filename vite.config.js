import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/bootstrap/bootstrap.min.css', 'resources/bootstrap/bootstrap.min.js', 'resources/css/main.css'],
            refresh: true,
        }),
    ],
});
