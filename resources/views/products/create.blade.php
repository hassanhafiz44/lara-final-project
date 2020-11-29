@extends('layouts.app')

@section('content')
<div class="container">
	<form method="POST" id="add-product-form" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="form-group col-md-6">
				<label for="title">@lang('labels.title')</label>
				<input class="form-control" name="title" id="title" required />
			</div>
			<div class="form-group col-md-6">
				<label for="model">@lang('labels.model')</label>
				<input type="text" class="form-control" name="model" id="model" required />
			</div>
			<div class="form-group col-lg-4">
				<label for="price">@lang('labels.price')</label>
				<input type="number" class="form-control" name="price" id="price" required />
			</div>
			<div class="form-group col-lg-4">
				<label for="retail-price">@lang('labels.retail')</label>
				<input type="number" class="form-control" name="retail_price" id="retail-price" required />
			</div>
			<div class="form-group col-md-4">
				<label for="quantity">@lang('labels.quantity')</label>
				<input type="number" class="form-control" name="quantity" id="quantity" required />
			</div>
			<div class="form-group col-md-12">
				<label for="description">@lang('labels.description')</label>
				<textarea type="text" class="form-control" name="description" id="description" required></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="category_id">@lang('labels.category')</label>
				<select class="form-control" name="category_id" id="category_id" required>
					<option value="">@lang('labels.category')</option>
					@foreach($product_categories as $category)
					<option value="{{ $category->id }}">{{ $category->title }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="image_uri">@lang('labels.image')</label>
				<input class="form-control" type="file" name="image_uri" id="image_uri">
			</div>
		</div>
		<input class="btn btn-primary" type="submit" name="submit" id="submit" value="@lang('labels.submit')"/>
		<a href="#" id="add-category" data-toggle="modal" data-target="#add-category-modal" class="btn btn-secondary">@lang('labels.add_category')</a>
	</form>
	@include('includes/addCategoryModal')


	@endsection

	@section('scripts')
	<script src="{{ asset('js/products/products.js') }}"></script>
	@endsection