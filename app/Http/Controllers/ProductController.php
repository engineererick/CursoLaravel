<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller {
	public function __construct()
    {
        $this->middleware('auth'); //->only('index'); ['', ''] 
    }

	public function index() {
		return View('products.index')->with([
			'products' => Product::all(),
		]);
	}

	public function create() {
		return View('products.create');
	}

	public function store(ProductRequest $request) {
		$product = Product::create($request->validated());

		return redirect()
			->route('products.index')
			->withSuccess("The new product with Id {$product->id} was created");
	}

	public function show(Product $product) {
		return View('products.show')->with([
			'product' => $product,
			'html' => '<h2>Pasando código HTML</h2>',
		]);
	}

	public function edit(Product $product) {
		return View('products.edit')->with([
			'product' => $product,
		]);
	}

	public function update(ProductRequest $request, Product $product) {
		$product->update($request->validated());

		session()->flash('success', "The new product with Id {$product->id} was edited");

		return redirect()
			->route('products.index')
			->withSuccess("The product with Id {$product->id} was edited");
	}

	public function destroy(Product $product) {
		$product->delete();

		return redirect()->route('products.index')
			->withSuccess("The product with Id {$product->id} was deleted");
	}
}
