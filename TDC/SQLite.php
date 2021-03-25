<?php
/**
 * @license CC0
 * @license https://creativecommons.org/publicdomain/zero/1.0/
 */
namespace TDC\PDO;

class SQLite extends \TDC\PDO\PDO {
	public function __construct($db, $user=null, $pass=null) {
		parent::__construct('sqlite:'.$db, $user, $pass);
		parent::exec("PRAGMA encoding = 'UTF-8'");
	}
}
