<{extends file="extends/main.block.tpl"}>

<{block "head-styles-after"}>
	<link rel="stylesheet" type="text/css" href="<{'static/css/iconfont/iconfont.css'|url}>" />
	<link rel="stylesheet" type="text/css" href="<{'static/css/iconfont/address.css'|url}>" />
	<style>.cursor{cursor:pointer;}</style>
<{/block}>

<{block "head-scripts-plus"}>
	<script type="text/javascript">
	 var current_page = <{$_order_list->currentPage()}>;
 	 var last_page = <{$_order_list->lastPage()}>;
	(function($){
		function bind_click(){
				$(".pay").off('click').on('click',function(){
						var order_id = $(this).data('oid');
						window.location.href="<{'order/choose_pay?id='|url}>"+order_id;
					});
				
				$(".delete").off('click').on('click',function(){
					var _obj = this;
					$.get('<{'ucenter/order_remove'|url}>',{order_id:$(_obj).data('oid')},function(response){
						if(response.result == "success"){
							$(_obj).parent().parent().remove();
						}else{
							alert(response.message.title);
						}
					},'json');	
				});
		}
		$().ready(function(){
			bind_click();
		});
		$(window).scroll(function(){
			if(current_page >= last_page) return false;
			var $this =$(this),		
			viewH =$(this).height(),//可见高度		
			contentH =$(document.body).height(),//内容高度		
			scrollTop =$(this).scrollTop();//滚动高度
			if(contentH - viewH - scrollTop <= 2)  //到达底部2px时,加载新内容			
			{ 		
				$.post("<{'ucenter/order_list'|url}>",{page:++current_page},function(data){
					$('#container').append(data);
					bind_click();
				},'html');
			}
		});
		
	})(jQuery);
	</script>
<{/block}>

<{block "body-container"}>
<!--header顶部标题-->
<div class="header">我的订单
	<div class="header_left"  onclick="window.history.go(-1)"><i class="iconfont icon-left"></i></div>
</div>
<div id="container" style="width:100%;">
<!--address地址-->
<{foreach $_order_list as $order_item}>
<div class="address">
		<div class="border_top"></div>
		<h1>订单编号：<span><{$order_item.id}></span>&nbsp;&nbsp;&nbsp;&nbsp;时间：<span><{$order_item.created_at|date_format:"%m-%d %H:%M"}></span></h1>
    	<h2>户号：<span><{$order_item.account_num}></span></h1>
        <h2>户名：<span><{$order_item.account_name}></span>&nbsp;&nbsp;&nbsp;&nbsp;电话：<span><{$order_item.account_phone}></span></h2>
        <h2>地址：<span><{$order_item.account_address}></span></h2>
        <h2>交水费：<span>￥<{$order_item.sumMoney}>元</span>&nbsp;&nbsp;状态：<span style="<{if $order_item.status >1}>color:red;<{else}>color:green;<{/if}>"><{$order_item->order_status()}></span></h2>
        <div class="fix_right">
	        <div class="pay cursor" data-oid="<{$order_item.id}>"><{if $order_item.status>1}>再次支付<{else}>去支付<{/if}></div>
	        <div class="delete cursor" data-oid="<{$order_item.id}>">删除</div>
        </div>
    	<div class="border_bottom"></div>
</div>
<{foreachelse}>
	<div class="address">
			<div class="border_top"></div>
			<h1 class="text-center">对不起,你没有交费记录,去<a href="<{'order'|url}>">交水费</a></h1>
	   		<div class="border_bottom"></div>
	</div>
<{/foreach}>
</div>
<{/block}>