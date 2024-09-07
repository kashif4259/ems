 @extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-11">
				 <div class="card">
					<div class="header">
						<h4 class="title"><?php echo trans('lang.income_monthly_report');?> (<?php echo date("Y");?>)</h4>
					</div>
					<div class="content">
						<div class="table-responsive">
						<table id="monthlyreportsincome" class="table"  cellspacing="0" width="100%">
							<thead >
                                <tr>
                                    <th class="bold"><b><?php echo trans('lang.category');?></b></th>
                                    <th class="bold"><b><?php echo trans('lang.jan');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.feb');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.mar');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.apr');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.may');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.jun');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.jul');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.aug');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.sep');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.oct');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.nov');?></b></th>  
									<th class="bold"><b><?php echo trans('lang.dec');?></b></th>                                        
									<th class="bold"><b><?php echo trans('lang.total');?></b></th>   
								</tr>
                            </thead>
							
							<tbody style="font-size:12px;">
							
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
    var table = $('#monthlyreportsincome').DataTable( {
			
			processing: true,
			serverSide: true,
			bFilter : false,
            ajax: {
				url : "{{ url('reports/getincomemonthly')}}",
				
			},
			
			columns: [
				{ data: 'category', name:'category'},
				{ data: 'ijan', name:'ijan'},
				{ data: 'ifeb', name:'ifeb'},
				{ data: 'imar', name:'imar'},				
				{ data: 'iapr', name:'iapr'},		
				{ data: 'imay', name:'imay'},
				{ data: 'ijun', name:'ijun'},
				{ data: 'ijul', name:'ijul'},
				{ data: 'iags', name:'iags'},
				{ data: 'isep', name:'isep'},
				{ data: 'iokt', name:'iokt'},
				{ data: 'inov', name:'inov'},
				{ data: 'idec', name:'idec'},
				{ data: 'total', name:'total'}
			],
			buttons: [
				{
					extend: 'copy',
					text:   'Copy',
					title: '<?php echo trans('lang.income_monthly_report');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV ',
					title: '<?php echo trans('lang.income_monthly_report');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
					}
				},
				{
					extend:'pdf',
					text:   'PDF',
					title: '<?php echo trans('lang.income_monthly_report');?>',
					className: 'btn btn-sm btn-fill ',
					orientation:'landscape',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.income_monthly_report');?>',
					text:   'Print',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
					}
				}
			]
    } );
	

	
		
} );



</script>
@endsection