<{extends file="extends/main.block.tpl"}>

<{block "head-styles-plus"}>
	<link rel="stylesheet" href="<{'static/css/pay.css'|url}>">
	<link rel="stylesheet" href="<{'static/css/common.css'|url}>">
	<link rel="stylesheet" type="text/css" href="<{'static/css/iconfont/iconfont.css'|url}>" />
	<style>
		.confirm {
		    background-color: #00a7ee;
		    border-radius: 3px;
		    color: white;
		    font-size: 16px;
		    height: 48px;
		    line-height: 48px;
		    margin-top: 14px;
		    text-align: center;
		    width: 100%;
		}
		.header{
			background: #45c0f8 none repeat scroll 0 0;
		    color: #fff;
		    padding: 18px 0;
			font-size: 27px;
			line-height:42px;
		    position: relative;
		    text-align: center;
			font-family: "Helvetica Neue",Helvetica,STHeiTi,"Microsoft YaHei","微软雅黑",SimSun,sans-serif;
		}
		.header .user, .header .back {
		    color: #fff;
		    display: inline-block;
		    height: 1.65rem;
		    line-height: 1.6rem;
		    position: absolute;
		    top: 0;
		    background-color: #45c0f8;
		}
		.back {
		    left: 5%;
		}
		.iconfont.icon-left{font-size:27px;}
	</style>
<{/block}>

<{block "head-scripts-plus"}>
	<script src="<{'static/js/rem.js'|url}>"></script>
<{/block}>

<{block "body-container"}>
	<div class="header">
		<span>交水费-选择支付方式</span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	<h5 class="paytitle">支付方式</h5>
	<form action="<{'order/pay'|url nofilter}>"  method="get" autocomplete="off" id="form">
	<input type="hidden" name="_token" value="<{csrf_token()}>">
	<input type="hidden" name="id" value="<{$_order.id}>">
	<div class="container-fluid">
		<div class="row setpay">
			<label for="pay1" class="col-xs-12">
				<div class="radio col-xs-2 text-center">
					<input type="radio" name="pay_type" class="form-control" value="2"<{if $_order.pay_type == 2}> checked="checked"<{/if}> aria-label="">
				</div>
				<div class="col-xs-2 center-block">
					<img src="<{'static/img/zf_03.png'|url}>" class="img-responsive center-block">
				</div>
				<div class="col-xs-8">
					<h6 class="col-xs-12">支付宝</h6>
					<small class="col-xs-12">快捷安全，可支持银行卡支付</small>
				</div>
			</label>
		</div>

		<div class="row setpay">
			<label for="pay2" class="col-xs-12">
				<div class="radio col-xs-2 text-center">
					<input type="radio" name="pay_type" class="form-control" value="3"<{if $_order.pay_type == 3 || empty($_order.pay_type)}> checked="checked"<{/if}> aria-label="">
				</div>
				<div class="col-xs-2 center-block">
					<img src="<{'static/img/wx_06.png'|url}>" class="img-responsive center-block">
				</div>
				<div class="col-xs-8">
					<h6 class="col-xs-12">微信</h6>
					<small class="col-xs-12">快捷安全，可支持银行卡支付</small>
				</div>
			</label>
		</div>		

		<div class="row setpay">
			<label for="pay3" class="col-xs-12">
				<div class="radio col-xs-2 text-center">
					<input type="radio" name="pay_type" class="form-control" value="4" disabled="disabled" aria-label="">
				</div>
				<div class="col-xs-2 center-block">
					<img src="<{'static/img/ye_07.png'|url}>" class="img-responsive center-block">
				</div>
				<div class="col-xs-8">
					<h6 class="col-xs-12">农商银行</h6>
					<small class="col-xs-12">快捷安全，可支持银行卡支付</small>
				</div>
			</label>
		</div>
	</div>
		
 	<div class="clearfix"></div>

	<div class="container-fluid">
		<div class="row paynum">
			<h4 class="col-xs-12 text-right">支付总金额：<span class="text-danger">¥&nbsp;<{$_order.sumMoney}></span></h4>
		 </div>
	</div>

	<div class="container-fluid payfooter">
		<div class="row">	
			<button class="confirm">去支付</button>
		</div>		
	</div>
	</form>	
<{/block}>

<{block "body-scripts"}>
<script>
(function($){
$().ready(function(){
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<{$_parameters|json_encode nofilter}>,
			function(res){
				if (res.err_msg == "get_brand_wcpay_request:ok")
				{
					location.href="<{'m/pay/paysuccess?oid='|url}><{$_order.id}>";
				}
			}
		);
	}
	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
			if( document.addEventListener ){
				document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			}else if (document.attachEvent){
				document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
				document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			}
		}else{
			jsApiCall();
		}
	}
	$('#pay').on('click',function(){
		var $this = $(this);
		if ($this.prop('disabled')) return false;

		$this.prop('disabled',true).attr('disabled', 'disabled').addClass('disabled');
		callpay();
		$this.delay(2000).queue(function(){
			$this.prop('disabled',false).removeAttr('disabled').removeClass('disabled');
			$this.dequeue();
		});
	});
});
})(jQuery);
</script>
<{/block}>