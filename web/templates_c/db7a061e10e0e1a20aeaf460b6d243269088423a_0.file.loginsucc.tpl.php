<?php
/* Smarty version 3.1.34-dev-1, created on 2018-12-15 14:08:44
  from '/Users/chenlinzhong/Documents/v_project/t_faceproject/web/templates/loginsucc.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-1',
  'unifunc' => 'content_5c150aec507021_29101336',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db7a061e10e0e1a20aeaf460b6d243269088423a' => 
    array (
      0 => '/Users/chenlinzhong/Documents/v_project/t_faceproject/web/templates/loginsucc.tpl',
      1 => 1544938737,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c150aec507021_29101336 (Smarty_Internal_Template $_smarty_tpl) {
?><p>欢迎，<?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
,<a href="/loginsucc.php?op=loginout">退出登录</a></p><?php }
}
