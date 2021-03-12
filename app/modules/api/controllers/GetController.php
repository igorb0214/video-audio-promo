<?php

namespace app\modules\api\controllers;

use app\modules\api\models\ApiModel;
use core\Controller;

class GetController extends Controller
{

	protected function mp3(): void {

		$mp3Link = ApiModel::getMp3LinkById($this->request->id);
		$this->response->returnBodyResponse($mp3Link);
	}

	protected function test(): void {

		$data = ApiModel::test();

		$this->response->returnJsonResponse($data);
	}
}