<?php if (( $this->_var['a'] == $this->_var['b'] && $this->_var['a'] != $this->_var['b'] )): ?>
<?php endif; ?>
<?php $_from = $this->_var['a']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'foo');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['foo']):
?>
    <?php echo $this->_var['k']; ?>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
t
<html>
<?php echo $this->_var['a']['b']; ?>
<?php echo $this->_var['b']; ?>
<?php echo $this->_var['b']; ?>
</html>