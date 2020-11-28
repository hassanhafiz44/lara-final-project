@extends('layouts.app')

@section('content')
<div>
	<div class="container">
		<a href="{{ route('admin.products.create') }}" class="float-right btn btn-primary btn">@lang('labels.add_product')</a>
		<table id="products-table" class="table table-striped">
			<thead>
				<tr>
					<th>@lang('labels.serial_no_short')</th>
					<th>@lang('labels.image')</th>
					<th>@lang('labels.title')</th>
					<th>@lang('labels.category')</th>
					<th>@lang('labels.model')</th>
					<th>@lang('labels.price')</th>
					<th>@lang('labels.retail_price')</th>
					<th>@lang('labels.quantity')</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
                @if (count($products) === 0)
                    <tr>
                        <td colspan="8">@lang('messages.no_records_found')</td>
                    </tr>
                @endif
				@foreach($products as $key => $product)
				<tr data-pid="{{ $product->id }}">
					<td>{{ $key + 1}}</td>
                    <td><img width="100px" height="100px" src="{{ asset('storage/product_images/' . $product->image_url) }}"></td>
					<td>{{ ucwords($product->title) }}</td>
					<td>{{ ucwords($product->category->title) }}</td>
					<td>{{ $product->model }}</td>
					<td>{{ $product->retail_price }}</td>
					<td>{{ $product->price }}</td>
					<td>{{ $product->quantity }}</td>
					<td>
						<a class="btn btn-sm btn-secondary" href="{{ route('admin.products.edit', $product->id) }}"><i class="fa fa-edit"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$products->withQueryString()->links()}}
	</div>
</div>


@endsection

@section('scripts')
<script>
	@if(session('message'))
	showNotification("{{ session('message') }}", 'Success', 'success');
	@endif
</script>
@endsection