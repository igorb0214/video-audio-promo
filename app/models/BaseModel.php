<?php

namespace app\models;

abstract class BaseModel
{

	/**
	 * @return array
	 */
	protected function getAllKeyWords(): array {

		$string = file_get_contents("app/data/key_words.json");

		return json_decode($string, true) ?? [];

	}

	/**
	 * @param array $keyWords
	 * @return string
	 */
	protected function prepareKeyWordsToUrl(array $keyWords): string {

		foreach ($keyWords as $key=>$words) {
			$keyWords[$key] = str_replace(" ", "+", $words);
		}

		return implode(",", $keyWords);

	}

	/**
	 * @param string $id
	 * @return array
	 */
	protected function getKeyWordsById(string $id): array {
		return $this->getAllKeyWords()[$id] ?? [];
	}

}