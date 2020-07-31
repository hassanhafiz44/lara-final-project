@extends('layouts.app')
	@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<h2 class="text-white" style="background-color: rgba(248,70,129,0.6)">Latest Oders</h2>
				<div class="container d-block">
					<table class="table mt-3">
						<thead class="table-dark">
							<tr>
								<th>#</th>
								<th>ID</th>
								<th>Customer'name</th>
								<th>Product</th>
								<th>Date</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<tr>
							<td>1</td>
							<td>2391</td>
							<td>Ali Hassan</td>
							<td>HP laptop</td>
							<td>12-07-2019</td>
							<td><a href="#" class="btn btn-outline-secondary btn-sm">Details</a></td>
						</tr>
					</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-4 mt-4">
				<div class="card">
					<div class="bg-primary text-white p-4">
						<i class="fa fa-list-ul "></i>
						<h2 class="float-right font-weight-bold" style="font-size: 35px;text-align: center;">0
							<span class="d-block">Products</span></h2>
					</div>
					<div class="card-footer text-primary">
						<h6 class="text-center"><a href="adminproducts.html">View Details</a></h6>
					</div>
				</div>

				<div class="card mt-3">
					<div class="bg-primary text-white p-4">
						<i class="fa fa-list-ul"></i>
						<h2 class="float-right font-weight-bold" style="font-size: 35px;text-align: center;">
						<span class="d-block">Sales</span></h2>
					</div>
					<div class="card-footer text-primary">
						<h6 class="text-center"><a href="#">View Details</a></h6>
					</div>
				</div>

				<div class="card mt-3">
					<div class="bg-primary text-white p-4">
						<i class="fa fa-list-ul "></i>
						<h2 class="float-right font-weight-bold" style="font-size: 35px;text-align: center;">
							<span class="d-block">Expenses</span></h2>
					</div>
					<div class="card-footer text-primary">
						<h6 class="text-center"><a href="#">View Details</a></h6>
					</div>
				</div>
		</div>
	</div>



						<!-- New User -->
		<div class="modal fade" id="newuser">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-body">
                          	<h2 class="text-center">Add New User</h2>
                             <form>
					          <div class="form-group">
					          	<label class="col-form-label">Full Name:</label>
					            <input type="text" class="form-control" >
					            <label class="col-form-label">Username:</label>
					            <input type="text" class="form-control" >
					            <label  class="col-form-label">Password:</label>
					            <input type="password" class="form-control" >
					            <label class="col-form-label">Confirm Password:</label>
					            <input type="password" class="form-control">
					          </div>
					        </form>

                          </div>
                          
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Add User</button>
                          </div>
                          
                        </div>
                      </div>
        </div>


        				<!-- Delet user -->
		<div class="modal fade" id="deletuser">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-body">
                          	<h2 class="text-center">Delet User</h2>
                            <table class="table mt-3">
						<thead class="table-dark">
							<tr>
								<th>#</th>
								<th>ID</th>
								<th>Username</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<tr>
							<td>1</td>
							<td>2391</td>
							<td>Ali Hassan</td>
							<td><a href="#" class="btn btn-outline-danger btn-sm">Delet</a></td>
						</tr>
					</tbody>
					</table>

                          </div>
                          
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                          </div>
                          
                        </div>
                      </div>
        </div>
</div>

        		<!-- Change Password -->

	<div class="modal fade" id="changepassword">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-body">
                          	<h2 class="text-center">Change Password</h2>
                            <form>
					          <div class="form-group">
					          	<label class="col-form-label">Old Password:</label>
					            <input type="text" class="form-control">
					            <label class="col-form-label">New Password:</label>
					            <input type="text" class="form-control">
					            <label class="col-form-label">Confirm New Password:</label>
					            <input type="text" class="form-control">
					          </div>
					        </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Change Password</button>
                           </div>
                        </div>
                      </div>
        </div>        

	@endsection
