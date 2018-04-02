<{extends file="admin/extends/list.block.tpl"}>
<!--
公共Block
由于extends中无法使用if/include，所以需要将公共Block均写入list.tpl、datatable.tpl
-->

<{block "title"}>Banner<{/block}>

<{block "name"}>banner<{/block}>


<{block "table-th-plus"}>
<th>图片</th>
<th>标题</th>
<th>url</th>
<th>排序</th>
<th>是否显示</th>
<{/block}>

<!-- DataTable的Block -->

<{block "table-td-plus"}>
<td data-from="cover">
	<img src="<{''|attachment}>?id={{data}}&width=80&height=80" alt="图片">
</td>
<td data-from="title">{{data}}</td>
<td data-from="url">{{data}}</td>
<td data-from="porder">{{data}}</td> 
<td data-from=""  data-orderable="false"><a href='<{''|url}>/<{block "namespace"}>admin<{/block}>/banner/toggle/{{full.id}}'>{{if full.status==1}}√{{else}}x{{/if}}</a></td>
<{/block}>

<{block "table-td-options-delete-confirm"}>您确定删除这项：{{full.title}}吗？<{/block}>