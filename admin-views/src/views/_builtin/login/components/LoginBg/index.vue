<template>
	<div class="absolute-lt z-1 wh-full overflow-hidden">
		<div class="header">
			<div class="inner-header flex"></div>
			<div>
				<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
				     viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
					<defs>
						<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"/>
					</defs>
					<g class="parallax">
						<use xlink:href="#gentle-wave" x="48" y="0" :fill="waveColor(waveColorValue, 0.7)"/>
						<use xlink:href="#gentle-wave" x="48" y="3" :fill="waveColor(waveColorValue, 0.5)"/>
						<use xlink:href="#gentle-wave" x="48" y="5" :fill="waveColor(waveColorValue, 0.3)"/>
						<use xlink:href="#gentle-wave" x="48" y="7" :fill="waveColor(waveColorValue, 1)"/>
					</g>
				</svg>
			</div>
		</div>
		<div class="content flex h-full" :style="{background: waveColor(waveColorValue, 1)}"></div>
	</div>
</template>

<script lang="ts" setup>
import {computed} from 'vue';
import {getColorPalette} from '@/utils';
import {useThemeStore} from "@/store";

interface Props {
	/** 主题颜色 */
	themeColor: string;
}

const theme = useThemeStore()

const waveColorValue = computed(() => (theme.darkMode ? 220 : 255));

const waveColor = (value: number, opacity: number) => `rgba(${value}, ${value}, ${value}, ${opacity})`;

const props = defineProps<Props>();

const lightColor = computed(() => getColorPalette(props.themeColor, 1));
const darkColor = computed(() => getColorPalette(props.themeColor, 5));
</script>

<style scoped>
.header {
	position: relative;
	text-align: center;
	background: linear-gradient(200deg, v-bind(lightColor) 0%, v-bind(darkColor) 100%);
	color: white;
}

.inner-header {
	height: 65vh;
	width: 100%;
	margin: 0;
	padding: 0;
}

.flex { /*Flexbox for containers*/
	display: flex;
	justify-content: center;
	align-items: center;
	text-align: center;
}

.waves {
	position: relative;
	width: 100%;
	height: 15vh;
	margin-bottom: -7px; /*Fix for safari gap*/
	min-height: 100px;
	max-height: 150px;
}

/* Animation */

.parallax > use {
	animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
}

.parallax > use:nth-child(1) {
	animation-delay: -2s;
	animation-duration: 7s;
}

.parallax > use:nth-child(2) {
	animation-delay: -3s;
	animation-duration: 10s;
}

.parallax > use:nth-child(3) {
	animation-delay: -4s;
	animation-duration: 13s;
}

.parallax > use:nth-child(4) {
	animation-delay: -5s;
	animation-duration: 20s;
}

@keyframes move-forever {
	0% {
		transform: translate3d(-90px, 0, 0);
	}
	100% {
		transform: translate3d(85px, 0, 0);
	}
}

/*Shrinking for mobile*/
@media (max-width: 768px) {
	.waves {
		height: 40px;
		min-height: 40px;
	}
}
</style>
