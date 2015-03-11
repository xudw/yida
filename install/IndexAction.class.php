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
 * 初始安装程序
 * 安装介绍
 */
class IndexAction extends BaseAction {
    /**
     * 初始化Index
     */
    public function __construct() {
        parent::__construct();
        $this->loader->library('access');
    }
	/**
	 * 安装程序介绍
	 */
	public function index() {
        $_SESSION['setup_validate'] = false;
		$this->template->display('index');
	}
    /**
     * 第一步安装协议
     */
    public function step1() {
        $_SESSION['setup_validate'] = false;
        $this->template->display('step1');
    }
    /**
     * 第二步安装密钥
     */
    public function step2() {
        if(isset($_GET['validate'])) { 
            $this->template->assign('validateError',true);
        }
        $this->template->display('step2');
    }
    /**
     * 第三步安装环境
     */
    public function step3() {
        $key = isset($_POST['account'])?isset($_POST['secretkey'])?sha1(sha1($_POST['account']).sha1($_POST['secretkey'])):'':'';
        $base = $this->config->get('base');
        if($base['code'] != $key){
            $this->access->Redirect('install.php?method=step2&validate');
        }else{
            $_SESSION['setup_validate'] = true;
            $this->loader->model('index');
            $this->template->assign('phpVersion',PHP_VERSION);
            $this->template->assign('checkphp',$this->index->checkPHPVersion());
            $this->template->assign('checkMySql',$this->index->checkMySQL());
            $this->template->assign('checkMySqli',$this->index->checkMySQLi());
            $this->template->assign('checkGD2',$this->index->checkGD2());
            $this->template->assign('checkTempRoot',$this->index->checkTempRoot());
            $this->template->display('step3');
        }
    }
    /**
     * 第四步安装设置
     */
    public function step4() {
        if(!$_SESSION['setup_validate']) $this->access->Redirect('install.php?method=step2');
        if(isset($_GET['error'])) {
            $this->template->assign('error', $_GET['error']);
        }
        $this->template->display('step4');
    }
    /**
     * 第五步程序安装
     */
    public function step5() {
        if(!$_SESSION['setup_validate']) $this->access->Redirect('install.php?method=step2');
        $arr['dbHost'] = isset($_POST['dbHost']) ? $_POST['dbHost'] : '';
        $arr['dbPort'] = isset($_POST['dbPort']) ? $_POST['dbPort'] : '';
        $arr['dbUser'] = isset($_POST['dbUser']) ? $_POST['dbUser'] : '';
        $arr['dbPass'] = isset($_POST['dbPass']) ? $_POST['dbPass'] : '';
        $arr['dbName'] = isset($_POST['dbName']) ? $_POST['dbName'] : '';
        $arr['dbPrefix'] = isset($_POST['dbPrefix']) ? $_POST['dbPrefix'] : '';
        $this->loader->model('index');
        $result = $this->index->checkConfig($arr);
        if('connectOk' == $result) {
            $this->template->display('step5');
        }elseif('connectError' == $result) {
            $this->access->Redirect('install.php?method=step4&error=connectError');
        }elseif('noDatabase' == $result) {
            $this->access->Redirect('install.php?method=step4&error=noDatabase');
        }else{
            $this->access->Redirect('install.php?method=step4');
        }
    }
    /**
     * 第六步使用程序
     */
    public function step6() {
        if(!$_SESSION['setup_validate']) $this->access->Redirect('install.php?method=step2');
        $arr['user'] = isset($_POST['account']) ? $_POST['account'] : 'admin';
        $arr['pass'] = isset($_POST['password']) ? $_POST['password'] : 'admin';
        $this->loader->model('index');
        $this->index->saveAdmin($arr);
        $this->template->display('step6');
    }
}
?>