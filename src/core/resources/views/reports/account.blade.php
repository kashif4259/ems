 @extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
    	<div class="row">
			<div class="col-lg-12 col-md-11">
				 <div class="card">
					<div class="header">
						<h4 class="title"><?php echo trans('lang.account_transaction_report');?></h4>
					</div>
					<form action="" method="POST" id="form" autocomplete="off">
						<div class="content">
							<div class="row">
								<div class="col-md-4 mt-4 mt-md-2">
								 <label><?php echo trans('lang.name');?></label>
								 <input id="name" type="text" class="form-control" name="name" placeholder="<?php echo trans('lang.name');?>"/>
								</div>	
								<div class="col-md-4 mt-4 mt-md-2" id="getaccount" data-url="{{ url('account/getdata')}}">
								 <label><?php echo trans('lang.account');?></label>
								 <select id="account" class="form-control" name="account" required >
								 <option value=""><?php echo trans('lang.select_a_account');?></option>
								 </select>
								</div>
								
							</div>	
							<div class="row">
								<div class="col-md-4 mt-4 mt-md-2">
								<label for="date" class="control-label"> 
										<?php echo trans('lang.from_date');?></label>
										<div  class="input-group date" data-date-format="mm-dd-yyyy">
											<input id="fromdate" name="fromdate" class="form-control" type="text" value=""/>
											<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
										</div>
								</div>
								<div class="col-md-4 mt-2 mt-md-2">
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
										<button id="reset" type="button" class="btn btn-secondary btn-fill btn-wd"><i class="ti-reload"></i> <?php echo trans('lang.reset');?></button>
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

		text-red netincome
		
        <div class="row">
            <div class="col-lg-12 col-md-11">
                <div class="card">
                    <div class="header">
						<h4 class="title"><?php echo trans('lang.account_transaction_report');?></h4>
                    </div>
                    <div class="content">
					<div class="table-responsive">
						<table id="data" class="table"  cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.reference');?></th>
									<th><?php echo trans('lang.description');?></th>
									<th><?php echo trans('lang.date');?></th>	
									<th><?php echo 'Inital Balance';?></th>	
									<th><?php echo trans('lang.income');?></th>
									<th><?php echo trans('lang.expense');?></th>
 									<th>Running Balance</th>
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
			<div class="col-lg-12">
				<div class="card">
					<div class="header">
						<div class="pull-left">
							<h5><b><?php echo trans('lang.account_chart');?></b></h5>
						</div>
						<div class="pull-right">
							<div class="text-danger">
								<b><span></span></b><br/>
								<small></small>
							</div>
						</div>
					</div>
					<div class="content">
							<canvas id="accountbalance"></canvas>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>	

<script src="{{ asset('js/general.js') }}"></script>
<script src="{{ asset('js/account.js') }}"></script>
<script>


$(document).ready(function() {
	var initialBalance = 0;
    var totalIncome = 0;
    var totalExpense = 0;
    var runningBalance = 0;
	//get data
    var table = $('#data').DataTable( {
			bFilter : false,
			fixedHeader: true,
            // ajax: {
			// 	url : "{{ url('reports/getaccounttransaction')}}",
			// 	data: function (d) {
			// 		d.account = $('select[name=account]').val();
			// 		d.fromdate = $('input[name=fromdate]').val();
			// 		d.todate = $('input[name=todate]').val();
			// 		d.names = $('input[name=name]').val();
			// 	},
			// },

			ajax: {
				url: "{{ url('reports/getaccounttransaction') }}",
				data: function (d) {
					d.account = $('select[name=account]').val();
					d.fromdate = $('input[name=fromdate]').val();
					d.todate = $('input[name=todate]').val();
					d.names = $('input[name=name]').val();
				},
				dataSrc: function(json) {
					initialBalance = parseFloat(json.initialBalance) || 0;
					totalIncome = parseFloat(json.totalIncome) || 0;
					totalExpense = parseFloat(json.totalExpense) || 0;
					// runningBalance = (initialBalance+totalIncome)-totalExpense;

					var runningBalance = initialBalance;
					// Calculate running balance for each row
					json.data.forEach(function(row) {
						var income = 0; var expense = 0;
						if(row.type == 2)
						{
							var expense = parseFloat(row.amount) || 0;
						}
						if(row.type == 1)
						{
							var income = parseFloat(row.amount) || 0;
						}

						
						row.running_balance = runningBalance + parseFloat(income) - parseFloat(expense);
						runningBalance = runningBalance + parseFloat(income) - parseFloat(expense);
					});


					// Add the summary row as the first row in the data array
					json.data.unshift({
						name: '',
						category: '',
						subcategory: '',
						reference: '',
						description: '',
						transactiondate: '',
						initial_balance: initialBalance,
						income: '<p class="text-green netincome"><b>RS'+totalIncome+'</b></p>',
						expense: '<p class="text-red netincome"><b>RS'+totalExpense+'</b></p>',
						running_balance: '<b>RS'+runningBalance+'</b>'
					});
					return json.data;
				}
			},

			// drawCallback: function(settings) {
			// 	var api = this.api();
			// 	var totalIncome = api.column(6, {page:'current'}).data().sum();
			// 	var totalExpense = api.column(7, {page:'current'}).data().sum();
			// 	$(api.table().footer()).html(
			// 		'<tr>' +
			// 			'<th colspan="6">Initial Balance</th>' +
			// 			'<th id="initialBalance"></th>' +
			// 		'</tr>' +
			// 		'<tr>' +
			// 			'<th colspan="6">Total Income</th>' +
			// 			'<th id="totalIncome">' + totalIncome.toFixed(2) + '</th>' +
			// 		'</tr>' +
			// 		'<tr>' +
			// 			'<th colspan="6">Total Expense</th>' +
			// 			'<th id="totalExpense">' + totalExpense.toFixed(2) + '</th>' +
			// 		'</tr>'
			// 	);
			// },
			
			columns: [
            { data: 'name', name: 'name' },
            { data: 'category', name: 'category' },
            { data: 'subcategory', name: 'subcategory' },
            { data: 'reference', name: 'reference' },
            { data: 'description', name: 'description' },
            { data: 'transactiondate', name: 'transactiondate' },
			{ data: null, name: 'initial_balance', render: function(data, type, row) {
                return calculateInitialBalance(data);
            }},
            { data: 'income', name: 'income' },
            { data: 'expense', name: 'expense' },
			{ data: 'running_balance', name: 'running_balance' }
        ],

		drawCallback: function(settings) {
            var api = this.api();
            var $firstRow = $(api.rows().nodes()).first();
            $firstRow.addClass('fixed-row');
        },
			
			buttons: [
            {
                extend: 'copy',
                text: 'Copy',
                title: '<?php echo trans('lang.account_transaction_report');?>',
                className: 'btn btn-sm btn-fill',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                }
            },
            {
                extend: 'csv',
                text: 'CSV',
                title: '<?php echo trans('lang.account_transaction_report');?>',
                className: 'btn btn-sm btn-fill',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                title: '<?php echo trans('lang.account_transaction_report');?>',
                className: 'btn btn-sm btn-fill',
                orientation: 'landscape',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
                },
                customize: function(doc) {
                    doc.styles.tableHeader.alignment = 'left';
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                }
            },
            {
                extend: 'print',
                title: '<?php echo trans('lang.account_transaction_report');?>',
                text: 'Print',
                className: 'btn btn-sm btn-fill',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9]
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

	//accountbalance
	$.ajax({
        type: "GET",
        url: "{{ url('home/accountbalance')}}",
        dataType: "json",
        success: function (data) {
			var label = [];
			var amount = [];			
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
						label: '<?php echo trans('lang.account');?>',
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
	
	
	function calculateRunningBalance(transaction) {
        var income = parseFloat(transaction.income) || 0;
        var expense = parseFloat(transaction.expense) || 0;

        runningBalance += (income - expense);
        return runningBalance.toFixed(2);
    }
	
	function calculateInitialBalance(transaction)
	{
		var initialBalance = parseFloat(transaction.initial_balance) || 0;
		return '<b>RS'+initialBalance+'</b>';
	}

} );


</script>
@endsection