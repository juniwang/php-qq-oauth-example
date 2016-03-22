<?php
error_reporting(~0);
ini_set('display_errors', 1);

session_start();
include_once( 'qq_config.php' );

# get access token by authorization code
$code = $_REQUEST["code"];
$url= TOKEN_URL.'&client_id='.QQ_AKEY.'&client_secret='.QQ_SKEY.'&redirect_uri='.CA_URL.'&code='.$code;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
if(strpos($response, "callback") !== false){
    $lpos = strpos($response, "(");
    $rpos = strrpos($response, ")");
    $response  = substr($response, $lpos + 1, $rpos - $lpos -1);
}
#echo $response;
$params = array();        
parse_str($response, $params);
$access_token = $params["access_token"];
$_SESSION["access_token"] = $access_token;
#echo $access_token;
# get openid
$me_url = OPENID_URL.$access_token;
$me = curl_init($me_url);
curl_setopt($me, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($me);
if(strpos($response, "callback") !== false){
    $lpos = strpos($response, "(");
    $rpos = strrpos($response, ")");
    $response = substr($response, $lpos + 1, $rpos - $lpos -1);
}
#echo $response;
$user = json_decode($response);
$openid = $user->openid;
$_SESSION["openid"] = $openid;
#echo $openid;

# query user basic info
$info_url = USER_INFO_URL.'?access_token='.$access_token.'&oauth_consumer_key='.QQ_AKEY.'&openid='.$openid;
$infoc = curl_init($info_url);
curl_setopt($infoc, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($infoc);
curl_close($infoc);
# echo $response;
$user = json_decode($response, true);
setcookie("user", $user["nickname"], time()+3600);
$avatar_url = "";
if(isset($user["figureurl_qq_1"])){
    $avatar_url = $user["figureurl_qq_1"]; # try qq logo first
}elseif (isset($user["figureurl"]) ){
    $avatar_url = $user["figureurl"];  # try qzone logo
}
setcookie("avatar", $avatar_url, time()+3600);

# redirect to home page
header('Location: /index.php');
die();

?>
