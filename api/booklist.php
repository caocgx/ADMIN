<?php

//引入公用文件
require_once('../include/common.in.php');

//接收参数
$tap = $tap;
$searchKeyWords = trim($searchKeyWords);
$comlumn = trim($comlumn);

//根据不同的tap，查询不同的数据

//初始化数据
$ccid = '';
$tempArr = array();
$arrBookName = array();
$arrNew = array();

//1.把tap转换为二级分类ID
switch ($tap) {

    case 'science':
        $ccid = 18;
        break;

    case 'health':
        $ccid = 22;
        break;

    case 'child':
        $ccid = 25;
        break;

    case 'people':
        $ccid = 24;
        break;

    case 'youngth':
        $ccid = 23;
        break;

    case 'hotsell':
        $ccid = 19;
        break;

    case 'newbook':
        $ccid = 20;
        break;

    case 'freepost':
        $freepost = 55;
        break;

}

//2.根据ccid查询该分类下的数据

//2.1查询语句
if($searchKeyWords && $comlumn){

    $sql = "SELECT c.id,bookname,author,publicer,dt,descript,price,coverurl FROM cgx_book as c LEFT JOIN cgx_cover as b ON(c.id = b.bookid) WHERE $comlumn LIKE '%".$searchKeyWords."%' ORDER BY c.id DESC LIMIT 0,20";

}else if($tap == 'freepost'){

    $sql = "SELECT c.id,bookname,author,publicer,dt,descript,price,coverurl FROM cgx_book as c LEFT JOIN cgx_cover as b ON(c.id = b.bookid) WHERE freepost=1 ORDER BY c.id DESC LIMIT 0,20";

}else if($tap == 'bookmoretop'){

    $sql = "SELECT b.id,sum(counts) as total,bookname,price,author,publicer,o.dt,descript,coverurl FROM cgx_order as o LEFT JOIN cgx_book as b ON(o.pid=b.id) LEFT JOIN cgx_cover as c ON(b.id = c.bookid) WHERE catagory='book' GROUP BY pid ORDER BY total DESC LIMIT 0,20";

}else{

    $sql = "SELECT c.id,bookname,author,publicer,dt,descript,price,coverurl FROM cgx_book as c LEFT JOIN cgx_cover as b ON(c.id = b.bookid) WHERE ccid=$ccid ORDER BY c.id DESC LIMIT 0,20";

}

//2.2执行语句
$msql -> execute($sql);


//2.3获取数据
while($res = $msql -> fetchquery()){

    //1.处理日期
    $res['date'] = date('Y-m-d',$res['dt']);

    //2.处理简介
        //2.1去除html标签
        $res['descript'] = strip_tags($res['descript']);
        //2.2截取长度
        $res['descript'] = mb_substr($res['descript'],0,35,'utf-8').'...';

    //3.处理价格
        //分割
        $price = explode('.',$res['price']);
        //整数部分
        $res['price_int']  = $price[0];
        //小数部分
        $res['price_float'] = $price[1];
    
    //4.处理星级
    $res['stars'] = 5;

    //5.处理评论数
    $res['commont_count'] = 0;


    $tempArr[] = $res;
}

//2.4二维数组去重
if(count($tempArr)>0){


    foreach($tempArr as $key => $res){

        //获取名称
        $bookname = $res['bookname'];

        //把书名存入数组
        if(!in_array($bookname,$arrBookName)){
            $arrBookName[] = $bookname;
            $arrNew[] = $res;
        }


    }

}

//2.5把数据转换为json格式，并返回给小程序
echo json_encode($arrNew);
 