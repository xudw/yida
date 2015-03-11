<?php
class IndexAction extends BaseAction{
    public function index() {
        $db = $this->loader->database();
		$db->a();
		$db->b();
		$db->c();
        $this->_test();
    }
	public function _test() {
		$db = $this->loader->database();
		$db->abc();
		print_r($this->loader->model('index')->index());
		
	}
}     
?>