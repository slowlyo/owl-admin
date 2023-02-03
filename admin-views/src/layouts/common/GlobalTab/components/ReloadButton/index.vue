<template>
	<hover-container class="w-64px h-full"
	                 :tooltip-content="t('admin.refresh')"
	                 placement="bottom-end"
	                 @click="handleRefresh">
		<icon-mdi-refresh class="text-22px" :class="{ 'animate-spin': loading }"/>
	</hover-container>
</template>

<script setup lang="ts">
import {useAppStore} from '@/store';
import {useLoading} from '@/hooks';
import {t} from '@/locales';

defineOptions({name: 'ReloadButton'});

const app = useAppStore();
const {loading, startLoading, endLoading} = useLoading();

function handleRefresh() {
	startLoading();
	app.reloadPage();
	setTimeout(() => {
		endLoading();
	}, 1000);
}
</script>

<style scoped></style>
