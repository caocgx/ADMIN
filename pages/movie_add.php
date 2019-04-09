<?php
    //访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

$option_style=$option_country='' ;

//获取类型分类
//查询语句
$sql = "SELECT id,cname FROM cgx_class_child WHERE cid = 22";

//执行语句
$msql->execute($sql);

//抓取数据
while ($res = $msql->fetchquery()) {

    $option_style .= "<option value='" . $res['cname'] . "'>" . $res['cname'] . "</option>";

}

//获取国家分类
//查询语句
$sql1 = "SELECT id,cname FROM cgx_class_child WHERE cid = 24";

//执行语句
$msql->execute($sql1);

//抓取数据
while ($rex = $msql->fetchquery()) {

    $option_country .= "<option value='" . $rex['cname'] . "'>" . $rex['cname'] . "</option>";

}



//载入模板
include 'pages/templates/movie_add.html';
 