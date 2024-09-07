@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-11">
				 <div class="card">
					<div class="header">
						<h4 class="title">User Balance Report</h4>
					</div>
					<form action="" method="POST" id="form" autocomplete="off">
						<div class="content">
							<div class="row">
								<div class="col-md-4 mt-4 mt-md-2">
								 <label>Select a User</label>
								 <select id="userid" class="form-control" name="userid">
                                    <option value="">Select a User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->userid }}">{{$user->name}}</option>
                                    @endforeach
								 </select>
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
						<h4 class="title">User Balance Report</h4>
                    </div>
                    <div class="content">
					<div class="table-responsive">
						<table id="data" class="table" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Username</th>
									<th>Account</th>
									<th>Account Balance</th>
                                    <th>Total Expense</th>
									<th>Remaining Balance</th>
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

<script>


$(document).ready(function() {
	
	
	//get data
    var table = $('#data').DataTable( {
			bFilter : false,
            ajax: {
				url : "{{ url('reports/getuserbalancereportdata')}}",
				data: function (d) {
					d.userid = $('select[name=userid]').val();
				},
			},
			
			columns: [
				{ data: 'username', name:'username'},
				{ data: 'accountname', name:'accountname'},
				{ data: 'accountbalance', name:'accountbalance'},
				{ data: 'totalexpense', name:'totalexpense'},
                { data: 'remainingbalance', name:'remainingbalance'}		
			],

			buttons: [
				{
					extend: 'copy',
					text:   'Copy',
					title: 'User Balance Report',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV ',
					title: 'User Balance Report',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF',
					title: 'User Balance Report',
					className: 'btn btn-sm btn-fill ',
					orientation:'landscape',
					exportOptions: {
						columns: [0, 1, 2, 3, 4]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: 'User Balance Report',
					text:   'Print',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4 ]
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