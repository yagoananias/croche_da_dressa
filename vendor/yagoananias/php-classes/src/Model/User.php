<?php

namespace yagoananias\Model;

use \yagoananias\DB\Sql;
use \yagoananias\Model;

class User extends Model {

	const SESSION = "User";

	public static function login($login, $password) {

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
			":LOGIN"=>$login
		));

		if (count($results === 0) {

			throw new \Exception("Deu Ruim No Usuário ou na Senha :(");
			
		}

		$data = $results[0];

		if (password_verify($password, $data["despassword"]) === true) {

			$user = new User();

			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();

			return $user;
		}
		else {

			throw new \Exception("Deu Ruim No Usuário ou na Senha :(");

		}
	}

	public static function verifyLogin($inadmin = true) {

		if (
			!isset($S_SESSION[User::SESSION])
				||
				!$S_SESSION[User::SESSION]
				||
				!(int)$S_SESSION[User::SESSION]["iduser"] > 0
				||
				(bool)$S_SESSION[User::SESSION]["inadmin"] !== $inadmin
			) {

		}
	}

	public static function logout() {

		$S_SESSION[User::SESSION] = NULL;
	}
}

?>