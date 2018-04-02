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
		<span>用户资料</span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	
<form action="<{'ucenter/save_info'|url nofilter}>"  method="POST" autocomplete="off" id="form">
	<input type="hidden" name="_token" value="<{csrf_token()}>">
	<ul class="dorm-book">
		<li>
			    <span class="book-tit">用户名</span>
			    <input type="text"  name="username" id="username" value="<{$user.username}>" readOnly="readOnly"> 
			    <div class="sex">
			    	<{foreach 'fields.gender.children'|catalogs as $v}>
			    	<label data-gender="<{$v.id}>"<{if $v.id==$user.gender.id}> class="sex-check"<{/if}>><{$v.title}></label>
			    	<{/foreach}>
			    	<input type="hidden" name="gender" id="gender" value='<{$user.gender.id}>'/>
			    </div>
		</li>
		<li>
			<span class="book-tit">昵称</span>
		    <input type="text" name="nickname" id="nickname" placeholder="请输入昵称." value="<{$user.nickname}>"/>  
		</li>
		<li>
			<span class="book-tit">邮箱</span>
		    <input type="text" name="email" id="email" placeholder="请输入邮箱." value="<{$user.email}>"/>  
		</li>
		<li>
			<span class="book-tit" for="avatar_aid">上传图像</span>
		    <input type="hidden" name="avatar_aid" id="avatar_aid" value="<{$user.avatar_aid}>">
		</li>
	</ul>
	<div class="step-btn" style="margin-bottom:100px;">
		<button type="submit" class="ta-center db">修改</button>
	</div>
</form>
<{include file="home/footer.inc.tpl"}>	
<{/block}>