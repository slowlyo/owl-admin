<template>
	<n-divider title-placement="center">主题配置</n-divider>
	<textarea id="themeConfigCopyTarget" v-model="dataClipboardText" class="absolute opacity-0"/>
	<n-space vertical>
		<div ref="copyRef" data-clipboard-target="#themeConfigCopyTarget">
			<n-button type="primary" :block="true" @click="save">保存当前配置</n-button>
		</div>
		<n-button type="warning" :block="true" @click="handleResetConfig">重置当前配置</n-button>
	</n-space>
</template>

<script setup lang="ts">
import {onUnmounted, ref, watch} from 'vue';
import {useThemeStore} from '@/store';
import {saveSettings} from "@/service";

defineOptions({name: 'ThemeConfig'});

const theme = useThemeStore();

const copyRef = ref<HTMLElement>();

const dataClipboardText = ref(getClipboardText());

function getClipboardText() {
	return JSON.stringify(theme.$state);
}

function handleResetConfig() {
	theme.resetThemeStore();
	window.$message?.success('已重置配置, 请手动保存配置信息！');
}

const stopHandle = watch(
	() => theme.$state,
	() => {
		dataClipboardText.value = getClipboardText();
	},
	{deep: true}
);

const save = () => {
	let data = {
		'system_theme_setting': dataClipboardText.value
	}

	saveSettings(data).then(() => {
		window.$message?.success('保存成功')
		setTimeout(() => {
			window.location.reload()
		}, 700)
	})
}

onUnmounted(() => {
	stopHandle();
});
</script>

<style scoped></style>
