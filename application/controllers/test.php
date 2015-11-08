<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Test extends CI_Controller
{



	public function index()
	{
		$browser = new Buzz\Browser();
		$response = $browser->get('http://www.google.com');

		echo $browser->getLastRequest()."\n";
		echo $response;
	}
}