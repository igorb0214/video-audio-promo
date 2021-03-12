<?php

namespace core;

use core\models\MainFunc;

class Router
{
	/**
	 * @var string
	 */
    public string $controller = '';

	/**
	 * @var string
	 */
    public string $controllerClassName = '';
	/**
	 * @var string
	 */
    public string $action = '';
	/**
	 * @var string
	 */
    public string $id = '';
	/**
	 * @var Request
	 */
    public Request $request;
	/**
	 * @var Response
	 */
    public Response $response;

	/**
	 * @return $this
	 */
	public function route(): self
	{
		$this->setApplicationType();
		$this->setRequest();
		$this->setResponse();
		$this->setController();
		$this->setAction();

		return $this;
	}

	/**
	 *
	 */
	private function setController(): void {

		$parsedPath = explode('/', $_SERVER['PHP_SELF']);

		$this->controller = $parsedPath[1] ?? '';
		$this->controllerClassName = $this->getControllerClassName();

	}

	/**
	 * Converts controller's file name into an appropriate class name
	 */
	private function getControllerClassName(): string {

		$appInstance = Application::getInstance();
		$moduleNameSpace = str_replace('/', '\\', str_replace($appInstance->getAppRootPath(), '', $appInstance->getModulePath()));
		$nameSpace = $moduleNameSpace . '\\' . $this->convertToConventional($this->controller) . '\\controllers';
		return "{$nameSpace}\\" . ucwords(strtolower($this->request->requestMethod)) . "Controller";
	}

	/**
	 * @param string $str
	 * @return string
	 */
	private function convertToConventional(string $str): string {

		// Convert action name into a conventional method name
		$str = str_replace('-', ' ', $str);
		$str = ucwords($str);
		$str = lcfirst($str);
		return str_replace(' ', '', $str);
	}

	/**
	 *
	 */
	private function setAction(): void {

		$parsedPath    = explode('/', $_SERVER['PHP_SELF']);
		$rawActionName = $parsedPath[2] ?? '';
		$this->action  = $this->convertToConventional($rawActionName);

	}

	/**
	 *
	 */
	private function setRequest(): void {
		$this->request = Request::getInstance();
	}

	/**
	 *
	 */
	private function setResponse(): void {
		$this->response = Response::getInstance();
	}

	/**
	 *
	 */
	private function setApplicationType(): void {
		header("Content-type: application/json; charset=UTF-8");
	}

}