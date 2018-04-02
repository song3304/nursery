<{extends file="admin/extends/create.block.tpl"}>

<{block "head-plus"}>
<{include file="common/uploader.inc.tpl"}>
<{/block}>

<{block "inline-script-plus"}>
$('#pic_id').uploader();
<{/block}>

<{block "title"}>公司简介<{/block}>

<{block "name"}>company_info<{/block}>

<{block "fields"}>
<{include file="admin/company_info/fields.inc.tpl"}>
<{/block}>
