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
			},
			error: function(error){
				console.log(error);
			}
		});
	});
});
