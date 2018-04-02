<{extends file="admin/extends/list.block.tpl"}>

<{block "title"}>财务报表<{/block}>

<{block "name"}>statistics<{/block}>

<{block "filter"}>
<{include file="admin/order/filters.inc.tpl"}>
<{/block}>

<{block "table-th-plus"}>
<th>日期</th>
<th>收入</th>
<!--th>线下</th-->
<th>支付宝</th>
<th>微信</th>
<th>农商行<th>
<{/block}>

<{block "table-td-plus"}>
<td data-from="s_date" data-orderable="false"><a href="<{'admin/order?'|url}>base=&filters[created_at][min]={{data}} 00:00:00&filters[created_at][max]={{data}} 23:59:59" target="_blank">{{data}}</a></td>
<td data-from="purchase" data-orderable="false">{{data}}</td>
<td data-from="offline" data-orderable="false">{{data}}</td>
<td data-from="alipay" data-orderable="false">{{data}}</td>
<td data-from="weixin" data-orderable="false">{{data}}</td>
<td data-from="rcb" data-orderable="false">{{data}}</td>
<{/block}>



<{block "table-td-options"}>
	<td class="text-center" data-from="" data-orderable="false">
		<div class="btn-group">
			无
		</div>
	</td>
<{/block}>

<{block "table-th-timestamps"}><{/block}>
<{block "table-td-timestamps"}><{/block}>