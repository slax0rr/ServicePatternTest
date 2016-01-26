<?php
require_once "../vendor/autoload.php";

$container = new Pimple\Container;

$container["service.request"] = $container->factory(function (Pimple\Container $c) {
		$request = new SlaxWeb\Router\Request;
		if ($c["router.protocol"] === "cli") {
			$request->setUpCLI($c["router.uri"]);
		}

		return $request;
	}
);

$container["service.router"] = $container->factory(function (Pimple\Container $c) {
	$request = $c["service.request"];
	$router = new SlaxWeb\Router\Router($request);
	SlaxWeb\Router\Helper::init($router, $request);

	return $router;
});

$options = getopt("u:", ["uri:"]);
if (isset($options["u"])) {
	$options["uri"] = $options["u"];
}

$container["router.protocol"] = "cli";
$container["router.uri"] = $options["uri"];

$router = $container["service.router"];
require_once "../app/routes.php";

$action = $router->process();
$container["app.action"] = $action["action"];
$container["app.params"] = $action["params"];

$container["app.action"];
