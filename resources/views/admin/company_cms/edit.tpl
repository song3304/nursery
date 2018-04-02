<{extends file="admin/extends/edit.block.tpl"}>

<{block "head-plus"}>
<{include file="common/uploader.inc.tpl"}>
<{/block}>

<{block "inline-script-plus"}>
$('#pic_id').uploader();
<{/block}>

<{block "title"}>公司资讯<{/block}>
<{block "subtitle"}><{$_data.title}><{/block}>

<{block "name"}>company_cms<{/block}>

<{block "fields"}>
<{include file="admin/company_cms/fields.inc.tpl"}>
<{/block}>
