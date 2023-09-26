import {defineConfig, loadEnv} from 'vite'
import react from '@vitejs/plugin-react'
import compression from 'vite-plugin-compression'
import {createViteProxy} from './src/utils/proxy'

// https://vitejs.dev/config/
export default defineConfig(configEnv => {
    const viteEnv = loadEnv(configEnv.mode, process.cwd())

    return {
        base: viteEnv.VITE_BASE_URL,
        resolve: {
            alias: [
                {find: "@", replacement: "/src"},
                {find: "moment/locale/zh-cn", replacement: "moment/dist/locale/zh-cn"}
            ],
        },
        plugins: [
            react(),
            compression(),
        ],
        css: {
            preprocessorOptions: {
                less: {
                    javascriptEnabled: true,
                },
            },
        },
        server: {
            host: "0.0.0.0",
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
