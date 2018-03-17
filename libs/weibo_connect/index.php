<?php
if (empty($zbp)) {
    echo '管理员已经关闭了登录';
    die();
} else if ($zbp->Config('os_weibo_connect')->active != '1') {
    echo '管理员已经关闭了新浪微博登录';
    die();
}

session_start();

include 'saetv2.ex.class.php';

$weibo_appkey = $zbp->Config('os_weibo_connect')->appid;
$weibo_appsecret = $zbp->Config('os_weibo_connect')->appkey;

$o = new SaeTOAuthV2($weibo_appkey, $weibo_appsecret);

$code_url = $o->getAuthorizeURL(os_weibo_connect_Event_GetURL('callback'));

// 转向到新浪微博登录
Redirect($code_url);
