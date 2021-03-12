<?php

namespace core;


use core\traits\Singleton;

/**
 * Class Response
 * @package core
 */
class Response
{

	use Singleton;


	/**
	 * @param array $data
	 */
	public function returnJsonResponse(array $data): void {

		echo json_encode($data, JSON_UNESCAPED_SLASHES);
	}

	/**
	 * @param string $str
	 */
	public function returnBodyResponse(string $str): void {

		echo json_encode($str, JSON_UNESCAPED_SLASHES);
	}


}