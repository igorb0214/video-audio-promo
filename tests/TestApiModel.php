<?php

namespace tests;


use app\modules\api\models\ApiModel;
use PHPUnit\Framework\TestCase;

class TestApiModel extends TestCase
{
	public function testPromotomp3Keys() {
		$model = new ApiModel();
		$res = $model->promotomp3("facebook-ads");
		$this->assertArrayHasKey("id", $res);
		$this->assertArrayHasKey("mp3", $res);
	}

	public function testPromotomp3Content() {
		$model = new ApiModel();
		$res = $model->promotomp3("facebook-ads");
		$this->assertStringContainsString($res['id'], $res['mp3']);

	}

	public function testGetMp3LinkById() {

		$testString = "testString";
		$mp3Link = ApiModel::getMp3LinkById($testString);
		$this->assertStringContainsString("{$testString}.mp3", $mp3Link);

		$testString = "";
		$mp3Link = ApiModel::getMp3LinkById($testString);
		$this->assertEquals($testString, $mp3Link);

	}


}