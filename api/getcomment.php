<?php

//引入公用文件
require_once('../include/common.in.php');

//获取分类和产品ID
$catagory = $catagory;
$pid = $pid;

//查询
$sql = "SELECT stars,notes,c.dt,uname,header FROM cgx_comment as c LEFT JOIN cgx_user as u ON(c.openid=u.openid) WHERE catagory='".$catagory."' AND pid =$pid";

$msql -> execute($sql);

while($res= $msql->fetchquery){
    $tempArr[] = $res;
}

echo json_encode($tempArr);