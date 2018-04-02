<{extends file="extends/main.block.tpl"}>

<{block "head-styles-after"}>
	<link rel="stylesheet" type="text/css" href="<{'static/css/slick.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/style.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/iconfont/iconfont.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/base.css'|url}>" />
<{/block}>

<{block "head-scripts-plus"}>
	<script src="<{'static/js/rem.js'|url}>"></script>
	<script src="<{'static/js/basic.js'|url}>"></script>
<{/block}>

<{block "body-container"}>
	<div class="header">
		<span>扣费成功</span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	<div class="step">
		<ul class="fs0">
		 <li>
    		<span class="step-icon passbg">1</span>
    		<p>个人登录</p>
    	</li>
    	<li>
    	<span class="step-icon passbg">2</span>
    		<p>添加住址</p>
    	</li>
    	<li>
    		<span class="step-icon<{if $_order.status>1}> passbg<{/if}>">3</span>
    		<p class="<{if $_order.status>1}> step-txt<{/if}>">交费成功</p>
    	</li>
    	<li>
    		<span class="step-icon">4</span>
    		<p>充值成功</p>
    	</li>
    	</ul>
    	<span class="pro-line"><img src="<{'static/img/pro-line1.png'|url}>"></span>
	</div>
	
	<div class="row text-center" style="margin-top:20px;">
		<{if $_order.status>1}>
   		<div class="col-xs-12"><img src="<{'static/img/pay-2.png'|url}>" alt="" class="img-responsive center-block"></div>
   		<p class="col-xs-12" style="margin-top:40px;"><div class="center-block" style="width:60%;font-size:16px;display:block;">您已经交费成功,交费金额为(￥<{$_order.sumMoney}>)，请等待一至两个工作日为您充值。<br/><a href="<{'ucenter/order_list'|url}>">查看交费记录</a></div></p>
   		<{else}>
   		<p class="col-xs-12" style="margin-top:40px;"><div class="center-block" style="width:60%;font-size:16px;display:block;">交费失败,请重新支付。<br/><a href="<{'ucenter/order_list'|url}>">查看交费记录</a></div></p>
   		<{/if}>	
   </div>
	
<{include file="home/footer.inc.tpl"}>	
<{/block}>