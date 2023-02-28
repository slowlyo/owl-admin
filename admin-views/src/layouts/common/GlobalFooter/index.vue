<template>
	<dark-mode-container class="flex-center h-full">
		<div v-html="settings.setStore(useAppStore()).getSettingItem('footer')"></div>
	</dark-mode-container>
</template>

<script setup lang="ts">
import {settings} from "@/utils"
import {useAppStore} from "@/store"

defineOptions({name: "GlobalFooter"})
</script>

<style scoped></style>
