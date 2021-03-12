<?php 

namespace core;

abstract class Controller
{
	/**
	 * @var Request
	 */
	protected Request $request;
	/**
	 * @var Response
	 */
	protected Response $response;
	/**
	 * @var string
	 */
	private string $controllerName;
	/**
	 * @var string
	 */
	private string $actionName;


	/**
	 * Controller constructor.
	 */
	public function __construct() {}
	protected function beforeAction() {}
	protected function afterAction() {}

	/**
	 *
	 */
	public function run(): void {
		$this->beforeAction();
		$this->{$this->actionName}();
		$this->afterAction();
	}


	/**
	 * @param string $controllerName
	 */
	public function setControllerName(string $controllerName): void {
		$this->controllerName = $controllerName;
	}

	/**
	 * @param Request $request
	 */
	public function setRequest(Request $request): void {
		$this->request = $request;
	}

	/**
	 * @param Response $response
	 */
	public function setResponse(Response $response): void {
		$this->response = $response;
	}

	/**
	 * @param string $actionName
	 */
	public function setActionName(string $actionName): void {
		$this->actionName = $actionName;
	}

}
