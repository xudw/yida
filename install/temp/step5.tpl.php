<?php echo $this->fetch('master'); ?>
<div class='container'>
  <div class='modal-dialog' style='width: 450px'>
    <form method='post' class='form-horizontal'>
      <div class='modal-header'><strong><i class='icon-key'></i>设置管理员</strong></div>
      <div class='modal-body'>
        <div class='form-group'>
          <label for='account' class='col-xs-2 control-label'>密码</label>
          <div class='col-xs-8'><input type="text" name="account" /></div>
        </div>
        <div class='form-group'>
          <label for='password' class='col-xs-2 control-label'>密码</label>
          <div class='col-xs-8'><input type="text" name="password" /></div>
        </div>
      </div>
      <div class='modal-footer'><input type="submit" class='btn btn-primary'></div>
    </form>
  </div>
</div>
<?php echo $this->fetch('bottom'); ?>
