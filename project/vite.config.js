import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});


// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';
// import tailwindcss from '@tailwindcss/vite';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//         tailwindcss(),
//     ],

//     server: {
//         host: '0.0.0.0',           // ← এটি পরিবর্তন করুন
//         port: 5173,
//         strictPort: true,
//         cors: true,

//         hmr: {
//             host: '127.0.0.1',     // ← এটি রাখুন
//             port: 5173,
//             protocol: 'ws',
//         },

//         watch: {
//             ignored: ['**/storage/framework/views/**'],
//         },
//     },
// });
