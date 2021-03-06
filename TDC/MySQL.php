<?php
/**
 * @license CC0
 * @license https://creativecommons.org/publicdomain/zero/1.0/
 */
namespace TDC\PDO;

class MySQL extends \TDC\PDO\PDO {
	public function __construct($db, $user = null, $pass = null, $opts = []) {
		$opt = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"];
		foreach ($opts as $k => $v) {
			$opt[$k] = $v;
		}
		parent::__construct('mysql:dbname='.$db.';charset=utf8mb4', $user, $pass, $opt);
		parent::exec("SET sql_mode='TRADITIONAL,PIPES_AS_CONCAT,ANSI_QUOTES'");
	}
}
