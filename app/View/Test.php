<?php
namespace View;

class Test
{
	public $viewData = [];

	public function render()
	{
		// pretend we're loading a view, but in reality just var_dump the data
		var_dump($this->viewData);
	}
}
