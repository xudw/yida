<?php if(!defined('YIDA')) exit('you can\'t direct access');
/**
 *==============================================
 * 易达团队开发
 * author:sunchao <phper123@gmail.com>
 * version:0.1
 * date:2014-02-19
 *==============================================
 */

/**
 *配置类
 */
class Config {
    private $_config = array();
    private $_configFile = array();
    public function __construct() {
        $this->loadConfig('base');
    }
    /**
     *设置键值
     *@return null
     */
    public function set($key,$value='') {
        $this->_config[$key] = $value;
    }
	/**
	 *获取键值
	 *@return mixed
	 */
	public function get($key) {
        if(isset($this->_config[$key])) {
            return $this->_config[$key];
        } else {
            return false;
        }
	}
	/**
	 *加载文件
	 *@return Boolean
	 */
	public function loadConfig($file) {
        $realFile = CONFIG_PATH . $file . CONFIG_EXT . EXT;
        $md5File = md5($realFile);
		if(file_exists($realFile) && !isset($this->_configFile[$md5File])) {
            require_once($realFile);
            $this->_configFile[$md5File] = $realFile;
            $this->arrayMerge($config);
            return $config;
        }
        return false;
	}
    /**
     *合并数组
     *@return NULL
     */
    public function arrayMerge($config = array()) {
        $this->_config = array_merge($this->_config,$config);
    }
}
?>