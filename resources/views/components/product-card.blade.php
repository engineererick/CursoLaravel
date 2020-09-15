
<div class="card">
    <a href="{{route('products.show', ['product' => $product->id])}}"><img class="card-img-top" src="{{ asset($product->images->first()->path) }}" height="500" alt=""></a>
    <div class="card-body">
        <h4 class="text-right"><strong style="color: red;">${{$product->price}}</strong></h4>
        <h4 class="card-title">{{$product->title}}</h4>
        <p class="cad-text">{{ $product->description }}</p>
        <p class="cad-text"><strong>{{ $product->stock }} left</strong></p>
        <form 
            class="d-inline" 
            method="POST" 
            action="{{ route('products.carts.store', ['product' => $product->id]) }}">
                @csrf
                <button type="submit" class="btn btn-success">Add to cart</button>
        </form>
    </div>
</div>