<{extends file="admin/extends/list.block.tpl"}>

<{block "title"}>订单<{/block}>

<{block "name"}>order<{/block}>

<{block "filter"}>
<{include file="admin/order/filters.inc.tpl"}>
<{/block}>

<{block "table-th-plus"}>
<th>用户</th>
<th>户号</th>
<th>户名</th>
<th>地址</th>
<th>预留电话</th>
<th>交费金额</th>
<th>支付信息</th>
<th>状态</th>
<{/block}>

<{block "table-td-plus"}>
<td data-from="user" data-orderable="false">{{data.username}}</td>
<td data-from="account_num">{{data}}</td>
<td data-from="account_name">{{data}}</td>
<td data-from="account_address">{{data}}</td>
<td data-from="account_phone">{{data}}</td>
<td data-from="sumMoney">{{data}}</td>
<td data-from="pay_msg">{{data}}</td>
<td data-from="order_status">{{data}}</td>
<{/block}>



<{block "table-td-options"}>
	<td class="text-center" data-from="" data-orderable="false">
		<div class="btn-group">
			{{if full.status == 1}}
			<a href="<{''|url}>/<{block "namespace"}>admin<{/block}>/order/{{full.id}}/cancel" method="delete" confirm="<{block "table-td-options-delete-confirm"}>您确定取消这个订单：{{full.id}}吗？<{/block}>" data-toggle="tooltip" title="取消" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
			{{else if full.status == 2}}
			<a href="<{''|url}>/<{block "namespace"}>admin<{/block}>/order/{{full.id}}/recharge" data-toggle="tooltip" title="充值" class="btn btn-xs btn-default">充值</a>
			{{else}}
			无
			{{/if}}
		</div>
	</td>
<{/block}>

<{block "table-td-options-delete-confirm"}>您确定删除这条支付记录：{{full.account_num}}-({{full.sumMoney}}元)吗？<{/block}>