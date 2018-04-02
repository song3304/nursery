<ul class="row subnav header">
<{foreach $_navigation as $item}>
    <li class="col-xs-2">
        <a href="<{'m/home?'|url}>nid=<{$item.id}>"<{if $item.id == $_nid}> class='active'<{/if}>>
            <{$item.name}>
        </a>
    </li>
 <{/foreach}>
    <li class="col-xs-2">
        <a href="<{'m/home'|url}>"<{if empty($_nid)}> class='active'<{/if}>>
                      全部
        </a>
    </li>           
</ul>