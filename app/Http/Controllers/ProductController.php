<?php

namespace App\Http\Controllers;

use App\Product;

class ProductController extends Controller {
	public function index() {
		return View('products.index')->with([
			'products' => Product::all(),
		]);
	}

	public function create() {
		return View('products.create');
	}

	public function store() {
		$rules = [
			'title' => ['required', 'max:255'],
			'description' => ['required', 'max:1000'],
			'price' => ['required', 'min:1'],
			'stock' => ['required', 'min:0'],
			'status' => ['required', 'in:available,unavailable'],
		];

		request()->validate($rules);

		if (request()->status == 'available' && request()->stock == 0) {
			return redirect()
				->back()
				->withInput(request()->all())
				->withErrors('If available must have stock');
		}

		$product = Product::create(request()->all());

		return redirect()
			->route('products.index')
			->withSuccess("The new product with Id {$product->id} was created");
	}

	public function show($product) {
		$product = Product::findOrFail($product);

		return View('products.show')->with([
			'product' => $product,
			'html' => '<h2>Pasando código HTML</h2>',
		]);
	}

	public function edit($product) {
		return View('products.edit')->with([
			'product' => Product::findOrFail($product),
		]);
	}

	public function update($product) {
		$rules = [
			'title' => ['required', 'max:255'],
			'description' => ['required', 'max:1000'],
			'price' => ['required', 'min:1'],
			'stock' => ['required', 'min:0'],
			'status' => ['required', 'in:available,unavailable'],
		];

		request()->validate($rules);

		$product = Product::findOrFail($product);

		$product->update(request()->all());

		session()->flash('success', "The new product with Id {$product->id} was edited");

		return redirect()
			->route('products.index')
			->withSuccess("The product with Id {$product->id} was edited");
	}

	public function destroy($product) {
		$product = Product::findOrFail($product);

		$product->delete();

		return redirect()->route('products.index')
			->withSuccess("The product with Id {$product->id} was deleted");
	}
}
