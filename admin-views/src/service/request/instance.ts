import axios from 'axios';
import type { AxiosError, AxiosInstance, AxiosRequestConfig } from 'axios';
import { localStg, transformRequestData } from '@/utils';
import { clearAuthStorage } from '@/store/modules/auth/helpers';

// eslint-disable-next-line @typescript-eslint/ban-ts-comment
// @ts-ignore
const amisLib = amisRequire('amis');

/**
 * 封装axios请求类
 * @author Soybean<honghuangdc@gmail.com>
 */
export default class CustomAxiosInstance {
  instance: AxiosInstance;

  backendConfig: Service.BackendResultConfig;

  /**
   *
   * @param axiosConfig - axios配置
   * @param backendConfig - 后端返回的数据配置
   */
  constructor(
    axiosConfig: AxiosRequestConfig,
    backendConfig: Service.BackendResultConfig = {
      codeKey: 'status',
      dataKey: 'data',
      msgKey: 'msg',
      successCode: 0
    }
  ) {
    this.backendConfig = backendConfig;
    this.instance = axios.create(axiosConfig);
    this.setInterceptor();
  }

  /** 设置请求拦截器 */
  setInterceptor() {
    // 请求拦截器
    this.instance.interceptors.request.use(
      async config => {
        const handleConfig = { ...config };
        if (handleConfig.headers) {
          // 数据转换
          const contentType = handleConfig.headers['Content-Type'] as string;
          handleConfig.data = await transformRequestData(handleConfig.data, contentType);
          // 设置token
          const token = localStg.get('token') || '';

          handleConfig.headers.Authorization = `Bearer ${token}`;
        }
        return handleConfig;
      },
      (axiosError: AxiosError | any) => {
        return {
          data: {
            status: 1,
            msg: axiosError.response?.data?.message || axiosError.message
          }
        };
      }
    );
    // 响应拦截器
    this.instance.interceptors.response.use(
      async response => {
        const { status } = response;
        if (status === 200 || status < 300 || status === 304) {
          const backend = response.data;
          const { codeKey, successCode } = this.backendConfig;
          // 请求成功
          if (backend[codeKey] === successCode) {
            // eslint-disable-next-line eqeqeq
            if (backend?.msg && backend?.doNotDisplayToast == 0) {
              amisLib.toast.success(backend.msg);
            }

            return backend;
          }

          // token失效
          // eslint-disable-next-line eqeqeq
          if (backend?.code == 401) {
            clearAuthStorage();
            window.location.reload();
          }

          return response;
        }

        return response;
      },
      (axiosError: AxiosError | any) => {
        return {
          data: {
            status: 1,
            msg: axiosError.response?.data?.message || axiosError.message
          }
        };
      }
    );
  }
}
