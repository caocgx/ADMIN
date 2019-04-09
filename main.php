<?php

//引用公用配置文件
require_once('include/common.in.php');
//引入公用函数文件
require_once('include/common.fn.php');
//检查权限
checkAuthor();
//加载不同的业务模块（增删改查） 的代码
//子页面不可以访问，只能通过入口文件main.php 来执行



//默认页面
$go = $go ?$go : 'welcome';
//接收哪个子页面的请求
// echo $go;  //go是模板传过来的参数!!!!!!!!!!!!
$allowpages[] = 'welcome';

$allowpages[] = 'booklist';
$allowpages[] = 'bookadd';
$allowpages[] = 'book_add_do';
$allowpages[] = 'book_view';
$allowpages[] = 'book_edit';
$allowpages[] = 'book_edit_do';
$allowpages[] = 'book_del';

$allowpages[] = 'musiclist';
$allowpages[] = 'music_add';
$allowpages[] = 'music_add_do';
$allowpages[] = 'music_del';
$allowpages[] = 'music_edit';

$allowpages[] = 'movielist';
$allowpages[] = 'movie_add';
$allowpages[] = 'movie_add_do';
$allowpages[] = 'movie_del';

$allowpages[] = 'classparent';
$allowpages[] = 'classparentadd';
$allowpages[] = 'classparentaddo';
$allowpages[] = 'classparentedit';
$allowpages[] = 'classparenteditdo';
$allowpages[] = 'classparentdel';

$allowpages[] = 'classchild';
$allowpages[] = 'classchildadd';
$allowpages[] = 'classchild_add_do';
$allowpages[] = 'classchild_edit';
$allowpages[] = 'classchild_edit_do';
$allowpages[] = 'classchild_del';

$allowpages[] = 'swiper';
$allowpages[] = 'swiper_add';
$allowpages[] = 'swiper_add_do';
$allowpages[] = 'swiper_del';

$allowpages[] = 'ajax_class_select';

$allowpages[] = 'exit';

if (!in_array($go, $allowpages)) {
    die('requesr fail!!');
}

//根据$go 跳转到不同的子页面
require_once('pages/' . $go . '.php');


$class_parent_bookID = 20;
$class_parent_musicID = 21;
$class_parent_movieID = 22;
