<{extends file="admin/extends/edit.block.tpl"}>

<{block "head-plus"}>
<{include file="common/uploader.inc.tpl"}>
<{/block}>

<{block "inline-script-plus"}>
$('#pic_id').uploader();
<{/block}>

<{block "title"}>常见问题<{/block}>
<{block "subtitle"}><{$_data.title}><{/block}>

<{block "name"}>article<{/block}>

<{block "fields"}>
<{include file="admin/article/fields.inc.tpl"}>
<{/block}>
