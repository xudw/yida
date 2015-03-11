<?php if(!defined('YIDA')) exit('you can\'t direct access');
/**
 *==============================================
 * 加载类
 * author:sunchao <phper123@gmail.com>
 * version:0.1
 * date:2014-02-19
 *==============================================
 */
 
/**
 *加载类
 */
class Loader
{
	private $_loadLibraryClass = array();   //加载类库
    private $_loadLibraryFiles = array();   //加载类库文件
    private $_loadFuncFiles = array();      //加载函数文件
    private $_loadModelClass = array();     //加载模型类
    private $_loadModelFiles = array();     //加载模型文件
    private $_loadDBClass = NULL;           //加载DB类
    private $_loadLanguageFiles = array();  //加载语言文件
    private $_loadPluginFiles = array();    //加载插件文件
	/**
	 *初始化函数
	 */
	public function __construct() {
		
	}
	/**
	 *加载类库方法
	 *@return Object $class
	 */
	public function & library($library, $params = array()) {
        $filePath = LIBRARY_PATH . ucfirst($library) . LIBRARY_EXT . EXT;
		if(!in_array($filePath, $this->_loadLibraryFiles)) {
            if(file_exists($filePath)) {
                include_once($filePath);
                $this->_loadLibraryFiles[] = $filePath;
            } else {
                return false;
            }
        }
        if(!class_exists(ucfirst($library))) {
            return false;
        }
        if(isset($this->getBaseAction()->$library)) {
            return $this->getBaseAction->$library;
        }
        if(!isset($this->_loadLibraryClass[$library])) {
            $className = ucfirst($library);
            if(is_null($params)) {
                $this->_loadLibraryClass[$library] = new $className();  
            } else {
                $this->_loadLibraryClass[$library] = new $className($params);  
            }
        }
        $this->getBaseAction()->$library = $this->_loadLibraryClass[$library];
        return $this->_loadLibraryClass[$library]; 
	}
    /**
     * 加载函数方法
     * @return Boolean
     */
    public function func($func) {
        $filePath = APP_PATH . 'common' . DS . $func . FUNC_EXT . EXT;
        if(!in_array($filePath, $this->_loadFuncFiles)) {
            if(file_exists($filePath)) {
                include_once($filePath);
                $this->_loadFuncFiles[] = $filePath;
            } else {
                return false;
            }
        }
        return true;
    }
    /**
     * 加载模型方法
     * @return Object
     */
    public function & model($model = '') {
        $modelName = ucfirst($model) . MODEL_POSTFIX;
        $filePath = MODEL_PATH . $modelName . CLASS_EXT . EXT;
        if(!in_array($filePath, $this->_loadModelFiles)) {
            if(file_exists($filePath)) {
                include_once($filePath);
                $this->_loadModelFiles[] = $filePath;
            } else {
                exit($modelName.EXT.' is not file');
            }
        }
        if(!class_exists($modelName)) {
            exit($modelName.EXT.' is not class');
        }
        if(isset($this->getBaseAction()->$model)) {
            return $this->getBaseAction->$model;
        }
        if(!isset($this->_loadModelClass[$model])) {
            $this->_loadModelClass[$model] = new $modelName();
        }
        $this->getBaseAction()->$model = $this->_loadModelClass[$model];
        return $this->_loadModelClass[$model]; 
    }
    /**
     *加载DB方法
     *@return Object
     */
    public function & database() {
        if(is_null($this->_loadDBClass)) {
            include_once(BASE_PATH . 'core' . DS . 'database' . EXT);
            $this->_loadDBClass = new Database();
        }
        $this->getBaseAction()->db = $this->_loadDBClass;
        return $this->_loadDBClass;
    }
    /**
     *加载语言方法
     */
    public function language($languageFile=false) {
        $action = BaseCore::getInstance()->action;
        $commonFile = LANGUAGE_PATH . 'Common' . EXT;
        if(!in_array($commonFile , $this->_loadLanguageFiles)) {
            $language = include_once($commonFile);
            $this->getBaseAction()->lang = isset($this->getBaseAction()->lang) ? array_merge($this->getBaseAction()->lang,$language) : $language;
            $this->_loadLanguageFiles[] = $commonFile;
        }
        $actionFile = LANGUAGE_PATH . $action . EXT;
        if(file_exists($actionFile) && !in_array($actionFile , $this->_loadLanguageFiles)) {
            $language = include_once($actionFile);
            $this->getBaseAction()->lang = isset($this->getBaseAction()->lang) ? array_merge($this->getBaseAction()->lang,$language) : $language;
            $this->_loadLanguageFiles[] = $actionFile;
        }
        if($languageFile && !in_array(LANGUAGE_PATH . ucfirst($languageFile) . EXT , $this->_loadLanguageFiles)) {
            $language = include_once(LANGUAGE_PATH . ucfirst($languageFile) . EXT);
            $this->getBaseAction()->lang = isset($this->getBaseAction()->lang) ? array_merge($this->getBaseAction()->lang,$language) : $language;
            $this->_loadLanguageFiles[] = LANGUAGE_PATH . ucfirst($languageFile) . EXT;
        }
        return true;
    }
    /**
     *加载插件方法
     */
    public function plugin($plugin=false) {
        if(empty($plugin)) return '';
        $pluginFile = PLUGIN_PATH . $plugin . PLUGIN_EXT . EXT;
        if(!in_array($pluginFile,$this->_loadPluginFiles) && is_file($pluginFile)) {
            include_once($pluginFile);
            $this->_loadPluginFiles[] = $pluginFile;
        }
        return true;
    }
    /**
     *获取Action基类
     *@return Object
     */
    public function getBaseAction() {
        return Action::getInstance();
    }
}
?>