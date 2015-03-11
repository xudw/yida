<?php if(!defined('YIDA')) exit('you can\'t direct access');
/**
 *==============================================
 * 易达团队开发
 * author:sunchao <phper123@gmail.com>
 * version:0.1
 * date:2014-02-18
 *==============================================
 */
session_start();
//定义常量
if(!defined('DS')) define('DS',DIRECTORY_SEPARATOR);
//定义文件夹常量
if(!defined('LIBRARY_PATH')) define('LIBRARY_PATH', BASE_PATH . 'include' . DS);
if(!defined('PLUGIN_PATH')) define('PLUGIN_PATH', BASE_PATH . 'include' . DS . 'plugin' . DS);
if(!defined('CONFIG_PATH')) define('CONFIG_PATH', BASE_PATH . 'include' . DS . 'config' . DS);
if(!defined('LANGUAGE_PATH')) define('LANGUAGE_PATH', APP_PATH . 'language' . DS);
if(!defined('TEMPLATE_PATH')) define('TEMPLATE_PATH', APP_PATH . 'template' . DS);
if(!defined('TEMP_PATH')) define('TEMP_PATH', APP_PATH . 'temp' . DS);
if(!defined('MODEL_PATH')) define('MODEL_PATH', APP_PATH . 'model' . DS);
//定义扩展名
define('EXT', '.php');          //文件扩展名
define('CLASS_EXT', '.class');  //类扩展名
define('CONFIG_EXT', '.inc');   //配置扩展名
define('LIBRARY_EXT', '.lib');  //第三方类扩展名
define('FUNC_EXT', '.func');     //函数扩展名
define('PLUGIN_EXT', '.adt');    //插件扩展名
//定义文件类型后缀名
define('ACTION_POSTFIX', 'Action'); //Action后缀
define('MODEL_POSTFIX', 'Model');   //Model后缀
/**
 *核心类
 */
class Core {
	public static $loadClass=array();
	/**
	 *YIDA设置加载框架类
	 */
	public static function startUp($config=array()) {
		BaseCore::getInstance()
		->loadCoreClass()
        ->loadDefault($config)
		->doAction();
	}
	/**
	 *加载类
	 *@return Object
	 */
	public static function & loadClass($class) {
		$obj = ucfirst($class);
		$key = strtolower($class);
		if(!isset(Core::$loadClass[$key]) || !is_object(Core::$loadClass[$key]))
		{
			Core::$loadClass[$key] = new $obj(); 
		}
		return Core::$loadClass[$key];
	}
}
/**
 *加载框架类
 */
class BaseCore
{
	private static $bc;
	public $action = 'index';
	public $method = 'index';
	/**
	 *获取单一变量
	 *@return Object BaseCore
	 */
	public static function & getInstance() {
		if(!is_object(BaseCore::$bc)) {
			BaseCore::$bc = new BaseCore();
		}
		return BaseCore::$bc;
	}
	/**
	 *加载默认
	 *@return Object BaseCore
	 */
	public function & loadDefault($config) {
		if(is_array($config)) {
			if(isset($config['defaultAction'])) $this->action = $config['defaultAction'];
			if(isset($config['defaultMethod'])) $this->method = $config['defaultMethod'];
			if(isset($config['autoloadFile']) && is_array($config['autoloadFile'])) {
				foreach($config['autoloadFile'] as $value) {
                    $this->loadFile($value);
				}
			}
		}
		return $this;
	}
	/**
	 *加载核心类
	 *@return Object BaseCore
	 */
	public function & loadCoreClass() {
		//加载文件
		$this->loadFile(BASE_PATH . 'core' . DS . 'action' . EXT);
		$this->loadFile(BASE_PATH . 'core' . DS . 'model' . EXT);
		//加载注册类
		$fileArray = array('config','loader','template','language');
		foreach($fileArray as $file) {
			if($this->loadFile(BASE_PATH . 'core' . DS . $file . EXT)) {
				$property = strtolower($file);
				$this->$property = $this->loadClass(ucfirst($file));
			}
		}
		return $this;
	}
	/**
	 *加载请求
	 *@return Null
	 */
	public function doAction() {
		if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])) $this->action = ucfirst($_REQUEST['action']);
		if(isset($_REQUEST['method']) && !empty($_REQUEST['method'])) $this->method = $_REQUEST['method'];
        $className = $this->action . ACTION_POSTFIX;
        $methodName = $this->method;
		if($this->loadFile(APP_PATH . $className . CLASS_EXT . EXT)) {
			$action = new $className();
		} else {
			exit('No hava  access action');
		}
		if(method_exists($action,$this->method)) {
			$action->$methodName();
		}else{
			exit('No hava access method');
		}
	}
	/**
	 *加载文件
	 *@return Boolean
	 */
	public function loadFile($file) {
		if(file_exists($file)) {
			require_once($file);
			return true;
		}
		return false;
	}
	/**
	 *注册类库
	 *@return Object
	 */
	public function & loadClass($class) {
		return Core::loadClass($class);
	}
}
?>