<?php
define('WEB_ROOT',dirname(__FILE__));
include_once dirname(__FILE__).'/../DqLoader.php';

require WEB_ROOT.'/libs/Smarty.class.php';
session_start();

try{
    if(isset($_GET['op']) && $_GET['op']=='loginout'){
        unset($_SESSION['user']);
        header('Location: /login.php?op=login');
    }
    $smarty = new Smarty;
    $smarty->caching = false;
    $smarty->cache_lifetime = 1;
    $smarty->assign('user_name',$_SESSION['user'][0]['user_name']);
    $smarty->display('loginsucc.tpl');
}catch (Exception $e){

}