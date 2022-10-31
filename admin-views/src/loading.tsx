import type { SpinProps } from 'antd';
import { Spin } from 'antd';
import React from 'react';

const Loading: React.FC<SpinProps & any> = ({
  isLoading,
  pastDelay,
  timedOut,
  error,
  retry,
  ...reset
}) => (
  <div style={{ paddingBlockStart: 100, textAlign: 'center', height: '100vh', display: "flex", alignItems: "center", justifyContent: "center" }}>
    <Spin size="large" {...reset} />
  </div>
);

export default Loading
