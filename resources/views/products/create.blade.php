@extends('layouts.app')

@section('content')
<div class="container">
	<form method="POST" id="add-product-form" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="form-group col-md-6">
				<label for="title">Title</label>
				<input class="form-control" name="title" id="title" required />
			</div>
			<div class="form-group col-md-6">
				<label for="model">Model</label>
				<input type="text" class="form-control" name="model" id="model" required />
			</div>
			<div class="form-group col-lg-6">
				<label for="price">Price</label>
				<input type="number" class="form-control" name="price" id="price" required />
			</div>
			<div class="form-group col-md-6">
				<label for="quantity">Quantity</label>
				<input type="number" class="form-control" name="quantity" id="quantity" required />
			</div>
			<div class="form-group col-md-12">
				<label for="description">Description</label>
				<textarea type="text" class="form-control" name="description" id="description" required></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="category_id">Category</label>
				<select class="form-control" name="category_id" id="category_id" required>
					<option value="">-- Category --</option>
					@foreach($product_categories as $category)
					<option value="{{ $category->id }}">{{ $category->title }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="image_uri">Product Image</label>
				<input class="form-control" type="file" name="image_uri" id="image_uri" required>
			</div>
		</div>
		<input class="btn btn-primary" type="submit" name="submit" id="submit" />
		<a href="#" id="add-category" data-toggle="modal" data-target="#add-category-modal" class="btn btn-secondary">Add Category</a>
	</form>
	@include('includes/addCategoryModal')


	@endsection

	@section('scripts')
	<script src="{{ asset('js/products/products.js') }}"></script>
	@endsection