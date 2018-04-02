<{extends file="admin/extends/edit.block.tpl"}>

<{block "title"}>通知<{/block}>
<{block "subtitle"}><{$_data.title}>-<{$_data.title}><{/block}>

<{block "name"}>notice<{/block}>

<{block "fields"}>
<{include file="admin/notice/fields.inc.tpl"}>
<{/block}>
