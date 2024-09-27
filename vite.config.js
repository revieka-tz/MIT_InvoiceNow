import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],

    // bydefault not using this
    server: {
        host: 'localhost',  // Allows access from other devices on the network
        // hmr: {
        //     host: '192.168.1.8',  // Replace with your IP address for hot module reloading (HMR)
        // },
        https: true,
    },
});
