<!--底部-->
<section>
    <ul class="clearfix foot_lists">
        <a href="https://<?php echo request()->host();?>/">
        <li class="fl">
            <img src="__IMG__/<?php echo (request()->path() == '/')?'home1.png':'home.png';?>"/>
            <p<?php echo (request()->path() == '/')?' class="active"':'';?>>首页</p>
        </li>
        </a>
        <a href="<?php echo url('cat/index');?>">
            <li class="fl">
                <img src="__IMG__/<?php echo (stristr(request()->path(),'cat/index'))?'fenlei1.png':'fenlei.png';?>"/>
                <p<?php echo (stristr(request()->path(),'cat/index'))?' class="active"':'';?>>分类</p>
            </li>
        </a>
        <a href="<?php echo url('cart/index');?>">
            <li class="fl foot_lists_car">
                <img class="shopping-cart" src="__IMG__/<?php echo (stristr(request()->path(),'cart/index'))?'shop_car1.png':'shop_car.png';?>"/>
                <span id="num">0</span>
                <p<?php echo (stristr(request()->path(),'cart/index'))?' class="active"':'';?>>购物车</p>
            </li>
        </a>
        
        <?php if(isset($userinfo) && $userinfo['username']){?>
        <a href="<?php echo url('uinf/index');?>">
            <li class="fl">
                <img src="__IMG__/<?php echo (stristr(request()->path(),'uinf/'))?'wode1.png':'wode.png';?>"/>
                <p<?php echo (stristr(request()->path(),'uinf/'))?' class="active"':'';?>>我的</p>
            </li>
        </a>
        <?php }else{?>
        <a href="<?php echo url('login/index');?>" title="用户登录" rel="nofollow">
            <li class="fl">
                <img src="__IMG__/wode1.png"/>
                <p class="active">登录</p>
            </li>
        </a>
        <?php }?>
    </ul>
</section>
</section>
<script>
var _hmt = _hmt || [];(function() { var hm = document.createElement("script"); hm.src = "https://hm.baidu.com/hm.js?0b17d2fe8fb15810ac175527e5b7aa17";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();
</script>
</body></html>