<?php
/* 共享空间出租
 * @author Bill
 * @data 21090627
 */
namespace app\mall\controller;
use think\Controller;

class Payfund extends Controller{
	public function __construct() {
		parent::__construct();
	}
	
	//微信支付回调
	public function wxnurl(){
		require_once '../extend/wxpay/pay/notify.php';
		require_once '../extend/wxpay/pay/WxPay.Config.php';
		
		$config = new \WxPayConfig();
		//加入日志函数
		require_once '../extend/wxpay/pay/log.php';
		
		//\Log::DEBUG('>>>开始处理');
		$notify = new \PayNotifyCallBack();
		$notify->Handle($config, false);
		\Log::DEBUG('WX return SUCCESS');
		
		//获取异步结果：错误码 FAIL 或者 SUCCESS
		$rs = $notify->GetReturn_code();
		\Log::DEBUG('payrs:>>'.$rs);
		if($rs == 'SUCCESS'){
			//业务处理
			$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
			$xml = simplexml_load_string($xml);
			//var_dump($xml);
				
			//平台业务号
			$outTradeNo = $xml->out_trade_no;
			//支付对应的微信支付订单号
			$business_no = $xml->transaction_id;
			//订单金额
			$amount = $xml->total_fee;
				
			//单位转换成元
			//$amount = $amount/100;
				
			//业务处理
			//平台业务处理
			$this->paytrade($outTradeNo,3,$business_no,$amount);
			
			\Log::DEBUG('>>>业务成功');
		}
	}
	
	
	/*支付宝回调*/
	public function alinurl(){
		require_once '../extend/alipay/wappay/service/AlipayTradeService.php';
		$config = config('alipay');
		
		$arr=$_POST;
		$alipaySevice = new \AlipayTradeService($config);
		$alipaySevice->writeLog(var_export($_POST,true));
		$result = $alipaySevice->check($arr);
		
		/* 实际验证过程建议商户添加以下校验。
		 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
		2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
		3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
		4、验证app_id是否为该商户本身。
		*/
		if($result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
			
		    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
			//商户订单号
			$out_trade_no = $_POST['out_trade_no'];
		
			//支付宝交易号
			$trade_no = $_POST['trade_no'];
		
			//交易状态
			$trade_status = $_POST['trade_status'];
			
			//支付金额,单位转换成分
			$amount = $_POST['total_amount']*100;
			
			
			if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
				//平台业务处理
				$this->paytrade($out_trade_no,2,$trade_no,$amount);
		    }
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
		        
			echo "success";		//请不要修改或删除
				
		}else {
		    //验证失败
		    echo "fail";	//请不要修改或删除
		
		}
    }
    
    
    /* 充会员业务处理
     * @param $order_no str 业务编号
     * @param $pay_type int 支付方式：1-余额支付|2-支付宝|3-微信
    * @param $trade_no str 回传编号
    */
    public function paytrade($order_no,$pay_type,$trade_no,$amount){
    	if(empty($order_no) || !in_array($pay_type,[2,3]) || empty($trade_no)){
    		return false;
    	}
    	$nowTime = date('Y-m-d H:i:s');
    	//业务类型
    	$type = substr($order_no,0,1);
    	//押金充值
    	if($type ==8){
    		//查询押金业务用户
    		$wheres = ['recharge_no'=>$order_no,'pay_way'=>'ONLINEBF','status'=>'1','amount'=>$amount];
    		$reinf = db('finance_recharge')->where($wheres)->find();
    		
    		/*发放体验优惠劵
    		 * 押金：100，一张5元，无门槛红包
    		* 押金：100，两张10元，无门槛红包
    		*/
    		$couponid = ($amount>10000)?2:1;
    		$fieldstr = 'cno,name,amount,remark,rules,days';
    		$couponinf = db('coupon')->field($fieldstr)->where('id',$couponid)->find();
    		
    		$couponinf['userid'] = $reinf['userid'];
    		$couponinf['starttime'] = $couponinf['updatetime'] = $nowTime;
    		$couponinf['endtime'] = date('Y-m-d H:i:s', strtotime ('+'.$couponinf['days'].' day', strtotime(date('Y-m-d'))));
    		unset($couponinf['days']);	
    		
    		// 启动事务
    		db()->startTrans();
    		try{
    			$uwheres = ['userid'=>$reinf['userid']];
    			$udata['utype'] = 2;
    			$rs = db('users')->where($uwheres)->update($udata);
    			if(!$rs){
    				throw new \Exception("用户等级更新失败");
    			}
    			//更新用户账户余额
    			$rs = db('finance')->where($uwheres)->setInc('balance', $reinf['amount']);
    			if(!$rs){
    				throw new \Exception("用户账户余额更新失败");
    			}
    				
    			$fdata = ['status'=>2 ,'audit_time'=>$nowTime,'back_receipt'=>$trade_no,'muserid'=>'1'];
    			//$wheres = ['recharge_no'=>$order_no];
    			//更新充值状态
    			$rs = db('finance_recharge')->where($wheres)->update($fdata);
    			if(!$rs){
    				throw new \Exception("充值业务更新失败");
    			}
    			
    			
    			//体验优惠劵
    			$rs = db('coupon_record')->insert($couponinf);
    			if(!$rs){
    				throw new \Exception("体验优惠劵添加失败");
    			}
    			if($couponid>1){
    				$rs = db('coupon_record')->insert($couponinf);
    			}
    			
    			
    			// 提交事务
    			db()->commit();
    		} catch (\Exception $e) {
    			// 回滚事务
    			db()->rollback();;
    			//return ['status'=>206,'msg'=>$e->getMessage()];
    		}
    		//商品购买
    	}else{
    		$fdata = ['pay_amount'=>$amount,'pay_status'=>2 ,'pay_type'=>$pay_type,'trade_no'=>$trade_no ,'pay_time'=>$nowTime ,'update_time'=>$nowTime];
    			
    		$wheres = ['order_no'=>$order_no,'amount'=>$amount];
    			
    		//更新订单状态
    		db('order')->where($wheres)->update($fdata);
    	}
    	
    }

}