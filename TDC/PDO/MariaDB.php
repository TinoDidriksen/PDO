<?php
/**
 * @license CC0
 * @license https://creativecommons.org/publicdomain/zero/1.0/
 */
namespace TDC\PDO;

class MariaDB extends \TDC\PDO\MySQL {
	public function __construct($db, $user=null, $pass=null) {
		parent::__construct($db, $user, $pass);
	}
}
