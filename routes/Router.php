<?php


namespace Routes;

use App\http\HttpRequest;
use App\Exception\RouteNotFoundException;

class Router
{
	/**
	 * Undocumented variable
	 *
	 * @var [type]
	 */
	protected $request;
	protected $routes = [];

	public function __construct(HttpRequest $request)
	{
		$this->request = $request;
	}

	/**
	 * Undocumented function
	 *
	 * @param string $path
	 * @param string|callable $action
	 * @return void
	 */
	public function get(string $path, string|callable $action)
	{
		return $this->addRoute($path, $action, 'GET');
	}

	/**
	 * Undocumented function
	 *
	 * @param string $path
	 * @param string|callable $action
	 * @return void
	 */
	public function post(string $path, string|callable $action)
	{
		return $this->addRoute($path, $action, 'POST');
	}

	/**
	 * Undocumented function
	 *
	 * @param string $path
	 * @param string|callable $action
	 * @param string $method
	 * @return void
	 */
	public function addRoute(string $path, string|callable $action, string $method )
	{
		$route = new Route($path, $action);
		$this->routes["$method"][] = $route;
		return $route;
	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function run()
	{
		if(!isset($this->routes[$this->request->requestMethod()])){
			throw new RouteNotFoundException("Request Method does not exist", 1);
		}

		foreach($this->routes[$this->request->requestMethod()] as $route){
			if($route->match($this->request->getUri())){
				$route->execute();
				die();
			}
		}

		throw new RouteNotFoundException("Route not found", 1);

	}

}