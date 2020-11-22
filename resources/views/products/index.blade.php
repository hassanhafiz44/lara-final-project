@extends('layouts.app')

@section('content')
<div>
	<div class="container">
		<a href="{{ route('admin.products.create') }}" class="float-right btn btn-primary btn">Add Product</a>
		<table id="products-table" class="table table-striped">
			<thead>
				<tr>
					<th>SL</th>
					<th>Image</th>
					<th>Title</th>
					<th>Model</th>
					<th>Price</th>
					<th>Retail Price</th>
					<th>Quantity</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $key => $product)
				<tr data-pid="{{ $product->id }}">
					<td>{{ $key + 1}}</td>
                    <td><img width="100px" height="100px" src="{{ asset('storage/product_images/' . $product->image_url) }}"></td>
					<td>{{ ucwords($product->title) }}</td>
					<td>{{ $product->model }}</td>
					<td>{{ $product->retail_price }}</td>
					<td>{{ $product->price }}</td>
					<td>{{ $product->quantity }}</td>
					<td>
						<a class="btn btn-sm btn-secondary" href="{{ route('admin.products.edit', $product->id) }}"><i class="fa fa-edit"></i></a>
						<a class="btn btn-sm btn-warning" href="{{ route('admin.products.show', $product->id) }}"><i class="fa fa-eye"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$products->withQueryString()->links()}}
	</div>
</div>


@endsection