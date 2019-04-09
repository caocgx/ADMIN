
<?php
    //访问限制
    if(!defined('WWWROOT')){
        die('request not allowed!');
    }
    //给模板提供数据
    $content = 'Welcome page!';

    //载入模板
    include 'pages/templates/welcome.html';
?>
     
