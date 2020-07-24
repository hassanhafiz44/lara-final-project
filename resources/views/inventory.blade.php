@extends('dashboardlayout')
	@section('content')
		<div class="container-fluid">
  		<h1 class="text-center mt-3">All products</h1>
  		<a href="#" data-toggle="modal" data-target="#addproduct" class="btn btn-secondary ">Add product</a>
  		<div class="row">
  			<div class="col-lg-12">
  				<table class="table mt-3">
						<thead class="table-dark">
							<tr>
								<th>#</th>
								<th>ID</th>
								<th>Product Name</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Date</th>
								<th></th>
			
							</tr>
						</thead>
						<tbody>
						<tr>
							<td>1</td>
							<td>2391</td>
							<td>Lenovo</td>
							<td>3</td>
							<td>RS:40000</td>
							<td>12-07-2019</td>
							<td>
								<a href="#" data-toggle="modal" data-target="#editproduct" class="btn btn-primary">Modify</a>
								<a href="#" class="btn btn-danger ">Delet</a>
							</td>
						</tr>
					</tbody>
					</table>
  			</div>
  		</div>
  	</div>


  	<div class="modal fade" id="editproduct">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-body">
                          	<h2 class="text-center">Edit product</h2>
                             <form>
					          <div class="form-group">
					          	<label class="col-form-label">ID:</label>
					            <input type="text" class="form-control" >
					            <label class="col-form-label">Name:</label>
					            <input type="text" class="form-control" >
					            <label  class="col-form-label">Price:</label>
					            <input type="text" class="form-control" >
					            <label class="col-form-label">Other Specs:</label>
					            <textarea class="form-control"></textarea>
					            <label class="col-form-label">Product image:</label>
					            <div class="custom-file">
						  			<input type="file" class="custom-file-input" id="inputfile">
						  			<label for="inputfile" class="custom-file-label"></label>
						  		</div>
					          </div>
					        </form>

                          </div>
                          
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                          </div>
                          
                        </div>
                      </div>
        </div>


        <!-- Add product modal -->
        <div class="modal fade" id="addproduct">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-body">
                          	<h2 class="text-center">Add product</h2>
                             <form>
					          <div class="form-group">
					          	<label class="col-form-label">ID:</label>
					            <input type="text" class="form-control" >
					            <label class="col-form-label">Name:</label>
					            <input type="text" class="form-control" >
					            <label  class="col-form-label">Price:</label>
					            <input type="text" class="form-control" >
					            <label class="col-form-label">Other Specs:</label>
					            <textarea class="form-control"> </textarea>
					            <label class="col-form-label">Product image:</label>
					            <div class="custom-file">
						  			<input type="file" class="custom-file-input" id="inputfile">
						  			<label for="inputfile" class="custom-file-label"></label>
						  		</div>
					          </div>
					        </form>

                          </div>
                          
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                          </div>
                          
                        </div>
                      </div>
        </div>

	@endsection