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
<{/foreach}>