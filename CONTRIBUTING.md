## 如何为 Owl Admin 做贡献

#### 发现 Bug 了吗？

- 如果该 Bug 是 OwlAdmin 的安全漏洞，请不要在 GitHub 上打开 issue，直接私信作者, 防止被漏洞被他人利用。
- 在 GitHub 的 [Issues](https://github.com/Slowlyo/owl-admin/issues) 中搜索，确保该 Bug 尚未被报告。
- 如果找不到针对该问题的 open issue，则可以 [打开一个新的 issue](https://github.com/Slowlyo/owl-admin/issues/new/choose)。请务必按照已有的 issue 模板进行填写。

#### 要贡献代码吗?

- Bug 修复
    - 确保 PR 清晰地描述了问题和解决方案。如果适用，请包含相关 issue 编号。
- 功能性改进或新功能
    - 确保 PR 清晰地描述了调整/增加功能的原因。
    - 一次 PR 尽量提交一个功能，而不是多个功能。

#### 代码格式约定

- 命名
  - 变量名: 使用驼峰命名法，首字母小写，例如：`myVariable`
  - 类名：必须与文件名一致, 使用驼峰命名法，首字母大写，例如：`MyClass`
  - 常量：全部大写，用下划线分隔，例如：`MY_CONSTANT`
  - 使用有意义且可读的变量名，尽量不使用简写
- 在适当的位置添加注释，以帮助理解代码
- 在 `if`、`foreach`、`for`、`return` 等语句前后适当添加空行
- 代码层级不超过 3 层, 尽早返回
- 应尽量避免代码中出现硬编码
- 避免在循环中的 io 操作
- 不要保留无用代码/注释


感谢！ :heart: :heart: :heart:


Slowlyo
