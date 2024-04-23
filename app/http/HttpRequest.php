<?php


namespace App\http;

class HttpRequest
{
	public function getUri() : string
	{
		return $_GET['url'];
	}

	public function requestMethod() : string
	{
		return $_SERVER["REQUEST_METHOD"];
	}
}