<html>
    {: page.showPage($a,'b')}
    {if ( isset($a) || $a == $b || $b !== $a )}
        {*$b*}
    {/if} 
    {foreach ( from=$a item = value key = key )}
        {foreach ( from = $a item=v key=k )}
            {$k}
            {$value}
        {/foreach}
    {/foreach}
    {: isset($a)}
</html>