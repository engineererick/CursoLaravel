@extends('layouts.app')

@section('content')

	<h1>List of products</h1>

	<a href="{{route('products.create')}}" class="btn btn-success mb-3">Create</a>

	@empty($products)
		<div class="alert alert-warning">The list of products is empty</div>
	@else
		<div class="table-responsive">
			<table class="table table-striped">
				<thead class="thead-light">
					<tr>
						<th>Id</th>
						<th>Title</th>
						<th>Description</th>
						<th>Price</th>
						<th>Stock</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($products as $prod)
						<tr>
							<td>{{$prod->id}}</td>
							<td>{{$prod->title}}</td>
							<td>{{$prod->description}}</td>
							<td>{{$prod->price}}</td>
							<td>{{$prod->stock}}</td>
							<td>{{$prod->status}}</td>
							<td>
								<a href="{{route('products.show', ['product' => $prod->id])}}" class="btn btn-link">Show</a>
								<a href="{{route('products.edit', ['product' => $prod->id])}}" class="btn btn-link">Edit</a>
								<form method="POST" action="{{ route('products.destroy', ['product' => $prod->id]) }}">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-link">Delete</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@endempty
@endsection