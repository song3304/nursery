<{extends file="admin/extends/list.block.tpl"}>

<{block "title"}>常见问题<{/block}>

<{block "name"}>article<{/block}>

<{block "filter"}>
<{include file="admin/article/filters.inc.tpl"}>
<{/block}>

<{block "table-th-plus"}>
<th>标题</th>
<th>图片</th>
<th>内容</th>
<{/block}>

<{block "table-td-plus"}>
<td data-from="title">{{data}}</td>
<td data-from="pic_id">{{if data}}<img src="<{''|attachment}>?id={{data}}&width=80&height=80" alt="图片">{{/if}}</td>
<td data-from="contents">{{data}}</td>
<{/block}>

<{block "table-td-options-delete-confirm"}>您确定删除这项：{{full.title}}吗？<{/block}>