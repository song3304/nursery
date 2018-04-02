<{extends file="admin/extends/list.block.tpl"}>

<{block "title"}>通知<{/block}>

<{block "name"}>notice<{/block}>

<{block "filter"}>
<{include file="admin/notice/filters.inc.tpl"}>
<{/block}>

<{block "table-th-plus"}>
<th>标题</th>
<th>内容</th>
<{/block}>

<{block "table-td-plus"}>
<td data-from="title" data-orderable="false">{{data}}</td>
<td data-from="contents">{{data}}</td>
<{/block}>

<{block "table-td-options-delete-confirm"}>您确定删除这项：{{full.title}}吗？<{/block}>