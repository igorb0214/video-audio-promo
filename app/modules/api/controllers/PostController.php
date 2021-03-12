<?php

namespace app\modules\api\controllers;

use app\modules\api\models\ApiModel;
use core\Controller;

class PostController extends Controller
{

	protected function promotomp3(): void {

		$res = (new ApiModel())->promotomp3($this->request->get['category']);

		$this->response->returnJsonResponse($res);
	}
}