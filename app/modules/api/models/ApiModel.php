<?php

namespace app\modules\api\models;

use app\models\BaseModel;
use core\models\RestApi;

class ApiModel extends BaseModel
{

	private const SEARCH_URL = "https://promo.com/promoVideos/data/search-promo-family-collection";

	/**
	 * @param string $category
	 * @return array
	 */
	public function promotomp3(string $category): array {

		$url = $this->getLinkForPromotomp3($category);
		$res = RestApi::get($url);

		$videoId = $this->getFirstVideo($res['response'] ?? []);
		$mp3Link = self::getMp3LinkById($videoId);

		return ['id'=>$videoId, 'mp3'=>$mp3Link];
	}

	/**
	 * @param string $id
	 * @return string
	 */
	public static function getMp3LinkById(string $id): string {
		return $id ? "{$_SERVER['SERVER_NAME']}/api/mp3/{$id}.mp3" : "";
	}

	/**
	 * @param array $response
	 * @return string
	 */
	private function getFirstVideo(array $response): string {
		return $response['body']['videos'][0]['id'] ?? "";
	}

	/**
	 * @param string $category
	 * @return string
	 */
	private function getLinkForPromotomp3(string $category): string {

		$keyWords         = $this->getKeyWordsById($category);
		$preparedKeyWords = $this->prepareKeyWordsToUrl($keyWords);

		$url = self::SEARCH_URL . "?page=1&sort_order=most_popular&aspect_ratio=all&limit=20&discard_title=true";
		return $url . "&keyword={$preparedKeyWords}";
	}


}