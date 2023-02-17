<template>
	<n-config-provider
		:theme="theme.naiveTheme"
		:theme-overrides="theme.naiveThemeOverrides"
		:locale="zhCN"
		:date-locale="dateZhCN"
		class="h-full"
	>
		<naive-provider>
			<router-view/>
		</naive-provider>
	</n-config-provider>
</template>

<script setup lang="ts">
import {dateZhCN, zhCN, enUS, dateEnUS} from "naive-ui"
import {subscribeStore, useAppStore, useThemeStore} from "@/store"
import {useGlobalEvents} from "@/composables"
import {fetchSettings} from "@/service"
import {settings} from "@/utils"
import {ref} from "vue"
import {setLocale} from "@/locales"
import {registerCustomComponent} from "@/views/amis/CustomComponent"

const theme = useThemeStore()

const locale = ref(zhCN)
const dateLocale = ref(dateZhCN)

subscribeStore()
useGlobalEvents()
// 获取设置
fetchSettings().then((res: any) => {
	settings.setStore(useAppStore()).setSettings(res.data)

	let info = JSON.parse(res?.data?.system_theme_setting)
	theme.mergeThemeSetting(info)

	let loc = res?.data?.locale

	if (loc == "en") {
		locale.value = enUS
		dateLocale.value = dateEnUS
		setLocale("en")
	} else {
		locale.value = zhCN
		dateLocale.value = dateZhCN
		setLocale("zh-CN")
	}

	settings.dynamicAssetsHandler(res?.data?.assets)
})

// 注册自定义组件
registerCustomComponent()
</script>

<style scoped></style>
