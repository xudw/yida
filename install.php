<?php if(!defined('YIDA')) define('YIDA',true);
/**
 *==============================================
 * 易达团队开发
 * author:sunchao <phper123@gmail.com>
 * version:0.1
 * date:2014-02-22
 *==============================================
 */
//定义常量,单一入口文件 
define('DS', DIRECTORY_SEPARATOR);
define('APP_DIR', 'install');
define('BASE_PATH', dirname(__FILE__).DS);
define('APP_PATH', BASE_PATH . APP_DIR . DS);
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