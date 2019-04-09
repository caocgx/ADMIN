<?php
    //访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//给模板提供数据
$datas = '';

//1.获取ID
$id = intval($id);

//2.删除语句
$sql = "DELETE FROM cgx_class_parent WHERE id=$id LIMIT 1";

//3.执行语句
$msql->execute($sql);

//4.执行结果
$res = $msql->affectedRows();

if ($res > 0) {
    $result = '删除一级分类成功！';

    //删除二级分类
    $sql = "DELETE FROM cgx_class_child WHERE cid=$id ";

    //执行删除二级分类语句
    $msql->execute($sql);

    //4.执行结果
    $res2 = $msql->affectedRows();

    if ($res2 > 0) {
        $result2 = '删除二级分类成功！';
    } else {
        $result2 = '删除二级分类失败！';
    }

    $datas='<a href="main.php?go=classparent" class="blue">返回列表</a>';

} else {
    $result = '删除一级分类失败！';
}


//载入模板
include 'pages/templates/classparentdel.html';
 