<?php

namespace core;

use core\models\MainFunc;
use core\traits\Singleton;

class Application
{

	use Singleton;

	/**
	 * @var Router
	 */
	private Router $appRouter;
	/**
	 * @var string
	 */
	private string $appRootPath = '';
	/**
	 * @var string
	 */
	private string $modulePath = '';

	/**
	 *
	 */
	public function run(): void {

		// App path must be declared in application's configurations level
		if ($this->modulePath == '' || $this->appRootPath == '') {
			die('Application::run() : Error! Application paths hasn\'t been initialized. Be sure you\'ve initialized it within app\'s configuration file.');
		}

		$this->dispatch();

	}

	public function dispatch(): void {

		$controllerName      = $this->appRouter->controller;
		$actionName          = $this->appRouter->action;
		$controllerClassName = $this->appRouter->controllerClassName;
		$controller          = new $controllerClassName();

		// Check if the requested action is defined for the controller
		if (!method_exists($controller, $actionName)) {
			die('Error! Method ' . $actionName. ' is not defined for a controller ' . $controllerName);
		}

		$controller->setControllerName($controllerClassName);
		$controller->setActionName($actionName);
		$controller->setRequest($this->appRouter->request);
		$controller->setResponse($this->appRouter->response);

		$controller->run();

	}

	/**
	 * @param string $path
	 */
	public function setAppRootPath(string $path): void {
		$this->appRootPath = $path;
	}

	/**
	 * @param Router $appRouter
	 */
	public function setRouter(Router $appRouter): void {
		$this->appRouter = $appRouter;
	}

	/**
	 * @param string $modulePath
	 */
	public function setModulePath($modulePath = ''): void {
		$this->modulePath = $modulePath;
	}

	/**
	 * @return Router|null
	 */
    public function getAppRouter(): ?Router{
        return $this->appRouter;
    }

	/**
	 * @return string
	 */
	public function getAppRootPath(): string {
		return $this->appRootPath;
	}

	/**
	 * @return string
	 */
	public function getModulePath(): string {
		return $this->modulePath;
	}

}