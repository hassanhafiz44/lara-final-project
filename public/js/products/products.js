$(function() {
	// On add category form submission
	$("#add-category-form").on('submit',function(event) {
		event.preventDefault();

		const form = document.querySelector('#add-category-form');
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
				showNotification("Category added successfully", "Success", "success");
			},
			error: function(error){
				console.log(error);
				showNotification("Something went wrong", "Success", "success");
			}
		});
	});

	$("#products-table").on('click', '.delete-product', function(event) {
		const product_id = $(event.target).closest('tr').data('pid');
		console.log(product_id);
		const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: `products/${product_id}`,
			method: 'DELETE',
			data: {
				_token:CSRF_TOKEN,
			},
			success: function(response) {
				if(response.message) {
					$(event.target).closest('tr').remove();
				} else {
					console.log(response);
				}
			},
			error: function(error) {
				console.log(error);
			}
		});
	});
});
