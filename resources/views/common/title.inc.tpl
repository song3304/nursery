<title><{config('settings.title')}>
<{if !empty($_site_titles)}>
<{foreach $_site_titles as $v}> - <{$v}><{/foreach}>
<{/if}>
</title>