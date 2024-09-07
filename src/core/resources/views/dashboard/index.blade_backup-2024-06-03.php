@extends('layouts.app')
@section('content')
<div class="content">
        <div class="p-3">
    		<div class="row ">
    			 
                 <div class="col-md-8 border-right">
                 	<div class="row">
                 		<div class="col-md-6">
		                 	<h5 class="title mb-2 mt-0"><?php echo trans('lang.income');?><h5>
		                 	<div class="d-flex align-items-stretch">
		                 		<div class="home-icon-content background-blue color-white p-3 rounded flex-fill">
		                 			<p class="home-icon mb-0"><i class="ti-angle-double-up"></i></p>
		                 		</div>
		                 		<div class="background-grey p-3 rounded flex-fill">
		                 			<p class="transactiontitle"><span class="currency"></span><span class="incomethismonth"></span></p>	
		                 			<p class="small-font mb-0"><?php echo trans('lang.in_this_month');?> (<?php echo date("F")?>)</p>
		                 		</div>
		                 	</div>
		                </div>
		                <div class="col-md-6">
		                 	<h5 class="title mb-2 mt-0"><?php echo trans('lang.expense');?><h5>
		                 	<div class="d-flex align-items-stretch">
		                 		<div class="home-icon-content background-red color-white p-3 rounded flex-fill">
		                 			<p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
		                 		</div>
		                 		<div class="background-grey p-3 rounded flex-fill">
		                 			<p class="transactiontitle"><span class="currency"></span><span class="expensemonth"></span></p>	
		                 			<p class="small-font mb-0"><?php echo trans('lang.in_this_month');?> (<?php echo date("F")?>)</p>
		                 		</div>
		                 	</div>
		                </div>
	                </div>

	                <div class="row">
		                <div class="col-md-12">
			                <h5 class="title mb-2"> <?php echo trans('lang.income_vs_expense').' '. date("Y");?><h5>
			                <canvas id="incomevsexpense" height="100"></canvas>
		                </div>
	                </div>
	                <div class="row">
	                	<div class="col-md-6">
	                		<h5 class="title mb-2"><?php echo trans('lang.income_by_category').' '.date("F Y");?><h5>
	                		 <canvas id="incomebycategory" height="200"></canvas>
	                	</div>
	                	<div class="col-md-6">
	                		<h5 class="title mb-2"><?php echo trans('lang.expense_by_category').' '.date("F Y");?><h5>
	                		 <canvas id="expensebycategory" height="200"></canvas>
	                	</div>
	                </div>
                 </div>
                 <div class="col-md-4">
                 	<div class="row">
                 		<div class="col-md-12">
                 			<div class="rounded background-green color-white p-4">
		                 		<p class=""><?php echo trans('lang.balance');?></p>
		                 		<p class="transactiontitle"><span class="currency"></span><span class="totalbalance"></span></p>
		                 		<p class="small-font mb-0"><?php echo trans('lang.in_this_month');?> (<?php echo date("F")?>)</p>
		                 	</div>
                 		</div>
                 	</div>
                 	<div class="row">
	                 	<div class="col-md-12">
		                 	<h5 class="title mt-3 mb-2"><?php echo trans('lang.account_balance').' '. date("Y");?><h5>
		                 	<canvas id="accountbalance" height="100"></canvas>
	                 	</div>
                 	</div>
                 	<div class="row">
	                 	<div class="col-md-12">
	                 		<div class="rounded background-grey p-4">
	                 			<h5 class="title mt-0"><?php echo trans('lang.new');?></h5>
	                 			<ul class="quick-menu">
			                 	@if(Auth::check())
		                           
		                         <li class="{{ Request::is( 'transaction') ? 'active' : '' }}">
		                             <a href="{{ URL::to( 'transaction') }}" >
		                                <?php echo trans('lang.transactions');?> 
		                                <i class="ti-angle-right"></i>
		                            </a>
		                        </li>
		                            
		                        @endif
		                       @if(Auth::check())
		                            
		                         <li class="{{ Request::is( 'reports/allreports') ? 'active' : '' }}">
		                             <a href="{{ URL::to( 'reports/income') }}" >
		                                <?php echo trans('lang.income_reports');?>
		                                 <i class="ti-angle-right"></i>
		                            </a>
		                        </li>
		                           
		                        @endif
		                         @if(Auth::check())
		                            
		                         <li class="{{ Request::is( 'reports/allreports') ? 'active' : '' }}">
		                             <a href="{{ URL::to( 'reports/expense') }}" >
		                               <?php echo trans('lang.expense_reports');?>
		                               <i class="ti-angle-right"></i>
		                            </a>
		                        </li>
		                           
		                        @endif
		                         @if(Auth::check())
		                            
		                         <li class="{{ Request::is( 'reports/allreports') ? 'active' : '' }}">
		                             <a href="{{ URL::to( 'reports/account') }}" >
		                                <?php echo trans('lang.account_transaction_report');?>
		                                <i class="ti-angle-right"></i>
		                            </a>
		                        </li>
		                            
		                        @endif
			                 	</ul>
	                 		</div>
	                 		
	                 	</div>
                 	</div>
                </div>
    		</div>

			<div class="row">
				<div class="col-md-8 border-right">
						<div class="d-flex justify-content-between">
							<h5 class="title mt-0"><?php echo trans('lang.transactions');?><h5>
							<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="income-tab-dashboard" data-toggle="tab" href="#income" role="tab" aria-controls="income" aria-selected="true"><?php echo trans('lang.income');?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="expense-tab-dashboard" data-toggle="tab" href="#expense" role="tab" aria-controls="expense" aria-selected="false"><?php echo trans('lang.expense');?></a>
							</li>
							</ul>
						</div>
						
						<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="income" role="tabpanel" aria-labelledby="income-tab-dashboard">
								<div class="latestincome pt-3">
								<table cellpadding="5" cellspacing="0" border="0" width="100%">
									<thead>
										<tr>
											<th>
												<p class="mb-0"><?php echo trans('lang.name');?> </p>
											</th>
											<th>
												<p class="mb-0"><?php echo trans('lang.date');?> </p>
											</th>

											<th>
												<p class="mb-0"><?php echo trans('lang.account');?> </p>
											</th>
											<th>
												<p class="mb-0 text-center"><?php echo trans('lang.amount');?> </p>
											</th>
										</tr>
									</thead>
									<tbody id="latestincomedata">

									</tbody>
								</table>
								</div>
						</div>
						<div class="tab-pane fade" id="expense" role="tabpanel" aria-labelledby="expense-tab-dashboard">
							<div class="latestexpense pt-3">
							<table cellpadding="5" cellspacing="0" border="0" width="100%">
									<thead>
										<tr>
											<th>
												<p class="mb-0"><?php echo trans('lang.name');?> </p>
											</th>
											<th>
												<p class="mb-0"><?php echo trans('lang.date');?> </p>
											</th>

											<th>
												<p class="mb-0"><?php echo trans('lang.account');?> </p>
											</th>
											<th>
												<p class="mb-0 text-center"><?php echo trans('lang.amount');?> </p>
											</th>
										</tr>
									</thead>
									<tbody id="latestexpensedata">

									</tbody>
								</table>
							</div>
						</div>
						</div>


						
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-8 border-right">
						<div class="d-flex justify-content-between">
							<h5 class="title mt-0">User Balance<h5>
							<!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="userbalance-tab-dashboard" data-toggle="tab" href="#ub" role="tab" aria-controls="userbalance" aria-selected="true">User Balance</a>
							</li>
							
							</ul> -->
						</div>
						
						<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="ub" role="tabpanel" aria-labelledby="userbalance-tab-dashboard">
								<div class="userbalance pt-3">
								<table cellpadding="5" cellspacing="0" border="0" width="100%">
									<thead>
										<tr>
											<th>
												<p class="mb-0">Username </p>
											</th>
											<th>
												<p class="mb-0">Account </p>
											</th>

											<th>
												<p class="mb-0">Account Balance </p>
											</th>
											<th>
												<p class="mb-0 text-center">Total Expense </p>
											</th>
											<th>
												<p class="mb-0 text-center">Remaining Balance </p>
											</th>
										</tr>
									</thead>
									<tbody id="userbalancedata">

									</tbody>
								</table>
								</div>
						</div>
						
						</div>


						
					</div>
				</div>
			</div>
</div>	  
<script>


$(document).ready(function() {
	$.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
	});
	
	function numberWithCommas(x) {
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}
	
	
	
	
	//accountbalance
	$.ajax({
        type: "GET",
        url: "{{ url('home/accountbalance')}}",
        dataType: "json",
        success: function (data) {
			var label = [];
			var amount = [];
			var color = [];
			for(var i in data) {
				label.push(data[i].name);
				amount.push(data[i].balance);

			}
			
			var caccountbalance = document.getElementById("accountbalance");
			var accountbalance = new Chart(caccountbalance, {
				type: 'bar',
				legendPosition: 'bottom',
				data: {
					labels: label,
					datasets: [
					{
						label: "<?php echo trans('lang.account');?>",
						data: amount,
						backgroundColor: '#1DC873',
						borderColor: '#1DC873',
						borderWidth: 1
					}
					]
				},
				options: {
					legend: {
						   position: 'bottom',
					},
					tooltips: {
					  callbacks: {
						title: function(tooltipItem, data) {
						  return data['labels'][tooltipItem[0]['index']];
						},
						label: function(tooltipItem, data) {
						  return currency+data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						}
					  },
					}
				}
			});
		}
	});	
	
	
	//expensecategory
	$.ajax({
        type: "GET",
        url: "{{ url('home/expensebycategory')}}",
        dataType: "json",
        success: function (data) {
			var label = [];
			var amount = [];
			var color = [];
			
			for(var i in data) {
				label.push(data[i].category);
				amount.push(data[i].amount);
				color.push(data[i].color);
			}
			
			var cexpensecategory = document.getElementById("expensebycategory");
			var expensecategory = new Chart(cexpensecategory, {
				type: 'doughnut',
				legendPosition: 'bottom',
				data: {
					labels: label,
					datasets: [
					{
						label: "<?php echo trans('lang.category');?>",
						data: amount,
						backgroundColor: color,
						borderColor: color,
						borderWidth: 1
					}
					]
				},
				options: {
					legend: {
						   position: 'bottom',
					},
					tooltips: {
					  callbacks: {
						title: function(tooltipItem, data) {
						  return data['labels'][tooltipItem[0]['index']];
						},
						label: function(tooltipItem, data) {
						  return currency+data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						},
						afterLabel: function(tooltipItem, data) {
						  var dataset = data['datasets'][0];
						  //var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset["_meta"][0]['total']) * 100)
						  //return '(' + percent + '%)';
						}
					  },
					}
				}
			});
		}
	});	
	
	//incomecategory
	$.ajax({
        type: "GET",
        url: "{{ url('home/incomebycategory')}}",
        dataType: "json",
        success: function (data) {
			var label = [];
			var amount = [];
			var color = [];
			
			for(var i in data) {
				label.push(data[i].category);
				amount.push(data[i].amount);
				color.push(data[i].color);
			}
			
			var cincomebycategory = document.getElementById("incomebycategory");
			var incomebycategory = new Chart(cincomebycategory, {
				type: 'doughnut',
				legendPosition: 'bottom',
				data: {
					labels: label,
					datasets: [
					{
						label: "<?php echo trans('lang.category');?>",
						data: amount,
						backgroundColor: color,
						borderColor: color,
						borderWidth: 1
					}
					]
				},
				options: {
					legend: {
						   position: 'bottom',
					},
					tooltips: {
					  callbacks: {
						title: function(tooltipItem, data) {
						  return data['labels'][tooltipItem[0]['index']];
						},
						label: function(tooltipItem, data) {
						  return currency+data['datasets'][0]['data'][tooltipItem['index']].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						},
						afterLabel: function(tooltipItem, data) {
						  var dataset = data['datasets'][0];
						  //var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset["_meta"][0]['total']) * 100)
						  //return '(' + dataset + '%)';
						}
					  },
					}
				}
			});
		}
	});

	//incomevsexpense
	$.ajax({
        type: "GET",
        url: "{{ url('home/incomevsexpense')}}",
        dataType: "json",
        success: function (data) {
			var cincomevsexpense = document.getElementById("incomevsexpense");
			var incomevsexpense = new Chart(cincomevsexpense, {
				type: 'line',
				legendPosition: 'bottom',
				data: {
					labels: ["<?php echo trans('lang.jan');?>", "<?php echo trans('lang.feb');?>", "<?php echo trans('lang.mar');?>", "<?php echo trans('lang.apr');?>", "<?php echo trans('lang.may');?>", "<?php echo trans('lang.jun');?>", "<?php echo trans('lang.jul');?>", "<?php echo trans('lang.aug');?>", "<?php echo trans('lang.sep');?>", "<?php echo trans('lang.oct');?>", "<?php echo trans('lang.nov');?>", "<?php echo trans('lang.dec');?>"],
					datasets: [
					{
						label: "<?php echo trans('lang.income');?>",
						data: [data.ijan, data.ifeb, data.imar, data.iapr, data.imay, data.ijun, data.ijul, data.iags, data.isep, data.iokt, data.inov, data.ides],
						backgroundColor: '#41d5e2',
						borderColor: '#41d5e2',
						borderWidth: 1
					},{
						label: "<?php echo trans('lang.expense');?>",
						data: [data.ejan, data.efeb, data.emar, data.eapr, data.emay, data.ejun, data.ejul, data.eags, data.esep, data.eokt, data.enov, data.edes],
						backgroundColor: '#FF5668',
						borderColor:	'#FF5668',
						borderWidth: 1
					}
					]
				},
				options: {
					 pieceLabel: {
					  // render 'label', 'value', 'percentage' or custom function, default is 'percentage'
					  render: 'label'
					 }, 
					legend: {
						   position: 'bottom',
						},
					tooltips: {
							mode: 'index',
							intersect: false,
							callbacks: {
								label: function(tooltipItem, data) {
									return currency+tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
								},
							}
						},
					hover: {
							mode: 'nearest',
							intersect: true
						},
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero:true,
								callback: function(value, index, values) {
								  if(parseInt(value) >= 1000){
									return  currency+value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
								  } else {
									return currency + value;
								  }
								}
							}
						}]
					}
				}
			});
			
        },
    });

	
	//latest income 
	//get data
    
     $.ajax({
        type: "GET",
        url: "{{ url('home/latestincome')}}",
        dataType: "JSON",
        success: function(html) {
        	var objs = html.data;
			jQuery.each(objs, function (index, record) {
               
                $("#latestincomedata").append(
								'<tr>'+
									'<td><b>'
										+record.name+
									'</b></td>'+
									'<td>'
										+moment(record.transactiondate).format('yyyy-MM-DD')+
									'</td>'+
									'<td>'
										+record.account+
									'</td>'+
									'<td align="center"><b>'
										+currency+numberWithCommas(parseFloat(record.amount).toFixed(2))+
									'</b></td>'+
								'</tr>'			
	        	);
        	});
        }
    });
	
	//latest expense 
	//get data
    $.ajax({
        type: "GET",
        url: "{{ url('home/latestexpense')}}",
        dataType: "JSON",
        success: function(html) {
        	var objs = html.data;
			jQuery.each(objs, function (index, record) {
               
                $("#latestexpensedata").append(
	        		'<tr>'+
									'<td><b>'
										+record.name+
									'</b></td>'+
									'<td>'
										+moment(record.transactiondate).format('yyyy-MM-DD')+
									'</td>'+
									'<td>'
										+record.account+
									'</td>'+
									'<td align="center"><b>'
										+currency+numberWithCommas(parseFloat(record.amount).toFixed(2))+
									'</b></td>'+
								'</tr>'	);
        	});
        }
    });
   
	
	

	
	//income total
	$.ajax({
        type: "GET",
        url: "{{ url('income/gettotal')}}",
        dataType: "json",
        success: function (data) {
			$(".incomeday").html(data.day);
			$(".incomethismonth").html(data.month);
			
        },
    });
	
	//expense total
	$.ajax({
        type: "GET",
        url: "{{ url('expense/gettotal')}}",
        dataType: "json",
        success: function (data) {
			$(".expenseday").html(data.day);
			$(".expensemonth").html(data.month);
			
        },
    });

    //net balance
    //balance
	$.ajax({
        type: "GET",
        url: "reports/getbalance",
        dataType: "json",
        success: function (data) {
			$(".totalbalance").html(data.month);
			
        },
    });

	$.ajax({
        type: "GET",
        url: "{{ url('home/userbalancereport')}}",
        dataType: "JSON",
        success: function(html) {
        	var objs = html.data;
			console.log(objs);
			jQuery.each(objs, function (index, record) {
               		console.log(record.totalincome);
               		if(record.totalincome > 0.00){
	               		var total = record.accountbalance+(record.totalincome-record.totalexpense);
               		}else{
		        	    var total = record.accountbalance-record.totalexpense;       		
               		}
               		console.log(total);
                 $("#userbalancedata").append(
	         		'<tr>'+
			 						'<td>'
			 							+record.username+
			 						'</td>'+
			 						'<td>'
			 							+record.accountname+
			 						'</td>'+
			 						'<td><b>'
			 							+currency+numberWithCommas(parseFloat(record.accountbalance).toFixed(2))+
			 						'</b></td>'+
			 						'<td align="center"><b>'
			 							+currency+numberWithCommas(parseFloat(record.totalexpense).toFixed(2))+
			 						'</b></td>'+
									'<td align="center"><b>'
			 							+currency+numberWithCommas(parseFloat(total).toFixed(2))+
			 						'</b></td>'+
			 					'</tr>'	);
        	 });
        }
    });
   
} );



</script>
@endsection
