<?php if(!defined('YIDA')) define('YIDA',true);
/**
 *==============================================
 * 易达团队开发
 * author:sunchao <phper123@gmail.com>
 * version:0.1
 * date:2014-02-18
 *==============================================
 */
//定义常量,单一入口文件 
define('DS', DIRECTORY_SEPARATOR);
define('APP_DIR', 'app');
define('BASE_PATH', dirname(__FILE__).DS);
define('APP_PATH', BASE_PATH . APP_DIR . DS);
//判断文件是否已经安装,在安装完程序后，可将此代码注释
if(!file_exists(BASE_PATH . 'include' . DS . 'data' . DS . 'lock.txt')) header('Location: install.php');
//引入核心文件
include(BASE_PATH . 'core' . DS . 'core.php');
//加载控制器核心类
Core::startUp(
	array(
		'defaultAction'=>'Index',
		'defaultMethod'=>'index',
		'autoloadFile'=>array(
            APP_PATH . 'BaseAction.class.php',
            APP_PATH . 'model' . DS . 'BaseModel.class.php'
		)
	)
);
?>