/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './index.html',
        './src/**/*.{js,ts,jsx,tsx}',
        '*'
    ],
    theme  : {
        extend: {
            borderRadius: {
                DEFAULT: '6px',
            }
        },
    },
    plugins: [],
    corePlugins: {
        preflight: false,
    }
}

