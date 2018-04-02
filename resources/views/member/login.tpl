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
	<script type="text/javascript">
	(function($){
		$().ready(function(){
			<{call validate selector='#form'}>
		});
	})(jQuery);
	</script>
<{/block}>

<{block "body-container"}>
	<div class="header">
		<span>用户登录</span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	<div class="step">
		<ul class="fs0">
		 <li>
    		<span class="step-icon passbg">1</span>
    		<p class="step-txt">个人登录</p>
    	</li>
    	<li>
    	<span class="step-icon">2</span>
    		<p>添加住址</p>
    	</li>
    	<li>
    		<span class="step-icon">3</span>
    		<p>交费成功</p>
    	</li>
    	<li>
    		<span class="step-icon">4</span>
    		<p>充值成功</p>
    	</li>
    	</ul>
    	<span class="pro-line"><img src="<{'static/img/pro-line4.png'|url}>"></span>
	</div>
	
<form action="<{'member/auth'|url nofilter}>"  method="POST" autocomplete="off" id="form">
	<input type="hidden" name="_token" value="<{csrf_token()}>">
	<ul class="dorm-book">
		<li>
			<span class="book-tit">用户名</span>
	        <input type="text" name="username" placeholder="请输入你的用户名." />  
		</li>
		<li>
			<span class="book-tit">密码</span>
		    <input type="password" name="password" placeholder="请输入密码." />  
		</li>
	</ul>
	<div class="step-btn">
		<input type="hidden" name="callback_url" value="<{$_callback_url}>"/>
		<button type="submit" class="ta-center db">登录</button>
	</div>
	<div style="text-align:center;font-size:15px;">
		没有用户,<a href="<{'member/register?callback_url='|url}><{urlencode($_callback_url)}>">去注册</a>
	</div>
	<div style="text-align:center;font-size:15px;">
        	合作登录&nbsp;
        <!--a href="/oauth/alipay/" class="ali-icon link-icon" title="支付宝快捷登录"></a-->
		<a href="<{'oauth/qq?callback_url='|url}><{urlencode($_callback_url)}>" title="QQ快捷登录"><img src="<{'static/img/oauth/qq.gif'|url}>"/></a>
        <a href="<{'oauth/weixin?callback_url='|url}><{urlencode($_callback_url)}>" title="微信快捷登录"><img src="<{'static/img/oauth/wechat.png'|url}>"/></a>
   </div>
</form>
<{include file="home/footer.inc.tpl"}>	
<{/block}>