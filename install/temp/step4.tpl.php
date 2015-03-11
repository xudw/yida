<?php echo $this->fetch('master'); ?>
<div class='container'>
  <div class='modal-dialog'>
    <form method='post' action='install.php?method=step5' class='form-inline' method="POST">
      <div class='modal-header'><strong>数据库配置</strong></div>
      <div class='modal-body'>
        <table class='table table-bordered table-form'>
          <thead>
            <tr class='text-center'>
              <th>配置项</th>
              <th>值</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>数据库服务器</th>
              <td><input type="text" name="dbHost" value="127.0.0.1"></td>
            </tr>
            <tr>
              <th>服务器端口</th>
              <td><input type="text" name="dbPort" value="3306"></td>
            </tr>
            <tr>
              <th>数据库用户名</th>
              <td><input type="text" name="dbUser" value="root"></td>
            </tr>
            <tr>
              <th>数据库密码</th>
              <td><input type="text" name="dbPass" value=""></td>
            </tr>
            <tr>
              <th>数据库名</th>
              <td><input type="text" name="dbName" value="yida"></td>
            </tr>
            <tr>
              <th>建表使用的前缀</th>
              <td><input type="text" name="dbPrefix" value="yida_"></td>
            </tr>
            <?php if( isset ( $this->_var['error'] ) ): ?>
            <tr>
              <th colspan='2' style="text-align:center;color:red;"><?php echo Action::getInstance()->lang[$this->_var['error']]; ?></th>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class='modal-footer'>
        <input type="submit" value="提交" class='btn btn-primary' />  
      </div>
    </form>
  </div>
</div>
<?php echo $this->fetch('bottom'); ?>
