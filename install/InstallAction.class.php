<?php
/**
 *==============================================
 * 
 * author:sunchao <phper123@gmail.com>
 * version:0.1
 * date:2014-02-22
 *==============================================
 */

/**
 * 软件安装程序
 * 软件安装
 */ 
class InstallAction extends BaseAction {
    /**
     *第一步操作
     *安装阅读操作
     */
    public function index() {
        $this->template->display('install');
    }
    /**
     *第二步操作
     */
    public function setup2() {
        
    }
    /**
     *第三步操作
     *
     */
    public function setup3() {
    
    }
    /**
     *第四步操作
     *
     */
    public function location(){
        
    }
     
    public function update() {
        $db = $this->loader->database();
        $result = $db->table('user u1,user u2')->field('u1.id,u2.id as id1,u1.user_name,u2.user_name as user_name2')->where('u1.id = u2.id')->limit(0,10)->select();
        //print_r($result);
        //echo $this->loader->language();
        $this->update();
        $db = $this->loader->database();
        $property = array('user_name'=>'test1','user_account'=>'test1');
        $result = $db->table('user')->where('id=1')->update($property);
        /*echo $db->getLastId();
        print_r($GLOBALS['language']);
        echo $result;*/
        $this->template->display('install.tpl');    
    }
	public function test() {
		//$this->loader->func('url');
		//echo getURL();
		//$this->loader->model('install');
		//$result = $this->install->connectDB();
		//print_r($result);
		$this->loader->library('session');
		//$sessionId = $this->session->getSessionId();
		//echo $sessionId;
        $this->template->assign('a',array('a'=>'a','b'=>'d'));
		$this->template->assign('b','b');
		$this->template->display('test');
	}
}
?>