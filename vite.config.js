import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [ 'resources/css/style.css',
                'resources/css/app.css', 
                'resources/css/styleguide.css',
                'resources/css/globals.css',
                'resources/js/app.js',
                'resources/js/script.js'],
          
            refresh: true,
        }),
    ],
});
