<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fq.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/zhihu.js"></script>

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/ccv.js"></script>
    <script src="../js/cascade.js"></script>
    <script src="../js/jquery.facedetection.js"></script>
    <meta charset="UTF-8">
    <title>人脸识别登录系统</title>
</head>


<body>
<div id="canvas-container"></div>
<input type="hidden" value="{$op}" id="op">
<div id="tab-container">
    <ul id="myTab" class="nav nav-tabs">
        <li class="{if $op =='login' } active{/if}">
            <a href="#home" data-toggle="tab" class="btn-tab" data-op="login">
                登录
            </a>
        </li>
        <li  class="{if $op =='register' } active{/if}"><a href="#ios" data-toggle="tab" class="btn-tab" data-op="register">注册</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade  {if $op =='login' } in active{/if}" {if $op !='login' }style="display: none" {/if}  id="home">
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
        <div class="tab-pane fade  {if $op =='register' } in active{/if}" {if $op !='register' } style="display: none" {/if} id="ios">
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

<script src="../js/fp.js?v={$version}"></script>


