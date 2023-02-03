<template>
	<n-dropdown :options="options" @select="handleDropdown">
		<hover-container class="px-12px" :inverted="theme.header.inverted">
			<n-avatar round size="medium" :src="auth.userInfo.avatar" v-if="auth.userInfo.avatar"/>
			<icon-local-avatar class="text-32px" v-else/>
			<span class="pl-8px text-14px font-medium">{{ auth.userInfo.name }}</span>
		</hover-container>
	</n-dropdown>
</template>

<script lang="ts" setup>
import type {DropdownOption} from 'naive-ui';
import {useAuthStore, useThemeStore} from '@/store';
import {useIconRender, useRouterPush} from '@/composables';
import {t} from '@/locales';
import {computed, reactive} from "vue";

defineOptions({name: 'UserAvatar'});

const auth = useAuthStore();
const theme = useThemeStore();
const router = useRouterPush()
const {iconRender} = useIconRender();

const options: DropdownOption[] | any = reactive([
	{
		label: computed(() => t('admin.user_settings')),
		key: 'user-center',
		icon: iconRender({icon: 'carbon:user-avatar'})
	},
	{
		type: 'divider',
		key: 'divider'
	},
	{
		label: computed(() => t('admin.logout')),
		key: 'logout',
		icon: iconRender({icon: 'carbon:logout'})
	}
]);

type DropdownKey = 'user-center' | 'logout';

function handleDropdown(optionKey: string) {
	const key = optionKey as DropdownKey;
	if (key === 'logout') {
		window.$dialog?.info({
			title: t('admin.tips'),
			content: t('admin.logout_tips'),
			positiveText: t('admin.confirm'),
			negativeText: t('admin.cancel'),
			onPositiveClick: () => {
				auth.resetAuthStore();
			}
		});
	}

	if (key === 'user-center') {
		router.routerPush('/user_setting')
	}
}
</script>

<style scoped></style>
