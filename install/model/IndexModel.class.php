<?php
/**
 *==============================================
 * 
 * author:sunchao <phper123@gmail.com>
 * version:0.1
 * date:2014-02-19
 *==============================================
 */
 
class IndexModel extends BaseModel {
    /**
     * 验证是否开启MySQL扩展
     */
    public function checkMySQL() {
        return extension_loaded('mysql') ? 'ok' : 'fail';
    }
    /**
     * 验证是否开启MySQLi扩展
     */
    public function checkMySQLi() {
        return extension_loaded('mysqli') ? 'ok' : 'fail';
    }
    /**
     * 验证是否开启GD2扩展
     */
    public function checkGD2() {
        return extension_loaded('gd') ? 'ok' : 'fail';
    }
    /**
     * 验证PHP版本
     */
    public function checkPHPVersion() {
        return version_compare(PHP_VERSION, '5.2.0') >= 0 ? 'ok' : 'fail';
    }
    /**
     * 验证是否有读写权限
     */
    public function checkTempRoot() {
        return (is_dir(TEMP_PATH) && is_writable(TEMP_PATH)) ? 'ok' : 'fail';
    }
    /**
     * 验证数据库配置
     */
    public function checkConfig($arr = array()) {
        $conn = @mysql_connect($arr['dbHost'].':'.$arr['dbPort'],$arr['dbUser'],$arr['dbPass']);
        return is_resource($conn) ? mysql_select_db($arr['dbName'], $conn) ? 'connectOk' : 'noDatabase' : 'connectError';
    }
    /**
     * 设置管理员
     */
    public function saveAdmin() {
        
    }
}
?>