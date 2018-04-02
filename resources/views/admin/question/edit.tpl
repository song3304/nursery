<{extends file="admin/extends/edit.block.tpl"}>

<{block "title"}>常见问题<{/block}>
<{block "subtitle"}><{$_data.user.username}>-<{$_data.content}><{/block}>

<{block "name"}>question<{/block}>

<{block "fields"}>
<{include file="admin/question/fields.inc.tpl"}>
<{/block}>
