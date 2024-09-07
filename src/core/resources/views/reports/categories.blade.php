@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-11">
				 <div class="card">
					<div class="header">
						<h4 class="title">Category Report</h4>
					</div>
					<form action="" method="POST" id="form" autocomplete="off">
						<div class="content">
                        <div class="row">
								<!-- <div class="col-lg-4 mt-4 mt-md-2">
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
                                </div> -->
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
									<th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Total Expense</th>
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
				url : "{{ url('reports/getcategorydata')}}",
				data: function (d) {
					d.userid = $('select[name=userid]').val();
				},
			},
			
			columns: [
				{ data: 'categoryname', name:'categoryname'},
				{ data: 'subcategoryname', name:'subcategoryname'},
				{ data: 'totalexpense', name:'totalexpense'},
			],

			buttons: [
				{
					extend: 'copy',
					text:   'Copy',
					title: 'Category Report',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 0, 1, 2]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV ',
					title: 'Category Report',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF',
					title: 'Category Report',
					className: 'btn btn-sm btn-fill ',
					orientation:'landscape',
					exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: 'Category Report',
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