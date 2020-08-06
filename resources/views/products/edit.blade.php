@extends('layouts.app')

@section('content')
	<div class="container">
		<form method="POST" id="add-product-form" action="{{ route('products.update', $product->id) }}" >
			@csrf
			<div class="row">
				<div class="form-group col-md-6">
					<label for="title">Title</label>
					<input class="form-control" name="title" id="title" value="{{ $product->title }}" required/>
				</div>
				<div class="form-group col-md-6">
					<label for="model">Model</label>
					<input type="text" class="form-control" name="model" id="model" value="{{ $product->model }}" required/>
				</div>
				<div class="form-group col-lg-6">
					<label for="price">Price</label>
					<input type="number" class="form-control" name="price" id="price" value="{{ $product->price }}" required/>
				</div>
				<div class="form-group col-md-6">
					<label for="quantity">Quantity</label>
					<input type="number" class="form-control" name="quantity" id="quantity" value="{{ $product->quantity}}" required/>
				</div>
				<div class="form-group col-md-12">
					<label for="description">Description</label>
					<textarea type="text" class="form-control" name="description" id="description" required>{{ $product->description }}</textarea>
				</div>
				<div class="form-group col-md-6">
					<label for="category_id">Category</label>
					<select class="form-control" name="category_id" id="category_id" required>
						<option value="">-- Category --</option>
						@foreach($product_categories as $category)
							<option {{ ($category->id === $product->category->id) ? "selected" : "" }} value="{{ $category->id }}">{{ $category->title }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="image_uri">Product Image</label>
					<input class="form-control" type="file" name="image_uri" id="image_uri">
				</div>
			</div>
			<input class="btn btn-primary" type="submit" name="submit" id="submit" />
			<a href="#" id="add-category" data-toggle="modal" data-target="#add-category-modal" class="btn btn-secondary">Add Category</a>
			<input type="hidden" name="_method" value="PUT">
		</form>
	</div>

	<script>
		// Todo
		$(function() {
			$("#add-category-form").on('submit',function(event) {
				event.preventDefault();

				const form=document.querySelector('#add-category-form');
				const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
				const data = {
					_token:CSRF_TOKEN,
					title: $(form).find('[name="cat_title"]').val(),
				}

				const url = $(form).find('[name="action-url"]').val();
				$("#add-category-modal").modal('hide');

				$.ajax({
					url: url,
					method: 'POST',
					data: data,
					success: function(response){
						title: $("#add-product-form").find('[name="category_id"]')
						.append(`<option value='${response.id}'>${response.title}</option>`);
						$(form).find('[name="cat_title"]').val("");
					},
					error: function(error){
						console.log(error);
					}
				});
			});
		});
	</script>


	<div class="modal fade" id="add-category-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3>Add New Category</h3>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<div class="container">
						<form id="add-category-form" method="POST">
							@csrf
							<div class="form-group">
								<label for="cat-title">Category Title</label>
								<input type="text" class="form-control" id="cat-title" name="cat_title" required/>
							</div>
							<input class="btn btn-primary" type="submit" name="submit" id="submit" />
							<input type="hidden" value="{{ route('product_categories.store') }}" name="action-url" />
						</form>
					</div>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>
@endsection

@section('scripts')

@endsection
