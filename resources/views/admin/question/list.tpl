<{extends file="admin/extends/list.block.tpl"}>

<{block "title"}>常见问题<{/block}>

<{block "name"}>question<{/block}>

<{block "filter"}>
<{include file="admin/question/filters.inc.tpl"}>
<{/block}>

<{block "table-th-plus"}>
<th>用户</th>
<th>提问</th>
<th>回复上级</th>
<{/block}>

<{block "table-td-plus"}>
<td data-from="user" data-orderable="false">{{data.username}}</td>
<td data-from="content">{{data}}</td>
<td data-from="parents">{{if data}}{{data.user.username}}:{{data.content}}{{else}}无{{/if}}</td>
<{/block}>


<{block "table-td-options-plus"}>
<a href="<{''|url}>/<{block "namespace"}>admin<{/block}>/<{block "name"}>question<{/block}>/reply/{{full.id}}" data-toggle="tooltip" title="回复" class="btn btn-xs btn-default">回复</a>
<a href="<{''|url}>/<{block "namespace"}>admin<{/block}>/<{block "name"}>question<{/block}>?&f[pid]={{full.id}}" data-toggle="tooltip" title="查看回复" class="btn btn-xs btn-default">查看</a>
<{/block}>

<{block "table-td-options-delete-confirm"}>您确定删除这项：{{full.content}}吗？<{/block}>