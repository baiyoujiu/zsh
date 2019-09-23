<div id="footer">
    <div class="box" style=" height:195px;">
        <div class="indexabout fl"><h2><a href="<?php echo url('newsinf/3');?>" title="关于我们-<?php echo $webSet['title'];?>" rel="nofollow">关于我们</a></h2>
            <ul>
                <li><a href="<?php echo url('newsinf/3');?>" title="<?php echo $webSet['title'];?>简介-<?php echo $webSet['title'];?>" rel="nofollow">公司简介</a></li>
                <li><a href="<?php echo url('newsinf/6');?>" title="联系我们-<?php echo $webSet['title'];?>" rel="nofollow">联系我们</a></li>
                <li><a href="<?php echo url('newsinf/15');?>" title="安全保障-<?php echo $webSet['title'];?>" rel="nofollow">安全保障</a></li>
                <li><a href="<?php echo url('newsinf/20');?>" title="合作劵商-<?php echo $webSet['title'];?>" rel="nofollow">合作劵商</a></li>
            </ul>
        </div>
        <div class="indexhelp fl"><h2><a href="<?php echo url('newsinf/11');?>" title="新手指引-<?php echo $webSet['title'];?>" rel="nofollow">帮助中心</a></h2>
            <ul>
                <li><a href="<?php echo url('newsinf/11');?>" title="新手指引-<?php echo $webSet['title'];?>" rel="nofollow">新手指引</a></li>
                <li><a href="<?php echo url('newsinf/1');?>" title="常见问题-<?php echo $webSet['title'];?>" rel="nofollow">常见问题</a></li>
                <li><a href="<?php echo url('newsinf/2');?>" title="网站公告-<?php echo $webSet['title'];?>" rel="nofollow">网站公告</a></li>
            </ul>
        </div>
        <div class="online fl"<?php echo in_array($webSet['id'],array(52,53,54,55,56,57))?' style="height:115px;"':'';?>>
            <ul><li><h3>股票配资热线</h3><p><?php echo $webSet['tel'];?></p></li>
                <li><h3>咨询时间 08:30-18:00</h3>
                    <p>
                    <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $webSet['qq'];?>&amp;site=qq&amp;menu=yes" title="客服QQ-<?php echo $webSet['title'];?>" rel="nofollow" target="_blank">
                    
                        <img src="__IMGPZ__/qqbg.png" alt="在线咨询" /><span>QQ：<?php echo $webSet['qq'];?></span></a>
                     </p></li>
                <li><h3>交流QQ群</h3>
                    <p><a href="//shang.qq.com/wpa/qunwpa?idkey=67905011c2c6c167191403db2673700d9f3ee88d3a1132689d470d3fd1e988e3" rel="nofollow" title="交流QQ群-<?php echo $webSet['title'];?>">
                        <img src="__IMGPZ__/qqqunbg.png" alt="在线咨询" /><span>QQ：<?php echo $webSet['qqq'];?></span></a>
                        </p> 
                 	</li>
            </ul>
        </div>
        <div class="conactus fr" style="width:170px;">
            <h2>客服微信</h2>
            <div class="fl app" style="position: absolute;top: 40px;"><img style="width: 105px;height: 105px;" src="<?php echo $webSet['wx'];?>" alt="<?php echo $webSet['title'];?>" /><p>客服微信</p></div>
        </div>
        <?php if(!in_array($webSet['id'],array(52,53,54,55,56,57))){?>
        <div class="conactus fr" style="width:170px;">
            <h2>客服QQ群</h2>
            <div class="fl app" style="position: absolute;top: 40px;"><a href="//shang.qq.com/wpa/qunwpa?idkey=67905011c2c6c167191403db2673700d9f3ee88d3a1132689d470d3fd1e988e3" rel="nofollow" title="交流QQ群-<?php echo $webSet['title'];?>"><img style="width: 105px;height: 105px;" src="<?php echo $webSet['qqewm'];?>" alt="<?php echo $webSet['title'];?>" /></a><p>客服QQ群</p></div>
        </div>
        <?php }?>
        <div class="clear"></div>
    </div>
    <div class="footcopy mt20">
        <p><?php echo $webSet['title'].'('.$webSet['domain'].')　'.$webSet['company'].'　'.$webSet['icp'];?>　
                <?php echo $webSet['gongan']?'<a href="'.$webSet['gongan_url'].'" style="display:inline-block;font-size:14px;" rel="nofollow" title="公安备案号" target="_blank"><img src="__IMGPZ__/gabeian.png" alt="公安备案号"><span>公安备案号'.$webSet['gongan'].'</span></a>':'';?></p>
        <p>风险提示：保护投资者利益是中国证监会工作的重中之重，<?php echo $webSet['title'];?>提醒您：股市有风险，配资炒股投资需谨慎！市场风险莫测，务请谨慎行事！</p>
       <p>
          <a href="<?php echo $webSet['gongan_url'];?>" title="公安备案-<?php echo $webSet['title'];?>" rel="nofollow"><img src="__IMGPZ__/footer07.png" alt="公安备案-<?php echo $webSet['title'];?>"></a>  
          <a href="http://<?php echo request()->host();?>/" style="margin-left:25px" title="可信认网站-<?php echo $webSet['title'];?>"><img src="__IMGPZ__/footer09.png" alt="可信认网站-<?php echo $webSet['title'];?>"></a>  
          <a href="http://<?php echo request()->host();?>/" style="margin-left:25px" title="360认证-<?php echo $webSet['title'];?>"><img src="__IMGPZ__/footer08.png" alt="360认证-<?php echo $webSet['title'];?>"></a></p>
    </div>
</div>
<!--右侧浮窗-->
<div class="toolbar_top">
  <p></p>
  <ul>
    <li><a href="<?php echo url('pzu/inf');?>" title="我的资产" rel="nofollow">
      <div class="pz_kefu"><i></i>
        <p>我的资产</p>
      </div>
      </a></li>
    <li><a href="tencent://message/?uin=<?php echo $webSet['qq'];?>&amp;Site=qq&amp;Menu=yes" rel="nofollow" target="_blank" title="QQ客服">
      <div class="video_kefu"><i></i>
        <p>QQ客服</p>
      </div>
      </a></li>
    <li><a href="//shang.qq.com/wpa/qunwpa?idkey=67905011c2c6c167191403db2673700d9f3ee88d3a1132689d470d3fd1e988e3" rel="nofollow" target="_blank" title="QQ客服群">
      <div class="lc_kefu"><i></i>
        <p>股票交流群</p>
      </div>
      </a></li>
    <li>
      <div class="weixin"><i></i>
        <p><img src="<?php echo $webSet['wx'];?>" alt="客服微信">客服微信</p>
      </div>
    </li>
    <li class="scrollUp" style="display: none;"><a href="#">
      <div class="top"><i></i>
        <p>返回顶部</p>
      </div>
      </a></li>
  </ul>
</div>


<?php $jskwyar = json_decode(base64_decode($webSet['remarks']),true);?>
<!--百度摧送，百度统计，360摧送-->
<script>
var _hmt = _hmt || [];
(function() {
	var hm = document.createElement("script");hm.src = "https://hm.baidu.com/hm.js?<?php echo $jskwyar[0];?>";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);
	var bp = document.createElement('script');var curProtocol = window.location.protocol.split(':')[0];bp.src = 'http://push.zhanzhang.baidu.com/push.js';var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(bp, s);
	var src = "http://js.passport.qihucdn.com/11.0.1.js?<?php echo $jskwyar[1];?>";document.write('<script src="' + src + '" id="sozz"><\/script>');
})();

//右侧回到顶部
$(window).scroll(function () { var scrollTop = $(window).scrollTop(); scrollTop > 200 ? $(".scrollUp").show() : $(".scrollUp").hide();});
$('.scrollUp').click(function (e) {e.preventDefault(); $('html,body').animate({ scrollTop: 0 });});
</script>
</body>
</html>