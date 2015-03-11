<?php if(!defined('YIDA')) exit('you can\'t direct access');
/**
 *==============================================
 * 易达团队开发
 * author:sunchao <phper123@gmail.com>
 * version:0.1
 * date:2014-02-19
 *==============================================
 */
class Model {
    public function __construct() {
        //to do
    }
    public function __get($property) {
        return Action::getInstance()->$property;
    }
}
?>