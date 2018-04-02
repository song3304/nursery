<{extends file="extends/main.block.tpl"}>

<{block "head-styles-after"}>
	<link rel="stylesheet" type="text/css" href="<{'static/css/iconfont/iconfont.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/iconfont/address.css'|url}>" />
	<style>.active{border:1px solid green;}.my_pay{height:40px;line-height:40px;margin-bottom: 7px;}
	.my_address{height:88px;}.my_delete{height:40px;line-height:40px;}.cursor{cursor:pointer;}</style>
<{/block}>

<{block "body-container"}>
<!--header顶部标题-->
<div class="header">地址信息
	<div id="address_url" class="header_left cursor" data-url="<{$_callback_url}>" data-aid="<{$_current_id}>" id="address_url"><i class="iconfont icon-left"></i></div>
    <div class="header_right cursor" id="edit"><{if count($_user_address_list)}>编辑<{/if}></div>
</div>
<!--address地址-->
<{foreach $_user_address_list as $address}>
<div id="address_<{$address.id}>" data-aid="<{$address.id}>" class="address my_address<{if $_current_id==$address.id}> active<{/if}>">
	<div class="border_top"></div>
    	<h2>户号：<span><{$address.account_num}></span></h1>
        <h2>户名：<span><{$address.account_name}></span></h2>
        <h2>电话：<span><{$address.account_phone}></span></h2>
        <h2>地址：<span><{$address.account_address}></span></h2>
        <div class="fix_right">
        <div class="pay my_pay cursor" data-aid="<{$address.id}>">编辑</div>
        <div class="delete my_delete cursor" data-aid="<{$address.id}>">删除</div>
        </div>
    <div class="border_bottom"></div>
</div>
<{foreachelse}>
<div class="address" style="height:38px;"><div class="border_top"></div><h1>没有交费地址，请先添加.</h1><div class="border_bottom"></div></div>
<{/foreach}>
<!--column添加新地址-->
<div class="column_box" style="margin-top:14px;" onclick="document.location.href='<{'ucenter/add_address'|url}>?callback_url=<{$_callback_url|urlencode}>';">
	<div class="border_top"></div>
	<div class="column_img"><img src="<{'static/img/add.png'|url}>"></div>
    <p>添加新地址</p>
    <div class="next"><img src="<{'static/img/arrow.png'|url}>"></div>
    <div class="border_bottom"></div>
</div>
<{/block}>

<{block "body-scripts-jquery"}>
(function($){
	$('#address_url').click(function(){
		var url = $(this).data('url');
		window.location.href = url+((url.indexOf('?')>0)?'&':'?')+'aid='+$(this).data('aid');
	});
	$(".fix_right").hide();
	$('#edit').click(function(){
		var edti_val=$(this).html();
		if(edti_val=="编辑"){
			$(".fix_right").show();
			$(this).html("取消");
		}else if(edti_val=="取消"){
			$(".fix_right").hide();
			$(this).html("编辑");
		}
	});
	
	$('.pay').click(function(){
		window.location.href='<{'ucenter/modify_address'|url}>?address_id='+$(this).data('aid')+'&callback_url=<{$_callback_url|urlencode}>';
	});
	
	$('.address').each(function(){
		$(this).click(function(){
			$(this).addClass('active').siblings('.address').removeClass('active');
			$('#address_url').data('aid',$(this).data('aid'));
		});
	});
	
	$(".delete").click(function(){
		var _obj = this;
		if($('.address').length<2) {alert('必须保留一条交费地址');return false;}
		$.get('<{'ucenter/address_remove'|url}>',{address_id:$(_obj).data('aid')},function(response){
			if(response.result == "success"){
				$(_obj).parent().parent().remove();
				if($('#address_url').data('aid') == $(_obj).data('aid')){
					$('.address:first').trigger('click');
					$('#address_url').data('aid',$('.address:first').data('aid'));
				}
			}else{
				alert(response.message.title);
			}
		},'json');
	});
	
	
})(jQuery);
<{/block}>	