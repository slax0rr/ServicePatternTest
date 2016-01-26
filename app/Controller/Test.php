<?php
namespace Controller;

class Test
{
	protected $_view = null;

	public function __construct(\View\Test $view)
	{
		$this->_view = $view;
	}

	public function testMethod()
	{
		// do stuff
		$this->_view->viewData["foo"] = "bar";
	}
}
