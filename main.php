<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('os_weibo_connect')) {$zbp->ShowError(48);die();}

$blogtitle='微博登录设置';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<style>
.edit-input {
    display: block;
    width: 100%;
    height: 40px;
    line-height: 24px;
    font-size: 14px;
    padding: 8px;
    box-sizing: border-box;
}
</style>
<div id="divMain">
    <div class="divHeader"><?php echo $blogtitle;?></div>
    <div class="SubMenu"><?php os_weibo_connect_SubMenu(0);?></div>
    <div id="divMain2">
        <form action="./save.php?type=base" method="post">
            <table border="1" class="tableFull tableBorder tableBorder-thcenter" style="max-width: 1000px">
                <thead>
                    <tr>
                        <th width="200px">配置名称</th>
                        <th>配置内容</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>启用开关</td>
                        <td>
                            <input name="active" type="text" class="checkbox" style="display:none;" value="<?php echo $zbp->Config('os_weibo_connect')->active; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>App Key</td>
                        <td>
                            <input name="appid" type="text" class="edit-input" value="<?php echo $zbp->Config('os_weibo_connect')->appid; ?>" placeholder="请填写微博应用的App Key" />
                        </td>
                    </tr>
                    <tr>
                        <td>App Secret</td>
                        <td>
                            <input name="appkey" type="text" class="edit-input" value="<?php echo $zbp->Config('os_weibo_connect')->appkey; ?>" placeholder="请填写微博应用的App Secret" />
                        </td>
                    </tr>
                    <tr>
                        <td>自动生成账号</td>
                        <td>
                            <input name="user_auto_create" type="text" class="checkbox" style="display:none;" value="<?php echo $zbp->Config('os_weibo_connect')->user_auto_create; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>自动注册身份</td>
                        <td>
                            <select name="user_reg_level" class="edit">
                                <?php
                                    $level = $zbp->Config('os_weibo_connect')->user_reg_level;
                                    if (!isset($level)) {
                                        $level = 6;
                                    }
                                    echo OutputOptionItemsOfMemberLevel($level);
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>跳转至来源页</td>
                        <td>
                            <input name="source_switch" type="text" class="checkbox" style="display:none;" value="<?php echo $zbp->Config('os_weibo_connect')->source_switch; ?>" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" value="保存配置" style="margin: 0; font-size: 1em;" />
        </form>
        <style>
            .readme {
                max-width: 1000px;
                padding: 10px;
                margin-bottom: 10px;
                background: #f9f9f9;
            }
            .readme h3 {
                font-size: 16px;
                font-weight: normal;
                color: #000;
            }
            .readme ul li {
                margin-bottom: 5px;
                line-height: 30px;
            }
            .readme a {
                color: #333 !important;
                text-decoration: underline;
            }
            .readme code {
                display: inline-block;
                margin: 0 5px;
                padding: 0 8px;
                line-height: 25px;
                font-size: 12px;
                font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                color: #1a1a1a;
                border-radius: 4px;
                background: #eee;
            }
            .readme code.copy {
                cursor: pointer;
            }
            .readme-item {
                -webkit-display: flex;
                display: flex;
                margin-bottom: 10px;
            }
            .readme-item .name {
                display: block;
                width: 100px;
                height: 24px;
                line-height: 24px;
            }
            .readme-item .preview {
                display: block;
                width: 300px;
            }
            .readme-item .options {
                display: block;
                width: 300px;
                height: 24px;
            }
            .readme-item .code-pre {
                display: none;
            }
            .readme-item .copy-btn {
                display: inline-block;
                width: 64px;
                height: 24px;
                margin: 0;
                margin-left: 10px;
                padding: 0;
                line-height: 24px;
                font-size: 13px;
                color: #fff;
                border: none;
                border-radius: 2px;
                background: #3a6ea5;
                cursor: pointer;
            }
            .readme-item .copy-btn:active,
            .readme-item .copy-btn:focus {
                outline: 0;
            }
            .readme-item .copy-btn:active {
                opacity: .95;
            }
        </style>
        <div class="readme">
            <h3>插件配置说明</h3>
            <ul>
                <li>- 如果您没有App Key和App Secret，请前往<a href="http://open.weibo.com/" target="_blank">open.weibo.com</a>申请</li>
                <li>- 您用于应用填写网站回调域的地址是<code class="copy" title="点击复制"><?php echo os_weibo_connect_Event_GetURL('callback'); ?></code></li>
                <li>- 登录访问地址<code class="copy" title="点击复制"><?php echo os_weibo_connect_Event_GetURL('login'); ?></code></li>
                <li>- 跳转至来源基于a标签上面的class<code class="copy" title="点击复制">os-weibo-connect-link</code></li>
                <li>- 开发实现跳转至来源，在cookie中写入key为<code>sourceUrl</code>:value为来源地址即可</li>
                <li>- 获取最新的教程文档支持<a href="https://www.os369.com/app/item/os_weibo_connect" target="_blank">https://www.os369.com/app/item/os_weibo_connect</a></li>
            </ul>
        </div>
        <div class="readme">
            <h3>调用内容</h3>
            <div class="readme-item">
                <div class="name">示例1：</div>
                <div class="preview">
                    <a href="<?php echo os_weibo_connect_Event_GetURL('login'); ?>" class="os-weibo-connect-link"><img src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/icon/logo_24.png" alt="微博登录" /></a>
                </div>
                <div class="options">
                    <label><input type="checkbox" /> 新窗口打开</label>
                    <button class="copy-btn">复制代码</button>
                </div>
                <textarea class="code-pre"><a href="<?php echo os_weibo_connect_Event_GetURL('login'); ?>" class="os-weibo-connect-link"><img src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/icon/logo_24.png" alt="微博登录" /></a></textarea>
            </div>
            <div class="readme-item">
                <div class="name">示例2：</div>
                <div class="preview">
                    <a href="<?php echo os_weibo_connect_Event_GetURL('login'); ?>" class="os-weibo-connect-link"><img src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/icon/logo_ico_24.png" alt="微博登录" /></a>
                </div>
                <div class="options">
                    <label><input type="checkbox" /> 新窗口打开</label>
                    <button class="copy-btn">复制代码</button>
                </div>
                <textarea class="code-pre"><a href="<?php echo os_weibo_connect_Event_GetURL('login'); ?>" class="os-weibo-connect-link"><img src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/icon/logo_ico_24.png" alt="微博登录" /></a></textarea>
            </div>
            <div class="readme-item">
                <div class="name">示例3：</div>
                <div class="preview">
                    <a href="<?php echo os_weibo_connect_Event_GetURL('login'); ?>" class="os-weibo-connect-link"><img src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/icon/login_16.png" alt="微博登录" /></a>
                </div>
                <div class="options">
                    <label><input type="checkbox" /> 新窗口打开</label>
                    <button class="copy-btn">复制代码</button>
                </div>
                <textarea class="code-pre"><a href="<?php echo os_weibo_connect_Event_GetURL('login'); ?>" class="os-weibo-connect-link"><img src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/icon/login_16.png" alt="微博登录" /></a></textarea>
            </div>
            <div class="readme-item">
                <div class="name">示例4：</div>
                <div class="preview">
                    <a href="<?php echo os_weibo_connect_Event_GetURL('login'); ?>" class="os-weibo-connect-link"><img src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/icon/login_24.png" alt="微博登录" /></a>
                </div>
                <div class="options">
                    <label><input type="checkbox" /> 新窗口打开</label>
                    <button class="copy-btn">复制代码</button>
                </div>
                <textarea class="code-pre"><a href="<?php echo os_weibo_connect_Event_GetURL('login'); ?>" class="os-weibo-connect-link"><img src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/icon/login_24.png" alt="微博登录" /></a></textarea>
            </div>
            <div class="readme-item">
                <div class="name">示例5：</div>
                <div class="preview">
                    <a href="<?php echo os_weibo_connect_Event_GetURL('login'); ?>" class="os-weibo-connect-link"><img src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/icon/login_32.png" alt="微博登录" /></a>
                </div>
                <div class="options">
                    <label><input type="checkbox" /> 新窗口打开</label>
                    <button class="copy-btn">复制代码</button>
                </div>
                <textarea class="code-pre"><a href="<?php echo os_weibo_connect_Event_GetURL('login'); ?>" class="os-weibo-connect-link"><img src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/icon/login_32.png" alt="微博登录" /></a></textarea>
            </div>
            <div class="readme-item">
                <div class="name">示例6：</div>
                <div class="preview">
                    <a href="<?php echo os_weibo_connect_Event_GetURL('login'); ?>" class="os-weibo-connect-link"><img src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/icon/login_48.png" alt="微博登录" /></a>
                </div>
                <div class="options">
                    <label><input type="checkbox" /> 新窗口打开</label>
                    <button class="copy-btn">复制代码</button>
                </div>
                <textarea class="code-pre"><a href="<?php echo os_weibo_connect_Event_GetURL('login'); ?>" class="os-weibo-connect-link"><img src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/icon/login_48.png" alt="微博登录" /></a></textarea>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/clipboard/clipboard-polyfill.js"></script>
<script src="<?php echo $zbp->host ?>zb_users/plugin/os_weibo_connect/static/layer/layer.js"></script>
<script>
$('.readme code.copy').on('click', function() {
    var str = $.trim($(this).html())
    clipboard.writeText(str)
    layer.msg("已复制到剪贴板")
})

$('.options input[type="checkbox"]').on('click', function() {
    var $item = $(this).parents('.readme-item')
    if (this.checked) {
        $item.find('.preview a').attr('target', '_blank')
    } else {
        $item.find('.preview a').removeAttr('target')
    }
    $item.find('.code-pre').val($item.find('.preview').html())
})

$('.options .copy-btn').on('click', function() {
    var str = $(this).parents('.readme-item').find('.code-pre').val()
    str = $.trim(str)
    clipboard.writeText(str)
    layer.msg("已复制到剪贴板")
})
</script>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>
