<{extends file="extends/main.block.tpl"}>

<{block "head-styles-after"}>
	<link rel="stylesheet" type="text/css" href="<{'static/css/slick.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/style.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/iconfont/iconfont.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/base.css'|url}>" />
	<style>
		.dorm-book>li>label{
			font-size:14px;
			max-width:70%;
			display: inline-block;
			outline: medium none;
			padding-left: 2%;
    		vertical-align: middle;
		}
		.dorm-book>li>label>span{
			display: inline-block;
		}
	</style>
<{/block}>

<{block "head-scripts-plus"}>
	<script src="<{'static/js/rem.js'|url}>"></script>
	<script type="text/javascript">
	(function($){
		$().ready(function(){
			var pay_int=setInterval(function(){
				$.get('<{'order/listen_order'|url}>',{order_id:'<{$_order.id}>'},function(response){
					if(response.result == "success"){
						window.clearInterval(pay_int);
						window.location.href = "<{'order/paysuccess?order_id='|url}><{$_order.id}>";
					}
				},'json');
			},1000);
		});
	})(jQuery);
</script>
<{/block}>

<{block "body-container"}>
	<div class="header">
		<span>交水费-扫码支付</span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	<div class="text-center">
		<h5 style="margin:10px;"><{$_pay_info.msg}></h5>
		<div><img src="<{'qr/index?text='|url}><{$_qrcode|urlencode}>" style="max-width:60%;"/></div>
		<{if $_pay_info.type == 'weixin'}><p class="col-xs-12 text-center">(温馨提示:保存以上面二维码,扫描后可直接完成交费)</p><{/if}>
	</div>
	<div id="msg" class="text-center" style="margin-top:10px;"><a href="<{'home/index'|url}>">取消支付<a> &nbsp;&nbsp; <a href="<{'order/paysuccess?order_id='|url}><{$_order.id}>">支付成功</a></div>	
<{include file="home/footer.inc.tpl"}>	
<{/block}>