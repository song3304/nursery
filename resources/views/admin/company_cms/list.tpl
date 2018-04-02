<{extends file="admin/extends/list.block.tpl"}>

<{block "title"}>公司资讯<{/block}>

<{block "name"}>company_cms<{/block}>

<{block "filter"}>
<{include file="admin/company_cms/filters.inc.tpl"}>
<{/block}>

<{block "table-th-plus"}>
<th>标题</th>
<th>图片</th>
<th>内容</th>
<{/block}>

<{block "table-td-plus"}>
<td data-from="title">{{data}}</td>
<td data-from="pic_id"><img src="<{''|attachment}>?id={{data}}&width=80&height=80" alt="图片"></td>
<td data-from="contents">{{data}}</td>
<{/block}>

<{block "table-td-options-delete-confirm"}>您确定删除这项：{{full.title}}吗？<{/block}>