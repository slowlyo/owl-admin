<template>
  <div class="relative flex-center wh-full bg-white">
    <dark-mode-switch
      :dark="theme.darkMode"
      class="absolute left-48px top-24px z-3 text-20px color-white"
      @update:dark="theme.setDarkMode"
    />
    <n-card :bordered="false" size="large" class="z-4 !w-auto rounded-6px shadow-sm">
      <div class="w-300px sm:w-360px">
        <header class="flex-y-center justify-between">
          <div class="w-70px h-70px rounded-35px overflow-hidden">
            <system-logo class="text-70px text-primary" :fill="true" />
          </div>
          <n-gradient-text type="primary" :size="28">{{ getSettingItem('app_name') }}</n-gradient-text>
        </header>
        <main class="pt-24px">
          <div class="pt-24px">
            <transition name="fade-slide" mode="out-in" appear>
              <n-form ref="formRef" :model="model" :rules="rules" size="large" :show-label="false">
                <n-form-item path="username">
                  <n-input
                    v-model:value="model.username"
                    :placeholder="t('admin.please_input', [t('admin.login_form.username')])"
                  />
                </n-form-item>
                <n-form-item path="password">
                  <n-input
                    v-model:value="model.password"
                    type="password"
                    show-password-on="click"
                    :placeholder="t('admin.please_input', [t('admin.login_form.password')])"
                    @keydown.enter="handleSubmit"
                  />
                </n-form-item>
                <n-form-item v-if="captchaEnabled" path="captcha">
                  <n-space justify="space-between" class="w-full" size="small">
                    <n-input
                      v-model:value="model.captcha"
                      class="w-full"
                      :placeholder="t('admin.please_input', [t('admin.login_form.captcha')])"
                      @keydown.enter="handleSubmit"
                    />
                    <div class="h-full cursor-pointer" style="height: var(--n-height)" @click="refreshCaptcha">
                      <n-image class="h-full rounded-3px" :src="captchaImage" preview-disabled />
                    </div>
                  </n-space>
                </n-form-item>
                <n-space :vertical="true" :size="24">
                  <div class="flex-y-center justify-between">
                    <n-checkbox v-model:checked="rememberMe">{{ t('admin.remember_me') }}</n-checkbox>
                  </div>
                  <n-button
                    type="primary"
                    size="large"
                    :block="true"
                    :round="true"
                    :loading="auth.loginLoading"
                    @click="handleSubmit"
                  >
                    {{ t('admin.login') }}
                  </n-button>
                </n-space>
              </n-form>
            </transition>
          </div>
        </main>
      </div>
    </n-card>
    <login-bg :theme-color="bgThemeColor" />
  </div>
</template>

<script setup lang="ts">
import { computed, onMounted, reactive, ref } from 'vue';
import type { FormInst } from 'naive-ui';
import { fetchCaptcha } from '@/service';
import { useAppStore, useThemeStore, useAuthStore } from '@/store';
import { getColorPalette, settings } from '@/utils';
import { t } from '@/locales';
import { LoginBg } from './components';

const getSettingItem = (key: string) => settings.setStore(useAppStore()).getSettingItem(key);

const theme = useThemeStore();

const bgThemeColor = computed(() => (theme.darkMode ? getColorPalette(theme.themeColor, 7) : theme.themeColor));

const auth = useAuthStore();
const { login } = useAuthStore();

const captchaEnabled = computed(() => settings.setStore(useAppStore()).getSettingItem('login_captcha'));

const formRef = ref<HTMLElement & FormInst>();

const model = reactive({
  username: '',
  password: '',
  captcha: '',
  sys_captcha: ''
});

const rules = reactive({
  username: {
    required: true,
    message: t('admin.please_input', [t('admin.login_form.username')]),
    trigger: 'blur'
  },
  password: {
    required: true,
    message: t('admin.please_input', [t('admin.login_form.password')]),
    trigger: 'blur'
  },
  captcha: {
    required: captchaEnabled,
    message: t('admin.please_input', [t('admin.login_form.captcha')]),
    trigger: 'blur'
  }
});

const rememberMe = ref(false);
const captchaImage = ref('');

// 获取验证码
const refreshCaptcha = () => {
  fetchCaptcha().then((res: any) => {
    captchaImage.value = res.data.captcha_img;
    model.sys_captcha = res.data.sys_captcha;
  });
};

const handleSubmit = async () => {
  await formRef.value?.validate();

  const err = await login(model, rememberMe.value);

  if (err) {
    refreshCaptcha();
  }
};

onMounted(() => {
  refreshCaptcha();
});
</script>

<style scoped></style>
