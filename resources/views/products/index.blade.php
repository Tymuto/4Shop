@extends('layouts.app')

@section('content')

	<div class="products">
		@foreach($categories as $category)
			<a href="{{ route('products.categories', $category->id) }}">{{$category->name}}</a>
		@endforeach
		@foreach($products as $product)
			<a class="product-row no-link" href="{{ route('products.show', $product) }}">
				<img src="{{ url($product->image ?? 'img/placeholder.jpg') }}" alt="{{ $product->title }}" class="rounded">
				<div class="product-body">
					<div>
						<h5 class="product-title"><span>{{ $product->title }}</span><em>&euro;{{ $product->price }}</em></h5>
						@unless(empty($product->description))
							<p>{{ $product->description }}</p>
						@endunless
						@if($product->discount > 0)
							<p class="discount">Nu <span>{{$product->discount}}%</span> korting! Originele prijs was <span>{{$product->getAttributes()['price']}}</span></p>
						@endif
					</div>
					<button class="btn btn-primary">Meer info &amp; bestellen</button>
				</div>
			</a>
		@endforeach
	</div>

@endsection