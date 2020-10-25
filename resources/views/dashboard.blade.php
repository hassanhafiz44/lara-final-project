@extends('layouts.app')

@section('content')
<div class="container-fluid" ng-app="dashboard" ng-controller="DashboardCtrl" ng-init="initializeDashboard()">
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-3 mb-2 mt-2">
			<div class="card bg-primary text-white">
				<div class="card-body">
					<h5 class="card-title">Today Invoices</h5>
					<span><%= no_today_invoices %></span>
				</div>
			</div>
		</div>
		<div class="col-lg-3 mb-2 mt-2">
			<div class="card bg-warning text-white">
				<div class="card-body">
					<h5 class="card-title">Today Sales </h5>
					<span><%= today_sales | currency:"PKR"  %></span>
				</div>
			</div>
		</div>
		<div class="col-lg-3 mb-2 mt-2">
			<div class="card bg-info text-white">
				<div class="card-body">
					<h5 class="card-title">Month Invoices </h5>
					<span><%= no_month_invoices %></span>
				</div>
			</div>
		</div>
		<div class="col-lg-3 mb-2 mt-2">
			<div class="card bg-success text-white">
				<div class="card-body">
					<h5 class="card-title">Month Sales </h5>
					<span><%= month_sales | currency:"PKR" %></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 mb-2 mt-2">
			<div class="card">
				<div class="card-body">
					<div id="products-by-cat-chart"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 mb-2 mt-2">
			<div class="card">
				<div class="card-body">
					<div id="expense-income-chart"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4 mb-2 mt-2">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Recent Buyers</h5>
					<table class="table table-striped" id="recent-buyers">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="buyer in recent_buyers">
								<td><%= $index + 1 %></td>
								<td><%= buyer.name %></td>
								<td><%= buyer.email %></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-8 mb-2 mt-2">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Summary</h5>
					<div class="row">
						<div id="stock-worth-chart"></div>
					</div>
					<div class="row mt-4">
						<div class="col-lg-4 text-center">
							<p class="card-text mb-0">Current Stock Worth</p>
							<span class="text-primary"><%=  current_stock_worth | currency:"PKR" %></span>
						</div>
						<div class="col-lg-4 text-center">
							<p class="card-text mb-0">Current Stock Retail Worth</p>
							<span class="text-success"><%=  current_stock_retail_worth | currency:"PKR" %></span>
						</div>
						<div class="col-lg-4 text-center">
							<p class="card-text mb-0">Current Profit Worth</p>
							<span class="text-info"><%=  current_profit_worth | currency:"PKR" %></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
<script src="{{ asset('js/angular.min.js') }}"></script>
<script>
	const app = angular.module('dashboard', []);
	app.config(function($interpolateProvider){

		$interpolateProvider.startSymbol('<%=');
		$interpolateProvider.endSymbol('%>');
	});

	app.controller('DashboardCtrl', function($scope, $http) {
		const initialization_url = '{{ route('admin.dashboard.initialize') }}';
		$scope.message = "hello";
		$scope.recent_buyers = [];
		$scope.initializeDashboard = function () {
			$("body").LoadingOverlay('show');
			$http.post(initialization_url, {_token: '{{ Session::token() }}'}).then(
				function(response) {
					console.log(response);
					const data = response.data;
					$scope.month_sales = data.month_sales;
					$scope.today_sales = data.today_sales;
					$scope.no_today_invoices = data.no_today_invoices;
					$scope.no_month_invoices = data.no_month_invoices;
					$scope.products_count = data.products_count;
					$scope.recent_buyers = data.recent_buyers;
					$scope.current_stock_worth = data.current_stock_worth;
					$scope.current_stock_retail_worth = data.current_stock_retail_worth;
					$scope.current_profit_worth = data.current_stock_retail_worth - data.current_stock_worth;
					renderHighChart('products-by-cat-chart', 'No. of Products by Categories', 'Category', data.products_by_cat, "products");
					renderHighChart('expense-income-chart', 'Income VS Expense (PKR)', 'E-I', data.income_expense, "PKR");
					lineChart('stock-worth-chart', 'Summary', data.current_stock_worth, data.current_stock_retail_worth, $scope.current_profit_worth);
				}
			).catch(function(error) {

			}).finally(function() {
				$("body").LoadingOverlay('hide');
			});
		}

		function renderHighChart(containerId, title, seriesName, data, unit) {
			{{-- let format = "";
			if(unit === "PKR") {
				format = '{series.name}: ' + unit +'<b>{point.y}</b>';
			} else {
				format = '{series.name}: <b>{point.y}</b> '+ unit;
			}
			console.log(format); --}}
			Highcharts.chart(containerId, {
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				title: {
					text: title
				},
				tooltip: {
					pointFormat: '{point.name}: <b>{point.y}</b>'
				},
				accessibility: {
					point: {
						valueSuffix: '%'
					}
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '{point.name}: <b>{point.y}</b>'
						}
					}
				},
				series: [{
					name: seriesName,
					colorByPoint: true,
					data: data
				}]
			});
		}
	});

	function lineChart(containerId, title, price, retail, profit) {
		Highcharts.chart(containerId, {

		title: {
			text: title
		},

		subtitle: {
			text: ''
		},

		yAxis: {
			title: {
				text: 'Amount'
			}
		},

		xAxis: {
			accessibility: {
				rangeDescription: ''
			}
		},

		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle'
		},

		plotOptions: {
			series: {
				label: {
					connectorAllowed: false
				},
				pointStart: 0
			}
		},

		series: [{
			name: 'Price',
			data: [0, price]
		}, {
			name: 'Retail',
			data: [0, retail]
		}, {
			name: 'Profit',
			data: [0, profit]
		}],

		responsive: {
			rules: [{
				chartOptions: {
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom'
					}
				}
			}]
		}

	});
	}

	$(function() {
		
	});
</script>
@endsection