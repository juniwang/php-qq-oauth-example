<?php
header('Content-Type: text/html; charset=UTF-8');
define( "QQ_AKEY" , 'Your QQ client id' );
define( "QQ_SKEY" , 'your client secret' );
define( "QQ_STATE", "state");
define( "TOKEN_URL" , 'https://graph.qq.com/oauth2.0/token?grant_type=authorization_code');
define( "CA_URL" , '<Your domain>/callback.php' );
define( "OPENID_URL", "https://graph.qq.com/oauth2.0/me?access_token=");
define( "USER_INFO_URL", "https://graph.qq.com/user/get_user_info");
define( "AUTH_URL", "https://graph.qq.com/oauth2.0/authorize");
?>