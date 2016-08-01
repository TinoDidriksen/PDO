<?php
/**
 * @license CC0
 * @license https://creativecommons.org/publicdomain/zero/1.0/
 */
namespace TDC\PDO;

class PDO extends \PDO {
	protected $_trd = 0;

	public function __construct($dsn, $user, $pass, $opts = []) {
		$opt = [PDO::ATTR_EMULATE_PREPARES => false];
		foreach ($opts as $k => $v) {
			$opt[$k] = $v;
		}
		parent::__construct($dsn, $user, $pass, $opt);
		parent::setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		parent::setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
