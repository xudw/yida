<?php if(!defined('YIDA')) exit('you can\'t direct access');
/**
 *==============================================
 * 易达团队开发
 * author:sunchao <phper123@gmail.com>
 * version:0.1
 * data:2014-02-19
 *==============================================
 */
class Action {
	private static $action;
	/**
	 *初始化类函数
	 */
	public function __construct() {
		Action::$action = & $this;
		foreach(Core::$loadClass as $key=>$value) {
			$this->$key = $value;
		}
        $this->loader->language();
	}
	/**
	 *获取该类对象
	 *@return Action
	 */
	public static function & getInstance() {
		return Action::$action;
	}
}
?>