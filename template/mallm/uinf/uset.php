{include file="common/header" /}
<section class="sc_home">
    <!--head-->
    <section class="ds_home_head">
        <h2><a class="fl" href="javascript:history.back(-1);"><i class="icon-left"></i></a>用户设置</h2>
    </section>
    <section class="zhanwei_hei40"></section>
    <section>
        <ul class="person_lists">
            <li class="clearfix">
                <img class="fl" src="__IMG__/pzdl.png"/>
                <p class="fl">登陆密码</p>
                <i class="fr icon-right"></i>
            </li>
            <a href="<?php echo url('newsinf/7');?>">
            <li class="clearfix">
                <img class="fl" src="__IMG__/youhuijuan.png"/>
                <p class="fl">退押金</p>
                <i class="fr icon-right"></i>
            </li>
            </a>
            <a href="<?php echo url('newsinf/7');?>">
            <li class="clearfix">
                <img class="fl" src="__IMG__/shouhou.png"/>
                <p class="fl">售后服务</p>
                <i class="fr icon-right"></i>
            </li>
            </a>
            
        </ul>
    </section>
    <!--退出登录-->
    <section>
        <div class="grzx_tcdl">
            <a href="<?php echo url('login/logout');?>"><p>退出登录</p></a>
        </div>
    </section>
{include file="common/footer" /}