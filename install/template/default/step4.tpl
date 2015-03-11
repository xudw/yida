{include file=master}
<div class='container'>
  <div class='modal-dialog'>
    <form method='post' action='install.php?method=step5' class='form-inline' method="POST">
      <div class='modal-header'><strong>{$lang.setConfig}</strong></div>
      <div class='modal-body'>
        <table class='table table-bordered table-form'>
          <thead>
            <tr class='text-center'>
              <th>{$lang.key}</th>
              <th>{$lang.value}</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>{$lang.dbHost}</th>
              <td><input type="text" name="dbHost" value="127.0.0.1"></td>
            </tr>
            <tr>
              <th>{$lang.dbPort}</th>
              <td><input type="text" name="dbPort" value="3306"></td>
            </tr>
            <tr>
              <th>{$lang.dbUser}</th>
              <td><input type="text" name="dbUser" value="root"></td>
            </tr>
            <tr>
              <th>{$lang.dbPass}</th>
              <td><input type="text" name="dbPass" value=""></td>
            </tr>
            <tr>
              <th>{$lang.dbName}</th>
              <td><input type="text" name="dbName" value="yida"></td>
            </tr>
            <tr>
              <th>{$lang.dbPrefix}</th>
              <td><input type="text" name="dbPrefix" value="yida_"></td>
            </tr>
            {if (isset($error))}
            <tr>
              <th colspan='2' style="text-align:center;color:red;">{$lang.$error}</th>
            </tr>
            {/if}
          </tbody>
        </table>
      </div>
      <div class='modal-footer'>
        <input type="submit" value="提交" class='btn btn-primary' />  
      </div>
    </form>
  </div>
</div>
{include file=bottom}
