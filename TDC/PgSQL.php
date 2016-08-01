<?php
/**
 * @license CC0
 * @license https://creativecommons.org/publicdomain/zero/1.0/
 */
namespace TDC\PDO;

class PgSQL extends \TDC\PDO {
	public function __construct($db, $user=null, $pass=null) {
		parent::__construct('pgsql:dbname='.$db, $user, $pass);
        parent::exec("SET CLIENT_ENCODING TO 'UTF8'");
	}
}
