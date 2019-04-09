<?php

//编码
header("Content-type:text/html;charset=utf8");


//接收表单数据


//2.二级分类ID
$class_cid = intval($cclass);

//3.书名
$bookname = trim($bookname);

//4.作者
$author = trim($author);

//5.出版社
$publicer = trim($publicer);

//6.价格
$price = trim($price);

//7.封面
$poster = $_FILES['poster'];

//8.介绍
$descript = trim(stripslashes($descript));

//9.上架日期(转换为时间戳)
$dt = strtotime($dt);

//10.是否包邮
$freepost = intval($freepost);

//初始化变量
$result_upload = $result_book = $result_poster = '';

//////////////////////////////////////////////////////////////////////////////////////////

//数据验证
if (!$class_cid || !is_numeric($class_cid)) {
    die('分类有误！');
}

if (!$bookname || !$author || !$publicer || !$price) {
    die('您有未填写的项');
}

//处理封面上传
if (count($poster) > 0) {

    //文件名
    $arrFn = $poster['name'];

    //临时文件
    $arrTemp = $poster['tmp_name'];

    //定义临时数组
    $tempDestArr = array();

    //遍历临时文件
    foreach ($arrTemp as $key => $item) {

        //临时文件名
        $tempFile = $item;

        //新文件名
        $newFileName = time() . mt_rand(1, 100);

        //旧文件名
        $oldFileName = $arrFn[$key];

        //扩展名
        $pathInfo = pathinfo($oldFileName);
        $extension = $pathInfo['extension'];

        //完整的服务文件路径
        $destFile = 'upload/' . $newFileName . '.' . $extension;

        //执行上传
        if (move_uploaded_file($tempFile, $destFile)) {

            $tempDestArr[] = $destFile;
            $result_upload = '封面上传成功！<br />';
        } else {
            $result_upload = '封面上传失败！<br />';
        }
    }
}

//////////////////////////////////////////////////////////////////////////////////////////

//1.图书入库
$sql = "INSERT INTO cgx_book(ccid,bookname,author,publicer,price,freepost,descript,dt) VALUES
        ($class_cid,'" . $bookname . "','" . $author . "','" . $publicer . "',$price,$freepost,'" . $descript . "',$dt)";

//执行语句
$msql->execute($sql);
$msql->error();

//获取最近一次入库的数据的ID
$id = $msql->insertid();


if ($id > 0) {
    $result_book = '图书入库成功！<br />';
} else {
    $result_book = '图书入库失败！<br />';
}

//2.封面入库
foreach ($tempDestArr as $key => $url) {

    //语句
    $sql = "INSERT INTO cgx_cover(bookid,coverurl) VALUES($id,'" . $url . "')";

    //执行语句
    $msql->execute($sql);

    //返回执行结果
    $res = $msql->affectedRows();

    if ($res > 0) {
        $result_poster = '封面入库成功！';
    } else {
        $result_poster = '封面入库失败！';
    }
}

//载入模板
include 'pages/templates/book_add_do.html';
