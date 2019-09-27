<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>配送单打印</title>
<style>
body{margin: 0 auto;padding: 0; background:#FFF; width:420px; padding:10px;}
td{ padding:1px;}
.fontb{ font-size:40px; font-weight:bold;}
.fontm{ font-size:24px; width:190px;}
.fonts{ font-size:18px;}
.center{ text-align:center; border:1px solid #000; width:120px;}
.fl{ text-align:left;}
.fl2{ text-align:left;width:300px; height:50px;}
.fr{ text-align:right;}
img{ width:380px;}

</style>
</head>
<body>
<table border="0">
  <?php 
  foreach($lists as $v){
	  $adress = json_decode(base64_decode($v['address']),true);
  ?>
  <tr>
  <td colspan="3" class="fonts">&nbsp;</td>
  </tr>
  <tr>
    <td class="fonts fr">收货人：</td>
    <td class="fontb fl"><?php echo sub_str($adress['recname'],3,false);?></td>
    <td class="fonts center" rowspan="2"><b>租书会</b><br>读好书 租经典</td>
  </tr>
  <tr>
    <td class="fonts fr">电　话：</td>
    <td class="fontm fl"><?php echo sub_str($adress['phone'],12,false);?></td>
  </tr>
  <tr>
    <td class="fonts fr">地　址：</td>
    <td colspan="2" class="fonts fl2"><?php $addressstr = $arealist[$adress['city']].$arealist[$adress['area']].(($info['address']['school'] == 1 )?$stagelist[$adress['address']]:$arealist[$adress['street']].$adress['address']);?><?php echo sub_str($addressstr,32);?></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><img src="/tm/html/image.php?filetype=PNG&amp;dpi=72&amp;scale=2&amp;rotation=0&amp;font_family=Arial.ttf&amp;font_size=8&amp;text=<?php echo $v['order_no'];?>&amp;thickness=30&amp;checksum=&amp;code=BCGcode39" alt="Barcode Image"></td>
  </tr>
  <?php }?>
 <!-- <tr>
  <td colspan="3" class="fonts">&nbsp;</td>
  </tr>
  <tr>
    <td class="fonts fr">收货人：</td>
    <td class="fontb fl">张生生</td>
    <td class="fonts center" rowspan="2"><b>租书会</b><br>读好书 租经典</td>
  </tr>
  <tr>
    <td class="fonts fr">电　话：</td>
    <td class="fontm fl">15336538031</td>
  </tr>
  <tr>
    <td class="fonts fr">地　址：</td>
    <td colspan="2" class="fonts fl">滨江区长河街道滨江区长河街道铂金滨江区长道滨江区长河街道铂金滨江</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><img src="/tm/html/image.php?filetype=PNG&amp;dpi=72&amp;scale=2&amp;rotation=0&amp;font_family=Arial.ttf&amp;font_size=8&amp;text=1909231510101&amp;thickness=30&amp;checksum=&amp;code=BCGcode39" alt="Barcode Image"></td>
  </tr>-->

</table>

</body>
</html>