<?php if(!defined('YIDA')) exit('you can\'t direct access');
/**
 *==============================================
 * 
 * author:sunchao <phper123@gmail.com>
 * version:0.1
 * date:2014-03-03
 *==============================================
 */
 
/**
 * 模板类
 */
class Template {
    public $templateDir = '';
    public $complieDir = '';
    public $templateSuffix = '';
    public $relativeDir = '';
    public $template = array();
    public $_setError = 0;
    public $_var = array();
    public $_vars = array();
    public $_foreach = array();
    public $_errorLevel = 0;
    public $_currentFile = '';
    public $_tempKey = array();
    public $_tempVal = array();
    /**
     * 模板类初始化
     */
    public function __construct() {
        $this->_errorLevel = error_reporting();
        $this->defaultSet();
    }
    /**
     * 初始化方法
     * @access public
     * @return void
     */
    public function defaultSet() {
        $templateDir = isset($GLOBALS['template']) ? $GLOBALS['template'] : 'default';
        $this->templateDir = TEMPLATE_PATH . $templateDir;
        $this->complieDir = TEMP_PATH;
        $this->templateSuffix = '.tpl';
        $this->relativeDir = './' . APP_DIR . '/template/' . $templateDir;
    }
    /**
     * 注册变量方法
     * @access public
     * @return void
     */
    public function assign($key,$value='') {
        if(is_array($key)) {
            foreach($key as $k=>$val) {
                if($key != '') {
                    $this->_var[$k] = $val; 
                }
            }
        } else {
            if($key != '') {
                $this->_var[$key] = $value;
            }
        } 
    }
    /** 
     * 调用页面方法
     * @access public
     * @return void
     */
    public function display($filename='') {
        error_reporting(E_ALL ^ E_NOTICE);
        $this->_setError++;
        $out = $this->fetch($filename);
        error_reporting($this->_errorLevel);
        $this->_setError--;
        echo $out;
    }
    /**
     * 处理模板文件
     * @access public
     * @return string
     */
    public function fetch($filename='') {
        $this->_setError++;
        if(!$this->_setError) {
            error_reporting(E_ALL ^ E_NOTICE);
        }
        $filename = $this->templateDir . DS . $filename . $this->templateSuffix;
        if(!is_file($filename)) {
            exit('\'' . basename($filename) . '\' is not file');
        }
        if(!in_array($filename,$this->template)) {
            $this->template[] = $filename;
        }
        $out = $this->makeCompiled($filename);
        $this->_setError--;
        if(!$this->_setError) {
            error_reporting($this->_errorLevel);
        }
        return $out;
    }
    /**
     * 编译模板方法
     * @access public
     * @return string
     */
    public function makeCompiled($filename) {
        $baseFile = basename($filename) . EXT;
        $name = $this->complieDir . $baseFile;
        if(is_file($name)) {
            $filestat = @stat($name);
            $cmpExpires = $filestat['mtime'];
        } else {
            $cmpExpires = 0;
        }
        $filestat = @stat($filename);
        $tplExpires = $filestat['mtime'];
        if($tplExpires > $cmpExpires) {
            $this->_currentFile = $filename;
            $content = file_get_contents($filename);
            $source = $this->fetchStr($content);
            if(file_put_contents($name, $source, LOCK_EX) === false) {
                exit('can\'t write:' . $name);
            }
            $source = $this->evalStr($source);
        } else {
            ob_start();
            include $name;
            $source = ob_get_contents();
            ob_end_clean();
        } 
        return $source;
    }
    /**
     * 处理字符串方法
     * @access public
     * @param string $source
     * @return string
     */
    public function fetchStr($source) {
        return preg_replace("|{([^\{\}\n]*)}|e", "\$this->selectTag('\\1');",$source);
    }
    /**
     * 处理标签方法
     * @param string $tag
     * @return string
     */
    public function selectTag($tag) {
        $tag = stripslashes(trim($tag));
        if(empty($tag)) return '{}';
        if($tag{0} == '*' && substr($tag, -1) == '*') {
            return '';
        }
        if($tag{0} == '$') {
            if((strncmp($tag, '$lang.', 6) ===0 ))
            {
                return $this->getLang(substr($tag,6));
            } else {
                return '<?php echo ' . $this->getVal(substr($tag,1)) . '; ?>';
            }
        }
        if($tag[0] == '/') {
            switch(substr($tag , 1)) {
                case 'if' : 
                    return '<?php endif; ?>';
                    break;
                case 'foreach' :
                    $output = '<?php endforeach; endif; unset($_from); ?>';
                    return $output .= "<?php \$this->popVars(); ?>";
            }
        } else {
            $tagAll = explode(' ', $tag);
            $tagChoose = array_shift($tagAll);
            switch($tagChoose) {
                case 'if':
                    return $this->compileIfTag(substr($tag, 3));
                    break;
                case 'else':
                    return '<?php else: ?>';
                    break;
                case 'elseif':
                    return $this->compileIfTag(substr($tag, 7),true);
                    break;
                case 'foreach':
                    return $this->compileForeachStart(substr($tag, 8));
                    break;
                case 'include':
                    $t = $this->getParams(substr($tag, 8));
                    return '<?php echo $this->fetch(' . "'$t[file]'" . '); ?>';
                    break;
                case 'res':
                    $t = $this->getParams(substr($tag, 4));
                    return '<?php echo $this->relativeDir.\'/css/'. $t['file'] . '\'; ?>';
                    break;
                case 'lib':
                    $t = $this->getParams(substr($tag, 4));
                    return '<?php echo $this->relativeDir.\'/js/' . $t['file'] . '\'; ?>';
                    break;
                case 'image':
                    $t = $this->getParams(substr($tag, 6));
                    return '<?php echo $this->relativeDir.\'/images/' . $t['src'] . '\';?>';
                    break;
                case ':':
                    return $this->compilePlugin(substr($tag, 2));
                    break;
                default:
                    return '{' . $tag .'}';
                    break;
            }
        }
    }
    /**
     * 编译解析语言
     * @param string $lang
     * @return string
     */
    public function getLang($lang) {
        if(strpos($lang, '$') !== false) {
            return '<?php echo Action::getInstance()->lang['.$this->makeVar(substr($lang,1)).']; ?>';
        }
        return isset(Action::getInstance()->lang[$lang]) ? Action::getInstance()->lang[$lang] : substr($lang, 5);
    }
    /**
     * 处理变量标签
     * @params string $val
     * @return string
     */
    public function getVal($val) {
        if(strrpos($val, '[') !== false) {
            $val = preg_replace("|\[([^\[\]]*)\]|e","'.'.str_replace('$','\$','\\1')",$val);
        }
        if(strrpos($val, '|') !== false) {
            $func = explode('|' !== false);
            $val = array_shift($func);
        }
        if(empty($val)) {
            return '';
        } 
        if(strpos($val, '.$') !== false) {
            $all = explode('.$', $val); 
            foreach($all as $key=>$val) {
                $all[$key] = $this->makeVar($val);
            }
            $p = implode('.', $all);
        } else {
            $p = $this->makeVar($val);
        }
        return $p;
    }
    /**
     * 处理去掉$的字符串
     * @param string $val
     * @return string
     */
    public function makeVar($val) {
        if(strrpos($val, '.') === false) {
            $str = '$this->_var[\'' . $val . '\']';
        } else {
            $tmp = explode('.', $val);
            $varName = array_shift($tmp);
            $str = '$this->_var[\'' . $varName . '\']'; 
            foreach($tmp as $t) {
                $str .= '[\'' . $t . '\']';
            }
        }
        return $str;
    }
    /**
     * 处理if标签
     * @param string $tag
     * @return string
     */
    public function compileIfTag($tagArgs,$elseif=false) {
        preg_match_all('/\-?\d+[\.\d]+|\'[^\'|\s]*\'|"[^"|\s]*"|[\$\w\.]+|!==|===|==|!=|<>|<<|>>|<=|>=|&&|\|\||\(|\)|,|\!|\^|=|&|<|>|~|\||\%|\+|\-|\/|\*|\@|\S/', $tagArgs, $match);
        $tokens = $match[0];
        $tokensCount = array_count_values($tokens);
        if(empty($tokensCount['(']) or empty($tokensCount[')'])) {
            exit('syntax error');
        }
        if($tokensCount['('] != $tokensCount[')']) {
            exit('syntax error');
        }
        for($i = 0,$count = count($tokens);$i < $count;$i++) {
            $token = &$tokens[$i];
            switch(strtolower($token)) {
                case 'eq':
                    $token = '==';
                    break;
                case 'ne':
                    $token = '!=';
                    break;
                case 'lt':
                    $token = '<';
                    break;
                case 'lte':
                    $token = '<=';
                    break;
                case 'gt':
                    $token = '>';
                    break;
                case 'gte':
                    $token = '>=';
                    break;
                case 'and':
                    $token = '&&';
                    break;
                case 'or':
                    $token = '||';
                    break;
                case 'not':
                    $token = '!';
                    break;
                case 'mod':
                    $token = '%';
                    break;
                default:
                    if($token[0] == '$') {
                        $token = $this->getVal(substr($token, 1));
                    }
                    break;
            }   
        }
        if($elseif) {
            return '<?php elseif ' . implode(' ', $tokens) . ': ?>';
        } else {
            return '<?php if' . implode(' ', $tokens) . ': ?>';
        }
    }
    /**
     * 处理foreach标签
     * @param string $tag
     * @return string
     */
    public function compileForeachStart($tag) {
        $attrs = $this->getParams($tag);
        $argList = array();
        $from = $attrs['from'];
        $item = $this->getVal($attrs['item']);
        if(!empty($attrs['key'])) {
            $keyPart = $this->getVal($attrs['key']) . '=>';
        } else {
            $keyPart = '';
        }
        if(!empty($attrs['name'])) {
            $name = null;
        }
        $output = '<?php ';
        $output .= "\$_from = $from; if (!is_array(\$_from) && !is_object(\$_from)){settype(\$_from,'array'); } \$this->pushVars('$attrs[key]','$attrs[item]');";
        if(!empty($name)) {
            $foreachProps = "\$this->_foreach['$name']";
            $output .= "{$foreachProps} = array('total' => count(\$_from),'iteration' => 0);\n";
            $output .= "if ({$foreachProps}['total' > 0]):\n";
            $output .= "    foreach ($_from AS $keyPart$item):\n";
            $output .= "        {$foreachProps}['iteration']++;\n";
        } else {
            $output .= "if (count(\$_from)):\n";
            $output .= "    foreach (\$_from AS $keyPart$item):\n";
        }
        return $output . '?>';
    }
    /**
     * 处理plugin标签
     * @param string $tag
     * @return string
     */
    public function compilePlugin($tag) {
        if(empty($tag)) return '';
        if(strpos(trim($tag), '.') === false) {
            return '';
        } else {
            $output = '';
            $tagArrs = explode('.', $tag);
            if(isset($tagArrs[0])) {
                preg_match('|\.([^\(\)]+)|ie', $tag, $func);
                if(isset($func[1])) {
                    $output .= '<?php include_once(\''.PLUGIN_PATH . $tagArrs[0] . PLUGIN_EXT . EXT.'\'); echo ' . $func[1] . '(';
                    preg_match('|\(([^\(\)]+)\)|ie', $tag, $params);
                    if(isset($params[1])) {
                        $paramsArr = explode(',', $params[1]);
                        foreach($paramsArr as $key => $value) {
                            if($value{0} == '$') {
                                $output .= $this->getVal(substr($value, 1)) . ', ';
                            } else {
                                $value = str_replace(array(' ','\'','\"'), '', $value);
                                $output .= '\''.$value.'\', ';
                            }
                        }
                        $output = trim($output, ', ');
                    }
                    $output .= '); ?>';
                }
            }
        }
        return $output;
    }
    /**
     * 执行字符串
     * @param string $content
     * @return string
     */
    public function evalStr($content) {
        ob_start();
        eval('?' . '>' . trim($content));
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    /**
     * 获取参数
     * @param string $val
     * @return array
     */
    public function getParams($val) {
        $pa = $this->strTrim($val);
        foreach($pa AS $value) {
            if(strrpos($value, '=')) {
                list($a,$b) = explode('=',str_replace(array(' ', '"', '\'', '&quot'), '', $value));
                if($b{0} == '$') {
                    $para[$a] = $this->getVal(substr($b,1));
                } else {
                    $para[$a] = $b;
                }
            } 
        }
        return $para;
    }
    /**
     * 处理字符串
     * @param string $str
     * @return array
     */
    public function strTrim($str) {
        if(strpos($str, '= ') !== false) {
            $str = str_replace('= ','=',$str);
        }
        if(strpos($str, ' =') !== false) {
            $str = str_replace(' =','=',$str);
        }
        return explode(' ', trim($str));
    }
    /**
     * 将foreach的key,item放入临时数组
     * @param mixed $key
     * @param mixed $val
     * @return void
     */
    public function pushVars($key,$val)
    {
        if(!empty($key)) {
            array_push($this->_tempKey, "\$this->_vars['$key']='" . $key . "';");
        } 
        if(!empty($val)) {
            array_push($this->_tempVal, "\$this->_vars['$val']='" . $key . "';");
        }
    }
    /**
     * 弹出临时数组的最后一个
     * @return void
     */
    public function popVars() {
        $key = array_pop($this->_tempKey); 
        $val = array_pop($this->_tempVal);
    }
}
?>