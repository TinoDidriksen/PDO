<?php
/**
 * @license CC0
 * @license https://creativecommons.org/publicdomain/zero/1.0/
 */
namespace TDC\PDO;

class PgSQL extends \TDC\PDO\PDO {
	public function __construct($db, $user = null, $pass = null, $opts = []) {
		parent::__construct('pgsql:dbname='.$db, $user, $pass, $opts);
		parent::exec("SET CLIENT_ENCODING TO 'UTF8'");
	}
}
