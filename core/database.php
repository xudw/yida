<?php if(!defined('YIDA')) exit('you can\'t direct access');
/**
 *==============================================
 * 易达开发团队
 * author:sunchao <phper123@gmail.com>
 * version:0.1
 * date:2014-02-19
 *==============================================
 */

/**
 *数据库类
 */ 
class Database {
    private $_mysqli = NULL;
    private $_methods = array('table','order','group','having','where','limit');
    private $_options = array();
    public function __construct() {
        $config = Action::getInstance()->config->loadConfig('database');
        if(!isset($config['db'])) exit('Error,Don\'t have database connect config file');
        $this->connect($config['db']);
    }
    /**
     * 连接数据库
     */
    public function connect($config) {
        if(is_null($this->_mysqli)) {
            $this->_mysqli = new mysqli($config['hosename'],$config['username'],$config['password'],$config['database'],$config['hostport']);
			if(mysqli_connect_errno()) exit(mysqli_connect_error());
			$this->_mysqli->query('SET NAMES \'' . $config['db_charset'] . '\'');
			if($this->_mysqli->server_version > '5.0.1') $this->_mysqli->query('SET sql_mode=\'\'');
		}
		return $this->_mysqli;
    }
    /**
     * 指定查询字段
     * @params mixed
     * @return Object
     **/
    public function & field($field=true) {
        if(true === $field) {
            $fields = $this->getDBFileds();
            $field =  $fields ? implode(',',$fields):'*';
        }
        $this->_options['field'] = $field;
        return $this;
    } 
    /**
     * 获取数据表字段信息
     * @return mixed
     */
    public function getDBFileds() {
        if(isset($this->_options['table'])) {
            if(strpos($this->_options['table'],',') !== false) {
                $tables = explode(',', $this->_options['table']);
            }else{
                $tables[] = $this->_options['table'];
            }
            $fields = array();
            foreach($tables as $table) {
                $array = explode(' ',$table);
                $field = $this->_getFields($array);
                $fields = array_merge($fields,$field);
            }
            return $fields?array_keys($fields):false; 
        }
        return false;
    }
    /**
     * 执行查询,返回数据集
     * @access public
     * @param string $sql 
     * @return mixed
     */
    public function query($sql) {
        $this->_options = array();
        $this->query = $this->_mysqli->query($sql);
        if(false === $this->query) {
            $this->error();
            return false;
        } else {
            $this->numRows = $this->_mysqli->affected_rows;
            return $this->_getAll();
        }
    }
    /**
     * 执行语句
     * @access public
     * @param string $sql
     * @return mixed
     */
    public function execute($sql) {
        $this->_options = array();
        $execute = $this->_mysqli->query($sql);
        if(false === $execute) {
            $this->error();
            return false;
        } else {
            $this->insertId = $this->_mysqli->insert_id;
            return $this->numRows = $this->_mysqli->affected_rows;
        }
        
    }
    /**
     * 获取最后执行ID
     * @access public
     * return number
     */
    public function getInsertId() {
        return $this->insertId;
    }
    /**
     * 获取影响条数
     * @access public
     * @return number
     */
    public function getNumRows() {
        return $this->numRows;
    }
    /**
     * 执行查找结果集
     * @return array
     */
    public function select() {
        $sql  = isset($this->_options['field']) ? 'SELECT ' . $this->_options['field'] . ' ' : 'SELECT * ';
        $sql .= isset($this->_options['table']) ? 'FROM ' . $this->_options['table'] . ' ' : '';
        $sql .= isset($this->_options['where']) ? 'WHERE ' . $this->_options['where'] . ' ' : '';  
        $sql .= isset($this->_options['group']) ? 'GROUP BY ' . $this->_options['group'] . ' ' : '';
        $sql .= isset($this->_options['having']) ? 'HAVING ' . $this->_options['having'] . ' ' : '';  
        $sql .= isset($this->_options['limit']) ? 'LIMIT ' . $this->_options['limit'] . ' ' : '';
        return $this->query($sql);
    }
    /**
     * 执行查找单条记录
     * @return array
     */
    public function find() {
        $this->_options['limit'] = 1;
        return $this->select();
    }
    /**
     * 执行插入记当
     * @return boolean
     */
    public function insert($property=array()) {
        $sql = isset($this->_options['table']) ? 'INSERT INTO ' . $this->_options['table'] . ' ' : '';
        $sql .= isset($this->_options['field']) ? '(' . $this->_options['field'] . ')values(' : 'values(';
        $sql .=  implode(',', $property) . ')';
        return $this->execute($sql);
    }
    /**
     * 执行修改记录
     * @return boolean
     */
    public function update($property=array()) {
        $sql = isset($this->_options['table']) ? 'UPDATE `' . $this->_options['table'] . '` SET ' : '' ;
        foreach($property as $key => $value) {
            $sql .= '`' . $key . '`=' . '\'' . $value . '\',';
        }
        $sql = trim($sql , ',').' ';
        $sql .= isset($this->_options['where']) ? 'WHERE ' . $this->_options['where'] . ' ' : '';
        $sql .= isset($this->_options['limit']) ? 'LIMIT ' . $this->_options['limit'] . ' ' : '';
        return $this->execute($sql);
    }
    /**
     * 执行删除记录
     * @return boolean
     */
    public function delete() {
        $sql = isset($this->_options['table']) ? 'DELETE FROM `' . $this->_options['table'] . '` ' : '';
        $sql .= isset($this->_options['where']) ? 'WHERE ' . $this->_options['where'] . ' ' : '';
        $sql .= isset($this->_options['limit']) ? 'LIMIT ' . $this->_options['limit'] . ' ' : '';
        return $this->execute($sql);
    }
    /**
     * 显示错误信息
     */
    public function error() {
        echo $this->_mysqli->errno.':'.$this->_mysqli->error;exit;
    }
    /**
     * 获取所有查询记录
     * @access private
     * @return array
     */
    private function _getAll() {
        $result = array(); 
        if($this->query->num_rows > 0) {
            for($i=0;$i<$this->query->num_rows;$i++) {
                $result[$i] = $this->query->fetch_assoc();
            }
        }
        return $result;
    }
    /**
     * 获取数据表的信息
     * @access public 
     * @
     */
    private function _getFields($tableInfo) {
        $tableName = $tableInfo[0];
        $tableAlias = false;
        if(isset($tableInfo[1])) {
            $tableAlias = $tableInfo[1];
        }
        $sql = 'SHOW COLUMNS FROM `'.$tableName.'`';
        $result = $this->query($sql);
        $info = array();
        if($result) {
            $keyName = $tableAlias?$tableAlias:$tableName;
            foreach($result as $key => $value) {
                $info[$keyName . '.' . $value['Field']] = $value;
            }
        }
        return $info;
    }
	/**
	 * 连惯操作的实现
     * @return mixed
	 */
	public function __call($func,$argument) {
        $method = strtolower($func);
		if(in_array($method,$this->_methods)) {
            if('limit' == $method) {
                $this->_options[$method] = isset($argument[1]) ? $argument[0] . ',' . $argument[1] : $argument[0];
            } else {
                $this->_options[$method] = $argument[0];
            }
            return $this;
        }
	}
    /**
	 * 销毁数据库连接
	 */
	public function __destruct() {
		$this->_mysqli->close();
	}
}
?>