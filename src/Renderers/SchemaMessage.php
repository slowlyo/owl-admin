<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * 消息文案配置，记住这个优先级是最低的，如果你的接口返回了 msg，接口返回的优先。
 *
 * @method self fetchFailed($value) 获取失败时的提示
 * @method self fetchSuccess($value) 获取成功的提示，默认为空。
 * @method self saveFailed($value) 保存失败时的提示。
 * @method self saveSuccess($value) 保存成功时的提示。
 */
class SchemaMessage extends BaseRenderer
{
}
