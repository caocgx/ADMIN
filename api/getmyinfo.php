<?php

//引入公用文件
require_once('../include/common.in.php');


//查询语句
$sql  = "SELECT id,uname,tel,address,postcode,header FROM cgx_user WHERE openid = '".$openID."' LIMIT 1";
$msql -> execute($sql);

$res = $msql -> fetchquery();

echo json_encode($res);