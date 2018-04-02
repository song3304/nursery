<{extends file="admin/extends/list.block.tpl"}>

<{block "title"}>地址<{/block}>

<{block "name"}>user_address<{/block}>

<{block "filter"}>
<{include file="admin/user_address/filters.inc.tpl"}>
<{/block}>

<{block "table-th-plus"}>
<th>用户</th>
<th>户号</th>
<th>户名</th>
<th>地址</th>
<th>预留电话</th>
<{/block}>

<{block "table-td-plus"}>
<td data-from="user" data-orderable="false">{{data.username}}</td>
<td data-from="account_num">{{data}}</td>
<td data-from="account_name">{{data}}</td>
<td data-from="account_address">{{data}}</td>
<td data-from="account_phone">{{data}}</td>
<{/block}>

<{block "table-td-options-delete-confirm"}>您确定删除这项：{{full.account_num}}吗？<{/block}>