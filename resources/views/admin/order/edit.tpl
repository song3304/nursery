<{extends file="admin/extends/edit.block.tpl"}>

<{block "title"}>订单<{/block}>
<{block "subtitle"}><{$_data.account_num}>-<{$_data.account_name}><{/block}>

<{block "name"}>order<{/block}>

<{block "fields"}>
<{include file="admin/order/fields.inc.tpl"}>
<{/block}>
