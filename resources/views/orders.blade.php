@extends('dashboardlayout')
	@section('content')
		<div class="container-fluid">
  		<h1 class="text-center mt-3">Orders</h1>
  		<div class="row">
  			<div class="col-lg-12">
  				<table class="table mt-3">
						<thead class="table-dark">
							<tr>
								<th>#</th>
								<th>Customer's name</th>
								<th>Product ID</th>
								<th>Product name</th>
								<th>Quantity</th>
								<th>Amount</th>
								<th>Date</th>
								<th>Address</th>
								<th>Contact no</th>
								<th>City</th>
			
							</tr>
						</thead>
						<tbody>
						<tr>
							<td>1</td>
							<td>Ali</td>
							<td>2391</td>
							<td>Lenovo</td>
							<td>3</td>
							<td>RS:40000</td>
							<td>12-07-2019</td>
							<td>Phato mund</td>
							<td>03001234567</td>
							<td>Gujranwala</td>
						</tr>
					</tbody>
					</table>
  			</div>
  		</div>
  	</div>


	@endsection