@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-11">
				 <div class="card">
					<div class="header">
						<h4 class="title">General Report</h4>
					</div>
					<form action="" method="POST" id="form" autocomplete="off">
						<div class="content">
							<div class="row">
                                <div class="col-md-4 mt-4 mt-md-2">
								 <label>Account</label>
								 <select id="account" class="form-control" name="account">
								 <option value="">Select a Account</option>
                                 @foreach($accounts as $account)
                                    <option value="{{ $account->accountid }}">{{ $account->name }}</option>
                                 @endforeach
								 </select>
								</div>	
								<div class="col-md-4 mt-4 mt-md-2">
								 <label><?php echo trans('lang.category');?></label>
								 <select id="incomecategory" class="form-control" name="category" data-url="{{ url('expensecategory/getdata')}}">
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
                                <div class="col-md-4 mt-4 mt-md-2">
								 <label>User</label>
								 <select id="user" class="form-control" name="user">
								 <option value="">Select a User</option>
                                 @foreach($users as $user)
                                    <option value="{{ $user->userid }}">{{ $user->name }}</option>
                                 @endforeach
								 </select>
								</div>
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

									<th>Username</th>
									<th><?php echo trans('lang.account');?></th>
									<th>Start Date</th>
									<th>End Date</th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th>Total Income</th>
									<th>Total Expense</th>
									<th>Balance</th>											
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
		
    </div>
</div>	

<script src="{{ asset('js/general.js') }}"></script>
<script src="{{ asset('js/expense.js') }}"></script>
<script src="{{ asset('js/account.js') }}"></script>
<script src="{{ asset('js/category.js') }}"></script>

<script>


$(document).ready(function() {
	
    $('#user').select2();
    $('#account').select2();



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
            info: false, 
			paging: false,
			bFilter : false,
            ajax: {
				url : "{{ url('reports/getdataforgeneralreport')}}",
				data: function (d) {
					d.type 		= '2';
					d.category = $('select[name=category]').val();
					d.user = $('select[name=user]').val();
                    d.account = $('select[name=account]').val();
					d.subcategory = $('select[name=subcategory]').val();
					d.fromdate = $('input[name=fromdate]').val();
					d.todate = $('input[name=todate]').val();
				},
			},
			
			columns: [
				{ data: 'username', name:'username'},
                { data: 'accountname', name:'accountname'},
                { data: 'start_date', name: 'start_date'},
                { data: 'end_date', name: 'end_date'},
				{ data: 'categoryname', name:'categoryname'},
				{ data: 'subcategoryname', name:'subcategoryname'},
				{ data: 'total_income', name:'total_income'},
				{ data: 'total_expense', name:'total_expense'},
                { data: 'remaining_balance', name:'remaining_balance'}
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
	
		
} );


</script>
@endsection