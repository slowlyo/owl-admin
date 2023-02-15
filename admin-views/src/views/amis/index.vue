<template>
	<div id="amis-region"></div>
</template>

<script lang="ts" setup>
// 当前页面的路由信息
import {useRoute} from "vue-router"
import {amisRequest, initPageSchema} from "@/service"
import {useRouterPush} from "@/composables"
import {settings} from "@/utils"
import {useAppStore} from "@/store"
import {setupCustomComponent} from "@/views/amis/CustomComponent"

const route = useRoute()
const router = useRouterPush()
// @ts-ignore
const amis = amisRequire("amis/embed")
// @ts-ignore
const amisLib = amisRequire("amis")


// 注册自定义组件
setupCustomComponent(amisLib)

const options = {
	fetcher: ({url, method, data}: any) => amisRequest(url, method, data),
	jumpTo: (location: string, action: any) => {
		if (action?.blank) {
			window.open(location)
		} else {
			router.routerPush(location)
		}
	},
	updateLocation: () => {
	}
}

const render = (schema: any) => {
	let locale = settings.setStore(useAppStore()).getSettingItem("locale") || "zh-CN"

	const config = {
		locale: locale == "en" ? "en-US" : locale,
	}

	amis.embed("#amis-region", schema, config, options)
}

const initPage = () => {
	initPageSchema(route.path).then(res => render(res.data))
}

initPage()
</script>

<style scoped>
#amis-region {
	overflow: inherit;
}
</style>
