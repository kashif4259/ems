 @extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-11">
				 <div class="card">
					<div class="header">
						<h4 class="title"><?php echo trans('lang.expense_reports');?></h4>
					</div>
					<form action="" method="POST" id="form" autocomplete="off">
						<div class="content">
							<div class="row">
								<div class="col-md-4 mt-4 mt-md-2">
								 <label><?php echo trans('lang.name');?></label>
								 <input id="name" type="text" class="form-control" name="name" placeholder="<?php echo trans('lang.name');?>"/>
								</div>	
								<div class="col-md-4 mt-4 mt-md-2">
								 <label><?php echo trans('lang.category');?></label>
								 <select id="incomecategory" class="form-control" name="category" required data-url="{{ url('expensecategory/getdata')}}">
								 <option value=""><?php echo trans('lang.select_a_category');?></option>
								 </select>
								</div>
								<div class="col-md-4 mt-4 mt-md-2">
								 <label><?php echo trans('lang.sub_category');?></label>
								 <select id="incomesubcategory" class="form-control" name="subcategory" data-url="{{ url('expensecategory/subgetdatabycat')}}">
								 </select>
								</div>
							</div>	
							<div class="row">
								<div class="col-lg-4 mt-4 mt-md-2">
								<label for="date" class="control-label"> 
										<?php echo trans('lang.from_date');?></label>
										<div  class="input-group date" data-date-format="mm-dd-yyyy">
											<input id="fromdate" name="fromdate" class="form-control" type="text" value=""/>
											<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
										</div>
								</div>
								<div class="col-lg-4 mt-2 mt-md-2">
								<label for="date" class="control-label"> 
										<?php echo trans('lang.to_date');?></label>
										<div  class="input-group date" data-date-format="mm-dd-yyyy">
											<input id="todate" name="todate" class="form-control" type="text" value=""/>
											<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
										</div>
								</div>
							</div>						
							
								<div class="d-flex flex-sm-row flex-column pb-2">
									<div class="pb-3 pb-md-0 mr-3">
										<button id="reset" class="btn btn-secondary btn-fill btn-wd"><i class="ti-reload"></i> <?php echo trans('lang.reset');?></button>
									</div>
									
									<div class="d-flex flex-row">
		                                 <button type="submit" class="btn btn-info btn-fill btn-wd"><i class="ti-search"></i> <?php echo trans('lang.search');?></button>
		                            </div>
								</div>

								
							
						</div>
					</form>
				 </div>
			</div> 
		</div>
		
        <div class="row">

            <div class="col-lg-12 col-md-11">
                <div class="card">
                    <div class="header">
						<h4 class="title"><?php echo trans('lang.expense_reports');?></h4>
                    </div>
                    <div class="content">
					<div class="table-responsive">
						<table id="data" class="table" cellspacing="0" width="100%">
							<thead>
								<tr>

									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.account');?></th>
									<th><?php echo trans('lang.amount');?></th>
									<th><?php echo trans('lang.date');?></th>											
								</tr>
							</thead>
							
							<tbody>
							
							</tbody>
						</table>
					</div>
                    </div>
                </div>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-6">
				<div class="card">
					<div class="header">
						<div class="pull-left">
							<h5><b><?php echo trans('lang.12_monthly_expense_chart');?></b></h5>
						</div>
						<div class="pull-right">
							<div class="text-danger">
								<b><span class="currency"></span><span id="totalyear"></span></b><br/>
								<small><?php echo trans('lang.in_this_year');?></small>
							</div>
						</div>
					</div>
					<div class="content">
					<input type="hidden" class="currency"/>
							<canvas id="chart1"></canvas>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card">
					<div class="header">
						<h5><b><?php echo trans('lang.expense_by_category');?> (<?php echo date("Y");?>)</b></h5>
					</div>
					<div class="content">
							<canvas id="chart2"></canvas>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>	

<script src="{{ asset('js/general.js') }}"></script>
<script src="{{ asset('js/expense.js') }}"></script>
<script src="{{ asset('js/account.js') }}"></script>
<script src="{{ asset('js/category.js') }}"></script>

<script>


$(document).ready(function() {
	
	//Expense total
	$.ajax({
        type: "GET",
        url: "{{ url('expense/gettotal')}}",
        dataType: "json",
        data: "{}",
        success: function (data) {
			$("#totalyear").html(data.year);
			
        },
    });


	
	//get data
    var table = $('#data').DataTable( {
			
			
			bFilter : false,
            ajax: {
				url : "{{ url('reports/gettransactions')}}",
				data: function (d) {
					d.type 		= '2';
					d.category = $('select[name=category]').val();
					d.names = $('input[name=name]').val();
					//d.category = 'Salary';
					d.subcategory = $('select[name=subcategory]').val();
					d.fromdate = $('input[name=fromdate]').val();
					d.todate = $('input[name=todate]').val();
				},
			},
			
			columns: [
				{ data: 'name', name:'name'},
				{ data: 'category', name:'category'},
				{ data: 'subcategory', name:'subcategory'},
				{ data: 'account', name:'account'},				
				{ data: 'amount', name:'amount'},		
				{ data: 'transactiondate', name:'transactiondate'}
			],

			buttons: [
				{
					extend: 'copy',
					text:   'Copy',
					title: '<?php echo trans('lang.expense_reports');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV ',
					title: '<?php echo trans('lang.expense_reports');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF',
					title: '<?php echo trans('lang.expense_reports');?>',
					className: 'btn btn-sm btn-fill ',
					orientation:'landscape',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.expense_reports');?>',
					text:   'Print',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5 ]
					}
				}
			]
    } );
	//do search
	$('#form').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });

    //reset form
    $("#reset").on('click', function(e) {
    	e.preventDefault();
	    $("#form").find("input").val("");
	    $('select').val('');
	});
	
	//income graph
	$.ajax({
        type: "GET",
        url: "{{ url('home/incomevsexpense')}}",
        dataType: "json",
        data: "{}",
        success: function (data) {
			var cchart1 = document.getElementById("chart1");
			var chart1 = new Chart(cchart1, {
				type: 'line',
				legendPosition: 'bottom',
				data: {
					labels: ["<?php echo trans('lang.jan');?>", "<?php echo trans('lang.feb');?>", "<?php echo trans('lang.mar');?>", "<?php echo trans('lang.apr');?>", "<?php echo trans('lang.may');?>", "<?php echo trans('lang.jun');?>", "<?php echo trans('lang.jul');?>", "<?php echo trans('lang.aug');?>", "<?php echo trans('lang.sep');?>", "<?php echo trans('lang.oct');?>", "<?php echo trans('lang.nov');?>", "<?php echo trans('lang.dec');?>"],
					datasets: [
					{
						label: '<?php echo trans('lang.expense');?>',
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
	
	//incomebycategory
	$.ajax({
        type: "GET",
        url: "{{ url('home/expensebycategoryyearly')}}",
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
			
			var cchart2 = document.getElementById("chart2");
			var chart2 = new Chart(cchart2, {
				type: 'bar',
				legendPosition: 'bottom',
				data: {
					labels: label,
					datasets: [
					{
						label: '<?php echo trans('lang.category');?>',
						data: amount,
						backgroundColor: '#FF5668',
						borderColor:	'#FF5668',
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
		
} );


</script>
@endsection