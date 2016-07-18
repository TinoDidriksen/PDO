<?php
/**
 * @license CC0
 * @license https://creativecommons.org/publicdomain/zero/1.0/
 */
namespace TDC;

class PDO extends \PDO {
	protected $_trd = 0;

	public function __construct($db, $user, $pass) {
		parent::__construct('mysql:dbname='.$db.';charset=utf8mb4', $user, $pass, array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
			PDO::ATTR_EMULATE_PREPARES => false,
			));
		parent::setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		parent::setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		parent::exec("SET sql_mode='TRADITIONAL,PIPES_AS_CONCAT,ANSI_QUOTES'");
	}

    public function prepexec($query, $args = []) {
    	$stm = parent::prepare($query);
    	if (empty($stm) || $stm->execute($args) === false) {
    		return null;
    	}
    	return $stm;
    }

	public function beginTransaction() {
		++$this->_trd;
    	if ($this->_trd > 1) {
    		return parent::exec("SAVEPOINT savepoint_{$this->_trd}");
    	}
        return parent::beginTransaction();
	}

    public function commit() {
    	if ($this->_trd === 1) {
    		parent::commit();
    	}
        --$this->_trd;
    }

    public function rollback() {
    	if ($this->_trd > 1) {
    		parent::exec("ROLLBACK TO SAVEPOINT savepoint_{$this->_trd}");
    	}
    	else {
    		parent::rollBack();
    	}
        --$this->_trd;
    }
}
