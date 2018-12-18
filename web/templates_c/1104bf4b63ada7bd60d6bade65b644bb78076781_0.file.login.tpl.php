<?php
/* Smarty version 3.1.34-dev-1, created on 2018-12-15 19:49:05
  from '/Users/chenlinzhong/Documents/v_project/t_faceproject/web/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-1',
  'unifunc' => 'content_5c155ab183e152_49386012',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1104bf4b63ada7bd60d6bade65b644bb78076781' => 
    array (
      0 => '/Users/chenlinzhong/Documents/v_project/t_faceproject/web/templates/login.tpl',
      1 => 1544959180,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c155ab183e152_49386012 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fq.css">
    <?php echo '<script'; ?>
 src="../js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="../js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="../js/zhihu.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 src="../js/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="../js/ccv.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="../js/cascade.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="../js/jquery.facedetection.js"><?php echo '</script'; ?>
>
    <meta charset="UTF-8">
    <title>人脸识别登录系统</title>
</head>


<body>
<div id="canvas-container"></div>
<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['op']->value;?>
" id="op">
<div id="tab-container">
    <ul id="myTab" class="nav nav-tabs">
        <li class="<?php if ($_smarty_tpl->tpl_vars['op']->value == 'login') {?> active<?php }?>">
            <a href="#home" data-toggle="tab" class="btn-tab" data-op="login">
                登录
            </a>
        </li>
        <li  class="<?php if ($_smarty_tpl->tpl_vars['op']->value == 'register') {?> active<?php }?>"><a href="#ios" data-toggle="tab" class="btn-tab" data-op="register">注册</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade  <?php if ($_smarty_tpl->tpl_vars['op']->value == 'login') {?> in active<?php }?>" <?php if ($_smarty_tpl->tpl_vars['op']->value != 'login') {?>style="display: none" <?php }?>  id="home">
            <form class="form-horizontal" role="form" style="margin-top: 30px">
                <div class="video-container-2" >
                    <img src="../images/shexiangtou.jpeg" id="login-logo"/><br>
                    <video id="video2" width="400" height="300" muted class="abs" style="display: none;"></video>
                    <canvas id="canvas2" width="400" height="300" style="margin-left: 60px;margin-bottom: 30px"></canvas>
                    <br>
                    <a href="#" class="find-face"  style="display: none;margin-left: 60px">发现人脸，点我换一张</a>
                </div>
            </form>
        </div>
        <div class="tab-pane fade  <?php if ($_smarty_tpl->tpl_vars['op']->value == 'register') {?> in active<?php }?>" <?php if ($_smarty_tpl->tpl_vars['op']->value != 'register') {?> style="display: none" <?php }?> id="ios">
            <form class="form-horizontal" role="form" style="margin-top: 30px">
                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label ">开启摄像头</label>
                    <div class="col-sm-10 r-camera">
                        <img src="../images/shexiangtou.jpeg" style="width: 30px;height: 30px">
                    </div>
                </div>
            </form>
            <form class="form-horizontal" role="form" style="margin-top: 30px">
                <div class="video-container" style="display: none">
                    <video id="video" width="400" height="300" muted class="abs" ></video>
                    <canvas id="canvas" width="400" height="300" style="margin-left: 60px"></canvas>
                    <br>
                    <a href="#" class="find-face" style="display: none;margin-left: 60px">发现人脸，点我换一张</a>
                </div>
            </form>
            <form class="form-horizontal" role="form" style="margin-top: 30px">
                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">昵称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control user_name"
                               placeholder="请输入昵称 " style="width: 200px" value="">
                    </div>
                </div>
            </form>
            <form class="form-horizontal" role="form" style="margin-top: 30px">
                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">邮件</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control email"
                               placeholder="请输入邮件 " style="width: 200px" value="">
                    </div>
                </div>
            </form>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default btn-redis">提交</button>
                </div>
            </div>
        </div>

    </div>

</div>
</body>

</html>

<?php echo '<script'; ?>
 src="../js/fp.js?v=<?php echo $_smarty_tpl->tpl_vars['version']->value;?>
"><?php echo '</script'; ?>
>


<?php }
}
