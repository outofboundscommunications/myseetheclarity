<?php
// header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 36000));
// header('Expires: ' . gmdate('D, d M Y H:i:s', strtotime('+10 years')) . ' GMT');
header( 'Expires: Thu, 31 Dec 2099 05:00:00 GMT' ); 
header("Content-type: text/css");
if(!session_id())
    session_start();
echo $_SESSION['ebs_dynamic_css'];
if(isset($_SESSION['ebs_dynamic_css'])){
    echo $_SESSION['ebs_dynamic_css'];
}

if(isset($_SESSION['ebs_slider_css'])){
    foreach($_SESSION['ebs_slider_css'] as $val){
        echo $_SESSION['ebs_slider_each_'.$val];
    }
}