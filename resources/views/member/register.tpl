<{extends file="extends/main.block.tpl"}>

<{block "head-styles-after"}>
	<link rel="stylesheet" type="text/css" href="<{'static/css/slick.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/style.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/iconfont/iconfont.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/base.css'|url}>" />
	<style>
		div.uploader-container{
			font-size:14px;
			max-width:72%;
			display: inline-block;
			outline: medium none;
			padding-left: 2%;
    		vertical-align: middle;
		}
		.pull-left.tags .label{
			display:none;
		}
		.thumbnails.row{
			margin-left:0;
		}
	</style>
<{/block}>

<{block "head-scripts-plus"}>
	<script src="<{'static/js/rem.js'|url}>"></script>
	<script src="<{'static/js/basic.js'|url}>"></script>
	<{include file="common/uploader.inc.tpl"}>
	<script type="text/javascript">
	(function($){
		$().ready(function(){
			$('#avatar_aid').uploader();
			<{call validate selector='#form'}>
		});
	})(jQuery);
	</script>
<{/block}>

<{block "body-container"}>
	<div class="header">
		<span>用户注册</span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	
<form action="<{'member/addMember'|url nofilter}>"  method="post" autocomplete="off" id="form">
	<input type="hidden" name="_token" value="<{csrf_token()}>">
	<ul class="dorm-book">
		<li>
			<span class="book-tit">用户名</span>
	        <input type="text" name="username" id="username" placeholder="请输入你的用户名." />  
		</li>
		<li>
			<span class="book-tit">密码</span>
		    <input type="password" name="password" id="password" placeholder="请输入密码." />  
		</li>
		<li>
			<span class="book-tit">重复密码</span>
		    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="请再次输入密码." />  
		</li>
		<li>
			<span class="book-tit" for="avatar_aid">上传图像</span>
		    <input type="hidden" name="avatar_aid" id="avatar_aid" value="0">
		</li>
	</ul>
	<div class="step-btn">
		<input type="hidden" name="callback_url" value="<{$_callback_url}>"/>
		<button type="submit" class="ta-center db">注册</button>
	</div>
	<div style="text-align:center;font-size:15px;">
		已有用户,<a href="<{'member/login?callback_url='|url}><{urlencode($_callback_url)}>">去登录</a>
	</div>
</form>
<{include file="home/footer.inc.tpl"}>	
<{/block}>