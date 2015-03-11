<?php echo $this->fetch('master'); ?>
<div class='container'>
  <div class='modal-dialog'>
    <div class='modal-header'><strong>检查配置环境</strong></div>
    <div class='modal-body'>
      <table class='table table-bordered'>
        <thead>
          <tr>
            <th style='width: 20%'>检查项</th>
            <th style='width: 20%'>当前配置</th>
            <th>检查结果</th>
          </tr>
        </thead>
        <tr>
          <th>PHP版本</th>
          <td><?php echo $this->_var['phpVersion']; ?></td>
          <td><?php if( $this->_var['checkphp'] == 'ok' ): ?>通过(√)<?php else: ?>失败(×)<?php endif; ?></td>
        </tr>
        <tr>
          <th>MySQL扩展</th>
          <td><?php if( $this->_var['checkMySql'] == 'ok' ): ?>已加载<?php else: ?>未加载<?php endif; ?></td>
          <td><?php if( $this->_var['checkMySql'] == 'ok' ): ?>通过(√)<?php else: ?>失败(×)<?php endif; ?></td>
        </tr> 
        <tr>
          <th>MySQLi扩展</th>
          <td><?php if( $this->_var['checkMySqli'] == 'ok' ): ?>已加载<?php else: ?>未加载<?php endif; ?></td>
          <td><?php if( $this->_var['checkMySqli'] == 'ok' ): ?>通过(√)<?php else: ?>失败(×)<?php endif; ?></td>
        </tr>
        <tr>
          <th>GD2扩展</th>
          <td><?php if( $this->_var['checkGD2'] == 'ok' ): ?>已加载<?php else: ?>未加载<?php endif; ?></td>
          <td><?php if( $this->_var['checkGD2'] == 'ok' ): ?>通过(√)<?php else: ?>失败(×)<?php endif; ?></td>
        </tr> 
        <tr>
          <th>临时文件目录</th>
          <td><?php if( $this->_var['checkTempRoot'] == 'ok' ): ?>已加载<?php else: ?>未加载<?php endif; ?></td>
          <td><?php if( $this->_var['checkTempRoot'] == 'ok' ): ?>通过(√)<?php else: ?>失败(×)<?php endif; ?></td>
        </tr>
      </table>
    </div>
    <div class='modal-footer'>
        <?php if( strpos ( $this->_var['checkphp'].$this->_var['checkMySql'].$this->_var['checkMySqli'].$this->_var['checkGD2'].$this->_var['checkTempRoot'] , 'fail' ) !== false ): ?>
            <a href='install.php?method=step2' class='btn btn-primary'>上一步</a>
        <?php else: ?>
            <a href='install.php?method=step4' class='btn btn-primary'>下一步</a>
        <?php endif; ?>
    </div>
  </div>
</div>
<?php echo $this->fetch('bottom'); ?>
