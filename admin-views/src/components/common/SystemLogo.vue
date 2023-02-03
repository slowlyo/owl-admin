<template>
	<n-image :src="getSettingItem('logo')" preview-disabled object-fit="scale-down"/>
</template>

<script lang="ts" setup>

import {settings} from "@/utils";
import {useAppStore} from "@/store";

defineOptions({name: 'SystemLogo'});

interface Props {
	/** logo是否填充 */
	fill?: boolean;
}

withDefaults(defineProps<Props>(), {
	fill: false
});

const getSettingItem = (key: string) => settings.setStore(useAppStore()).getSettingItem(key)

</script>

<style scoped></style>
