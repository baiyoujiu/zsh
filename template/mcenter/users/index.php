<!DOCTYPE html>
<!-- saved from url=(0075)http://news.cndns.com/Articles_list/articles_list/labelId/134/labelName/SEO -->
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=8,9,10,11">
<title>租书网</title>
<meta name="keywords" content="租书网">
<meta name="Description" content="租书网后台管理">
<link rel="shortcut icon" href="__IMG__/icon.ico" type="image/x-icon">
<script type="text/javascript" src="__STATIC__/jquery-1.8.3.js"></script>
<link rel="stylesheet" type="text/css" href="__CSS__/login.css">
<!--//图片和CS-->
<style type="text/css">
    *{margin:0;padding:0}
    .container{height:auto;}
    .outsideBox{padding:0;margin:0;width:100%;height:100%;position:relative;}
    .loginBox{position:absolute;left:50%;top:50%;margin-left:-187px;margin-top:-189px;}
</style>
<body>
<div class="container" style="height:800px;">
    <div class="outsideBox">
        <div class="loginBox">
            <div class="loginTitle" id="login-title">账号登录</div>
            <form class="login-form" id="jlogin">
                {:token('__hash__')}
                <div class="login-input-cont">
                    <!--普通登录-->
                    <div id="commonLogin">
                        <div class="inputBox">
                            <p class="inputIcon"><i class="iconfont icon-yonghu"></i></p>
                            <p class="inputImport">
                                <input type="text" placeholder="请输入手机号或管理员账号" id="username" name="username" maxlength="11" autocomplete="on" value="">
                            </p>
                        </div>
                        <!--密码框-->
                        <div class="inputBox inputBoxNopadding">
                            <p class="inputIcon"><i class="iconfont icon-mima"></i></p>
                            <p class="inputImport">
                                <input type="password" placeholder="密码" id="password" name="password" autocomplete="off">
                            </p>
                        </div>
                    </div>
                </div>
                <!--登陆按钮-->
                <p class="loginBtn" style="margin-top: 20px;">登录</p>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('.loginBtn').click(function(e) {
            var comInputUser=$.trim($('#username').val());
            var comInputPwd=$.trim($('#password').val());
            if(comInputUser == ""){
                alert('请输入用户名');
                return false;
            }else if(comInputUser.length <4){
                alert('用户名不能少于4个字符');
                return false;
            }
            else if(comInputPwd ==""){
                alert('请输入密码');
                return false;
            }else if(comInputPwd.length < 6 ){
                alert('密码不能少于6个字符');
                return false;
            }
            else{
                $.ajax({
                    type:"POST",
                    async:false,
                    url:"/users/login.html",
                    dataType: "json",
                    data:$("#jlogin").serialize(),
                    success:function(result){
                        if(result.status == 200){
                            window.location.href = '/good/index.html';
                        }else{
                            alert(result.msg);
                        }
                    },
                    error:function(XMLHttpRequest, textStatus, errorThrown){
                        alert('网络异常，请稍后重试！');
                    }
                });
            }
        });
    });

    /** 登录响应回车 */
    document.onkeydown=function(e){
        if(!e)e=window.event;
        if((e.keyCode||e.which)==13){
            $('.loginBtn').click();
        }
    };

</script>
</body>
</html>