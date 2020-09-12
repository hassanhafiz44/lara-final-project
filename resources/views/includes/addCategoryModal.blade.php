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
							@csrf<br>
							<div class="form-group">
								<label for="cat-title">Category Title</label>
								<input type="text" class="form-control" id="cat-title" name="cat_title" required />
							</div>
							<input class="btn btn-primary" type="submit" name="submit" id="submit" />
							<input type="hidden" value="{{ route('admin.product_categories.store') }}" name="action-url" />
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