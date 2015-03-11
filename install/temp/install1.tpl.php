<?php echo $this->fetch('index'); ?>
<link href="<?php echo $this->relativeDir.'/css/bigfoucs.css'; ?>" rel="stylesheet" type="text/css" />
<?php $_from = $this->_var['a']; if (!is_array($_from) && !is_object($_from)){settype($_from,'array'); } $this->pushVars('k','foo');if (count($_from)):
    foreach ($_from AS $this->_var['k']=>$this->_var['foo']):
?>
    <?php echo $this->_var['k']['a']; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->popVars(); ?>

t
<html>
<?php echo $this->_var['a']['b']; ?>
<?php echo $this->_var['b']; ?>
<?php echo $this->_var['b']; ?>
</html>