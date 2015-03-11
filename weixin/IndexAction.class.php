<?php


/**
 * 微信测试
 */
class IndexAction extends BaseAction {
	/**
	 * 判断微信
	 */
	public function index() {
        switch(strtoupper($_SERVERS['REQUEST_METHOD'])){
            case 'GET':
                $this->_requestGet();
                break;
            case 'POST':
                $this->_requestPost();
                break;
        }
	}
    /**
     * GET方式获取微信
     */
    private function _requestGet() {
        if(isset ( $_GET ["signature"] ) && isset ( $_GET ["timestamp"] ) && isset ( $_GET ["nonce"] ) && isset ( $_GET ["echostr"] )) {
            $echoStr = $_GET ["echostr"];
			if ($this->_checkSignature ()) {
				echo $echoStr;
			} else {
				echo '';
			}
            exit;
        }
    }
    /**
     * POST方式获取微信
     */
    private function _requstPost() {
        //get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if($postStr) {
            $postObj = simplexml_load_string($postStr,'SimpleXMLElement',LIBXML_NOCDATA);
            if(!is_object($postObj)){
                echo '';exit;
            }
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUsername;
            $msgType = strtolower ( $postObj->MsgType );
            switch($msgType){
                case '':
            }
        }
        echo '';
    }
    /**
     * 验证微信
     */
    private function _checkSignature() {
        $signature = $_GET ["signature"];
		$timestamp = $_GET ["timestamp"];
		$nonce = $_GET ["nonce"];
		
		$token = IndexConfig::$WX_CONFIG['token'];
		$tmpArr = array ($token, $timestamp, $nonce );
		sort ( $tmpArr, SORT_STRING );
		$tmpStr = implode ( $tmpArr );
		$tmpStr = sha1 ( $tmpStr );
		
		if ($tmpStr == $signature) {
			return true;
		} else {
			return false;
		}
    }
    
}
?>