<?php

//访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//获取ID
$id = intval($id);

//初始化
$datas = '';

//根据该ID获取数据
$sql = "SELECT m.id,ccid,musicname,singer,composer,writer,price,words,dt,cname FROM cgx_music as m LEFT JOIN cgx_class_child as c ON(m.ccid = c.id)  WHERE m.id=$id LIMIT 1";

//执行语句
$msql -> execute($sql);

//获取数据
$res = $msql ->fetchquery();

$className = $res['cname'];
$class_id = $res['ccid'];


//获取全部分类
$sql1 = "SELECT id,cname FROM cgx_class_child WHERE cid=21";

$msql -> execute($sql1);

$rex = $msql ->fetchquery();


while ($rex = $msql->fetchquery()) {

    $datas .= '<option value="' . $rex['id'] . '">' . $rex['cname'] . '</option>';

}

//提供表单数据

$musicname = $res['musicname'];

$singer = $res['singer'];

$composer = $res['composer'];

$writer = $res['writer'];

$words = $res['words'];

$price = $res['price'];

//上架日期
//把时间戳转换为日期格式
$dt = date( 'Y-m-d',$res['dt']);


//载入模板
include 'pages/templates/music_edit.html';
 