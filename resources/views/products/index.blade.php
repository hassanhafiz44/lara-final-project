@extends('layouts.app') 

@section('content')
	<div>
		<div class="container">
			<a href="{{ route('products.create') }}" class="float-right btn btn-primary btn-sm">Add</a>
			<table id="products-table" class="table table-striped">
				<thead>
					<tr>
						<th>Title</th>
						<th>Model</th>
						<th>Price</th>
						<th>Quantity</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $product)
					<tr data-pid="{{ $product->id }}">
						<td>{{ ucwords($product->title) }}</td>
						<td>{{ $product->model }}</td>
						<td>{{ $product->price }}</td>
						<td>{{ $product->quantity }}</td>
						<td>
							<a class="btn btn-sm btn-secondary" href="{{ route('products.edit', $product->id) }}"><i class="fa fa-edit"></i></a>
							<a class="btn btn-sm btn-warning" href="{{ route('products.show', $product->id) }}"><i class="fa fa-eye"></i></a>
							<button class="btn btn-sm btn-danger delete-product"><i class="fa fa-trash"></i></button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<script>
		$(function () {
			$("#products-table").DataTable();
		});
	</script>
@endsection
