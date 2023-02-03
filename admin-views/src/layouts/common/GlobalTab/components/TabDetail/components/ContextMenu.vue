<template>
  <n-dropdown
    :show="dropdownVisible"
    :options="options"
    placement="bottom-start"
    :x="x"
    :y="y"
    @clickoutside="hide"
    @select="handleDropdown"
  />
</template>

<script setup lang="ts">
import { computed } from 'vue';
import type { DropdownOption } from 'naive-ui';
import { useAppStore, useTabStore } from '@/store';
import { useIconRender } from '@/composables';
import {t} from "@/locales"

defineOptions({ name: 'ContextMenu' });

interface Props {
  /** 右键菜单可见性 */
  visible?: boolean;
  /** 当前路由路径 */
  currentPath?: string;
  /** 是否固定在tab卡不可关闭  */
  affix?: boolean;
  /** 鼠标x坐标 */
  x: number;
  /** 鼠标y坐标 */
  y: number;
}

const props = withDefaults(defineProps<Props>(), {
  visible: false,
  currentPath: ''
});

interface Emits {
  (e: 'update:visible', visible: boolean): void;
}

const emit = defineEmits<Emits>();

const app = useAppStore();
const tab = useTabStore();
const { iconRender } = useIconRender();

const dropdownVisible = computed({
  get() {
    return props.visible;
  },
  set(visible: boolean) {
    emit('update:visible', visible);
  }
});

function hide() {
  dropdownVisible.value = false;
}

type DropdownKey = 'reload-current' | 'close-current' | 'close-other' | 'close-left' | 'close-right' | 'close-all';
type Option = DropdownOption & {
  key: DropdownKey;
};

const options = computed<Option[]>(() => [
  {
    label: t('admin.context_menu.refresh'),
    key: 'reload-current',
    disabled: props.currentPath !== tab.activeTab,
    icon: iconRender({ icon: 'ant-design:reload-outlined' })
  },
  {
    label: t('admin.context_menu.close'),
    key: 'close-current',
    disabled: props.currentPath === tab.homeTab.fullPath || Boolean(props.affix),
    icon: iconRender({ icon: 'ant-design:close-outlined' })
  },
  {
    label: t('admin.context_menu.close_others'),
    key: 'close-other',
    icon: iconRender({ icon: 'ant-design:column-width-outlined' })
  },
  {
    label: t('admin.context_menu.close_left'),
    key: 'close-left',
    icon: iconRender({ icon: 'mdi:format-horizontal-align-left' })
  },
  {
    label: t('admin.context_menu.close_right'),
    key: 'close-right',
    icon: iconRender({ icon: 'mdi:format-horizontal-align-right' })
  },
  {
    label: t('admin.context_menu.close_all'),
    key: 'close-all',
    icon: iconRender({ icon: 'ant-design:line-outlined' })
  }
]);

const actionMap = new Map<DropdownKey, () => void>([
  [
    'reload-current',
    () => {
      app.reloadPage();
    }
  ],
  [
    'close-current',
    () => {
      tab.removeTab(props.currentPath);
    }
  ],
  [
    'close-other',
    () => {
      tab.clearTab([props.currentPath]);
    }
  ],
  [
    'close-left',
    () => {
      tab.clearLeftTab(props.currentPath);
    }
  ],
  [
    'close-right',
    () => {
      tab.clearRightTab(props.currentPath);
    }
  ],
  [
    'close-all',
    () => {
      tab.clearAllTab();
    }
  ]
]);

function handleDropdown(optionKey: string) {
  const key = optionKey as DropdownKey;
  const actionFunc = actionMap.get(key);
  if (actionFunc) {
    actionFunc();
  }
  hide();
}
</script>

<style scoped></style>
