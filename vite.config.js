import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/guest.css',
                'resources/css/admin.css',
                'resources/css/auth.css',
                'resources/css/kontributor.css',

                'resources/css/home.css',
                'resources/css/kontak.css',
                'resources/css/tentang.css',
                'resources/css/kegiatan.css',
                'resources/css/guest/rating.css',
                'resources/css/kontributor/rating.css',

                'resources/js/app.js',
                'resources/js/guest.js',
                'resources/js/admin.js',
                'resources/js/auth.js',
                'resources/js/kontributor.js',
            ],

            refresh: true,
        }),
    ],
});