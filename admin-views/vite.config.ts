import {defineConfig, loadEnv} from 'vite'
import react from '@vitejs/plugin-react'
import compression from 'vite-plugin-compression'
import progress from 'vite-plugin-progress'
import {createViteProxy} from "./src/utils/proxy"

// https://vitejs.dev/config/
export default defineConfig(configEnv => {
    const viteEnv = loadEnv(configEnv.mode, process.cwd())
    return {
        base: viteEnv.VITE_BASE_URL,
        plugins: [
            react(),
            compression(),
            progress()
        ],
        resolve: {
            alias: [
                {find: '@', replacement: '/src'},
            ],
        },
        server: {
            host: '0.0.0.0',
            port: 3200,
            open: true,
            proxy: createViteProxy(viteEnv),
        },
        build: {
            sourcemap: false,
            reportCompressedSize: false,
        }
    }
})
