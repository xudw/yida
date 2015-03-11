<?php
/**
 *==============================================
 * 加载类
 * author:sunchao <phper123@gmail.com>
 * version:0.1
 * date:2014-02-19
 *==============================================
 */
class Access{
    /**
     * 页面从定向
     */
    public function Redirect($url='',$method='location',$http_response_code=302) {
        switch($method) {
            case 'refresh' : 
                header('Refresh:0;url='.$url);
                break;
            case 'location' :
                header('Location:'.$url,TRUE,$http_respnse_code);
                break;
            default:
                return false;
        }
        exit;
    }
} 
?>