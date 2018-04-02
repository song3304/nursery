<{extends file="admin/extends/edit.block.tpl"}>

<{block "title"}>地址<{/block}>
<{block "subtitle"}><{$_data.account_num}>-<{$_data.account_name}><{/block}>

<{block "name"}>user_address<{/block}>

<{block "fields"}>
<{include file="admin/user_address/fields.inc.tpl"}>
<{/block}>
