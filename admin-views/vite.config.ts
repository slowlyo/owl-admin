import {defineConfig, loadEnv} from "vite"
import react from "@vitejs/plugin-react"
// @ts-ignore
import svgrPlugin from "@arco-plugins/vite-plugin-svgr"
import compression from "vite-plugin-compression"
import vitePluginForArco from "@arco-plugins/vite-react"
import UnoCSS from "unocss/vite"
import {createViteProxy} from "./src/utils/proxy"

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
            UnoCSS({}),
            react(),
            svgrPlugin({
                svgrOptions: {},
            }),
            vitePluginForArco({
                theme: "@arco-design/theme-line",
                modifyVars: {},
            }),
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
