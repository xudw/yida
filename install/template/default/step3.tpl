{include file=master}
<div class='container'>
  <div class='modal-dialog'>
    <div class='modal-header'><strong>{$lang.checking}</strong></div>
    <div class='modal-body'>
      <table class='table table-bordered'>
        <thead>
          <tr>
            <th style='width: 20%'>{$lang.checkItem}</th>
            <th style='width: 20%'>{$lang.current}</th>
            <th>{$lang.result}</th>
          </tr>
        </thead>
        <tr>
          <th>{$lang.phpVersion}</th>
          <td>{$phpVersion}</td>
          <td>{if ($checkphp == 'ok')}{$lang.phpOk}{else}{$lang.phpFail}{/if}</td>
        </tr>
        <tr>
          <th>{$lang.extMySQL}</th>
          <td>{if ($checkMySql == 'ok')}{$lang.realLoad}{else}{$lang.noLoad}{/if}</td>
          <td>{if ($checkMySql == 'ok')}{$lang.phpOk}{else}{$lang.phpFail}{/if}</td>
        </tr> 
        <tr>
          <th>{$lang.extMySQLi}</th>
          <td>{if ($checkMySqli == 'ok')}{$lang.realLoad}{else}{$lang.noLoad}{/if}</td>
          <td>{if ($checkMySqli == 'ok')}{$lang.phpOk}{else}{$lang.phpFail}{/if}</td>
        </tr>
        <tr>
          <th>{$lang.extGD2}</th>
          <td>{if ($checkGD2 == 'ok')}{$lang.realLoad}{else}{$lang.noLoad}{/if}</td>
          <td>{if ($checkGD2 == 'ok')}{$lang.phpOk}{else}{$lang.phpFail}{/if}</td>
        </tr> 
        <tr>
          <th>{$lang.tempRoot}</th>
          <td>{if ($checkTempRoot == 'ok')}{$lang.realLoad}{else}{$lang.noLoad}{/if}</td>
          <td>{if ($checkTempRoot == 'ok')}{$lang.phpOk}{else}{$lang.phpFail}{/if}</td>
        </tr>
      </table>
    </div>
    <div class='modal-footer'>
        {if (strpos($checkphp.$checkMySql.$checkMySqli.$checkGD2.$checkTempRoot,'fail') !== false)}
            <a href='install.php?method=step2' class='btn btn-primary'>{$lang.prevStep}</a>
        {else}
            <a href='install.php?method=step4' class='btn btn-primary'>{$lang.nextStep}</a>
        {/if}
    </div>
  </div>
</div>
{include file=bottom}
