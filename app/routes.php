<?php
$router->cli()->name("test/test")->action(function () use ($container) {
	$container["controller.test"] = function (Pimple\Container $c) {
		return new Controller\Test($c["view.test"]);
	};

	$container["view.test"] = function (Pimple\Container $c) {
		return new View\Test;
	};

	$container["controller.test"]->testMethod();
	$container["view.test"]->render();
});
