// https://umijs.org/config/
import { defineConfig } from "@umijs/max";
import defaultSettings from "./defaultSettings";
import proxy from "./proxy";
import routes from "./routes";

const { REACT_APP_ENV = "dev" } = process.env;
const isDev = REACT_APP_ENV === "dev";

export default defineConfig({
  hash: true,

  // targets: {
  //   ie: 11,
  // },
  routes,
  theme: {
    "root-entry-name": "variable",
  },
  ignoreMomentLocale: true,
  proxy: isDev ? proxy : {},
  fastRefresh: true,
  model: {},
  initialState: {},
  title: "Ant Design Pro",
  layout: {
    locale: true,
    ...defaultSettings,
  },
  moment2dayjs: {
    preset: "antd",
    plugins: ["duration"],
  },
  locale: {
    // default zh-CN
    default: "zh-CN",
    antd: true,
    // default true, when it is true, will use `navigator.language` overwrite default
    baseNavigator: true,
  },
  antd: {},
  request: {},
  headScripts: [
    // 解决首次加载时白屏的问题
    { src: "/scripts/loading.js", async: true },
    'window.$adminApiPrefix = "/admin-api"',
  ],

  //================ pro 插件配置 =================
  presets: ["umi-presets-pro"],
  mfsu: {
    strategy: "normal",
  },
  requestRecord: {},
  tailwindcss: {},
});
