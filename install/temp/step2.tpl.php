<?php echo $this->fetch('master'); ?>
<style>
body{background-color: #f1f1f1}
.container{padding: 0}
.modal-dialog{width: 800px}
.modal-footer{text-align: center;margin-top: 0;}

.table,.alert{margin: 0;}
.table+.alert{margin-top: 20px;}
.table.table-form>thead>tr>th, .table.table-form>tbody>tr>th, .table.table-form>tfoot>tr>th{color: #666}
.table>thead>tr>th{background-color: transparent;}
.table.table-form>thead>tr>th, .table.table-form>tbody>tr>th, .table.table-form>tfoot>tr>th, .table.table-form>thead>tr>td, .table.table-form>tbody>tr>td, .table.table-form>tfoot>tr>td{vertical-align: middle;}

@media (max-width: 700px){.modal-dialog{padding: 0;} .modal-content{box-shadow: none;border-width: 1px 0;border-radius: 0}}
h3{font-size:16px; margin-bottom: 20px;}
blockquote{padding: 0; border-left: 0;}
li{line-height: 2em}
.modal-dialog{position: relative;}
.modal-header{position: absolute; right: 15px; top: 10px; border: none;z-index: 999}
.modal-body{padding: 20px 60px;}

.dropdown.btn{padding: 0;overflow: visible;}
.dropdown a:hover,button a:active,.dropdown a:focus{text-decoration: none;}
.dropdown .dropdown-menu li{text-align: left}
.dropdown .caret{margin-left: 8px;}
.dropdown-toggle{padding: 6px 12px; display: inline-block;}
</style>
<div class='container'>
  <div class='modal-dialog'>
    <div class="modal-header text-right"><div class='btn dropdown'>
</div></div>
    <div class='modal-body'>
      <h3>用户密钥</h3>
    <div>
<blockquote>
  <form action="install.php?method=step3" method="POST">
    <ul>
        <li><strong>帐号:</strong><input type="text" name="account"></li>
        <li><strong>密钥:</strong><input type="text" name="secretkey"></li>
        <?php if( isset ( $this->_var['validateError'] ) ): ?><li>您输入的验证码错误请重新输入</li><?php endif; ?>
    </ul>
    <div class='modal-footer'>
      <button type="submit" class='btn btn-primary'>提交</button>
    </div>
  </form>
</blockquote></div>
    </div>
  </div>
</div>
<?php echo $this->fetch('bottom'); ?>
