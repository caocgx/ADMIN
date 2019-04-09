<?php

//引入公用文件
require_once('../include/common.in.php');

//获取openid
$res = file_get_contents('https://api.weixin.qq.com/sns/jscode2session?appid=wxbbd520c620021325&secret=16c821662bf4c03dab3c701f813b0025&js_code='.$code.'&grant_type=authorization_code');

//输出json
echo $res;