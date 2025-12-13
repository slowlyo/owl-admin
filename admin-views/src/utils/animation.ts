/**
 * 动画配置映射工具
 * 用于将系统设置中的动画类型映射为 framer-motion 的 variants
 */

const distance = 30; // 移动距离

// 归位状态（激活状态）
const animateState = { opacity: 1, x: 0, y: 0, scale: 1, scaleX: 1, scaleY: 1 };

/**
 * 获取进场初始状态
 * @param type 动画类型
 */
export const getInVariants = (type: string) => {
  switch (type) {
    case 'alpha':
      return { opacity: 0 };
    case 'left':
      return { opacity: 0, x: -distance };
    case 'right':
      return { opacity: 0, x: distance };
    case 'top':
      return { opacity: 0, y: -distance };
    case 'bottom':
      return { opacity: 0, y: distance };
    case 'scale':
      return { opacity: 0, scale: 0.8 };
    case 'scaleBig':
      return { opacity: 0, scale: 1.2 };
    case 'scaleX':
      return { opacity: 0, scaleX: 0 };
    case 'scaleY':
      return { opacity: 0, scaleY: 0 };
    default:
      return { opacity: 0 };
  }
};

/**
 * 获取离场结束状态
 * @param type 动画类型
 */
export const getOutVariants = (type: string) => {
  switch (type) {
    case 'alpha':
      return { opacity: 0 };
    case 'left':
      return { opacity: 0, x: -distance };
    case 'right':
      return { opacity: 0, x: distance };
    case 'top':
      return { opacity: 0, y: -distance };
    case 'bottom':
      return { opacity: 0, y: distance };
    case 'scale':
      return { opacity: 0, scale: 0.8 };
    case 'scaleBig':
      return { opacity: 0, scale: 1.2 };
    case 'scaleX':
      return { opacity: 0, scaleX: 0 };
    case 'scaleY':
      return { opacity: 0, scaleY: 0 };
    default:
      return { opacity: 0 };
  }
};

/**
 * 获取标准激活状态
 */
export const getAnimateVariants = () => {
    return animateState;
}

/**
 * 获取动画过渡配置
 * @param duration 持续时间 (ms)
 */
export const getTransition = (duration: number) => {
  return {
    duration: duration / 1000, // framer-motion 使用秒
    ease: "easeInOut"
  };
};
