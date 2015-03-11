<?php
/**
 *==============================================
 * 加载类
 * author:sunchao <phper123@gmail.com>
 * version:0.1
 * date:2014-02-19
 *==============================================
 */
 
/**
 * 获取用户图径
 * 返回当前应用路径
 * @return string
 */
function getURL() {
	return 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
}
/**
 * 跳转页面
 * 
 */
function redirect($url) {
    if(empty($url)) return $url;
    header("location:$url");
}
 

?>