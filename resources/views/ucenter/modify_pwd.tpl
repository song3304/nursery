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
		<span>修改密码</span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	
<form action="<{'ucenter/modified_pwd'|url nofilter}>"  method="POST" autocomplete="off" id="form">
	<input type="hidden" name="_token" value="<{csrf_token()}>">
	<ul class="dorm-book">
		<li>
			<span class="book-tit">旧密码</span>
		    <input type="password" name="old_pwd" id="old_pwd" placeholder="请输入旧密码." />  
		</li>
		<li>
			<span class="book-tit">新密码</span>
		    <input type="password" name="password" id="password" placeholder="请输入新密码." />  
		</li>
		<li>
			<span class="book-tit">重复密码</span>
		    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="请再次输入新密码." />  
		</li>
	</ul>
	<div class="step-btn">
		<button type="submit" class="ta-center db">修改</button>
	</div>
</form>
<{include file="home/footer.inc.tpl"}>	
<{/block}>