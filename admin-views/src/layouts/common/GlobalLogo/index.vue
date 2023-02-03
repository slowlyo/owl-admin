<template>
	<router-link :to="routeHomePath" class="flex-center w-full nowrap-hidden">
		<system-logo class="h-45px"/>
		<h2 v-show="showTitle"
		    class="pl-8px text-16px font-bold text-primary transition duration-300 ease-in-out"
		    @click="toggleLocal">
			{{ getSettingItem("app_name") }}
		</h2>
	</router-link>
</template>

<script setup lang="ts">
import {routePath} from '@/router';
import {setLocale} from '@/locales';
import {settings} from "@/utils";
import {useAppStore} from "@/store";

const getSettingItem = (key: string) => settings.setStore(useAppStore()).getSettingItem(key)

defineOptions({name: 'GlobalLogo'});

interface Props {
	/** 显示名字 */
	showTitle: boolean;
}

defineProps<Props>();

const routeHomePath = routePath('root');

let flag = true;

function toggleLocal() {
	flag = !flag;
	setLocale(flag ? 'en' : 'zh-CN');
}
</script>

<style scoped></style>
