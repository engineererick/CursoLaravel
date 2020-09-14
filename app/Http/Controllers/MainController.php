<?php

namespace App\Http\Controllers;

use App\Product;

class MainController extends Controller {
	public function index() {
		// return View('welcome');
		return View('welcome')->with([
			'products' => Product::all(),
		]);
	}
}