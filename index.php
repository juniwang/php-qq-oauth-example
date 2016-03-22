<?php
include_once( 'config.php' );
$auth_url = AUTH_URL.'?client_id='.QQ_AKEY.'&redirect_uri='.CA_URL.'&scope=get_user_info&state='.QQ_STATE.'&response_type=code';
?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta property="qc:admins" content="27430752701516305636" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <title>Simple QQ OAuth Login Example</title>
</head>

<body>
  <div class="wrapper">
    <div class="header">
      <div class="container">
        <div class="navbar-collapse">
          <ul class="navbar-nav navbar-list">
            <li class="active"><a href="/index.php">Home</a></li>
            <li><a href="/about.html">About</a></li>
<?php
if (isset($_COOKIE["user"])) {?>
            <li>
              <img src="<?php echo $_COOKIE["avatar"]?>" alt="" width="24px" height="24px" />
              <span style="color:white"><?php echo $_COOKIE["user"]?></span>
              <a href="/logout.php" style="color:#2a6496;">Logout</a>
            </li>
<?php } else { ?>
            <li>
              <a href="<?php echo $auth_url ?>" target="_self">
                <img src="http://qzonestyle.gtimg.cn/qzone/vas/opensns/res/img/Connect_logo_7.png" alt=""/>
              </a>
            </li>
<?php
} ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</body>