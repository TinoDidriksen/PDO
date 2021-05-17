<?php
/**
 * @license CC0
 * @license https://creativecommons.org/publicdomain/zero/1.0/
 */
namespace TDC\PDO;

class SQLite extends \TDC\PDO\PDO {
	public function __construct($db, $opts=[]) {
		parent::__construct('sqlite:'.$db, null, null, $opts);
		parent::exec("PRAGMA encoding = 'UTF-8'");
	}
}
