import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import tailwindScrollbarHide from 'tailwind-scrollbar-hide'; // Ganti require dengan import

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
        require('tailwind-scrollbar-hide'),
    ],
});


// import { defineConfig } from 'vite'
// import laravel from 'laravel-vite-plugin'

// export default defineConfig({
//   plugins: [
//     laravel({
//       input: [
//         'resources/css/app.css',
//         'resources/js/app.js'
//       ],
//       refresh: true
//     })
//   ],
//   css: {
//     postcss: {
//       plugins: [
//         require('tailwindcss'),
//         require('autoprefixer')
//       ]
//     }
//   }
// })