@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">

      
            <div class="col-lg-12 col-md-11">
                <div class="card">

                	<div class="header">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="pb-3 pb-md-0">
                            <input type="hidden" value={{ $id }} id="idbank"/>
                            <h4 class="title bankname"></h4>
                            <h5 class="accountnumber mb-0"></h5>
                            </div>
                            <div class="">
                            <div class="d-flex flex-row">
                               <a href="#'" data-toggle="modal" data-target="#delete" class="btn btn-sm btn-fill"><i class="ti-trash"></i> <?php echo trans('lang.delete_account');?></a>
                            </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="content">
                    	<div class="row">
                    		<div class="col-lg-4">
                    			
							<h4 class="mt-0 mb-0"><span class="currency text-success"></span><span class="accountbalance text-success"></span></h4>
							<small><?php echo trans('lang.account_balance');?></small>
							</div>
							<div class="col-lg-8 mt-md-0 mt-3">
								<canvas  id="accountgraph" height="50"></canvas>
							</div>
                    	</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-11">
                <div class="card">
                    <div class="header">
						<div class="row">
							<div class="col-lg-6">
							<h5 class="title"><?php echo trans('lang.account_transaction_report');?></h5>
							</div>
							
						</div>
                    </div>
                    <div class="content">
                    	<div class="table-responsive">
                    	<table id="data" class="table" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><?php echo trans('lang.date');?></th>	
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.reference');?></th>
									<th><?php echo trans('lang.description');?></th>
									<th><?php echo trans('lang.income');?></th>
									<th><?php echo trans('lang.expense');?></th>										
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

<!--delete data -->
 <div class="modal fade" id="delete" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
      	 <div class="modal-header">
                <h5 class="modal-title"><?php echo trans('lang.delete');?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
        <div class="modal-body">
		<form action="" method="POST">
		  <p class="text-danger"><?php echo trans('lang.delete_warning');?></p>	
          <p><?php echo trans('lang.delete_confirm');?></p>
		  <input type="hidden" value={{ $id }} name="iddelete" id="iddelete"/>
		  </form>
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?php echo trans('lang.close');?></button>
            <input type="submit" class="btn btn-sm btn-fill btn-info" id="dodelete" value="<?php echo trans('lang.delete');?>"/>
        </div>
      </div>
    </div>
  </div>

  
</div>
<script src="{{ asset('js/general.js') }}"></script>
<script src="{{ asset('js/account.js') }}"></script>	  
<script>

$(document).ready(function() {
    
    var id = $("#idbank").val();
	$.ajax({
        type: "GET",
        url: "{{ url('account/getdatadetail/'.$id)}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			console.log(html);
			$(".accountnumber").html(html.accountnumber);
			$(".bankname").html(html.name);
			$(".accountbalance").html(html.balance);
			
        },
    });
   
   $.ajax({
        type: "GET",
        url: "{{ url('account/accountbalancebymonth/'.$id)}}",
        dataType: "json",
        data: "{}",
        success: function (data) {
			var cincomevsexpense = document.getElementById("accountgraph");
			var incomevsexpense = new Chart(cincomevsexpense, {
				type: 'line',
				legendPosition: 'bottom',
				data: {
					labels: ["<?php echo trans('lang.jan');?>", "<?php echo trans('lang.feb');?>", "<?php echo trans('lang.mar');?>", "<?php echo trans('lang.apr');?>", "<?php echo trans('lang.may');?>", "<?php echo trans('lang.jun');?>", "<?php echo trans('lang.jul');?>", "<?php echo trans('lang.aug');?>", "<?php echo trans('lang.sep');?>", "<?php echo trans('lang.oct');?>", "<?php echo trans('lang.nov');?>", "<?php echo trans('lang.dec');?>"],
					datasets: [
					{
						label: "<?php echo trans('lang.balance');?>",
						data: [data.ijan, data.ifeb, data.imar, data.iapr, data.imay, data.ijun, data.ijul, data.iags, data.isep, data.iokt, data.inov, data.ides],
						backgroundColor: '#28a745',
						borderColor: '#28a745',
						borderWidth: 3
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
									return $('.currency').val()+tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
									return  $('.currency').val()+value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
								  } else {
									return $('.currency').val() + value;
								  }
								}
							}
						}]
					}
				}
			});
			
        },
    });

   //load data
   //get data
    var table = $('#data').DataTable( {
			
			bFilter : false,
            ajax: {
				url : "{{ url('account/getaccounttransaction/'.$id)}}",
			},
			
			columns: [
				{ data: 'transactiondate', name:'transactiondate'},
				{ data: 'name', name:'name'},
				{ data: 'category', name:'category'},
				{ data: 'subcategory', name:'subcategory'},
				{ data: 'reference', name:'reference'},				
				{ data: 'description', name:'description'},		
				{ data: 'income', name:'income'},
				{ data: 'expense', name:'expense'}
			],
			
			buttons: [
				{
					extend: 'copy',
					text:   'Copy',
					title: '<?php echo trans('lang.account_transaction_report');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV',
					title: '<?php echo trans('lang.account_transaction_report');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF',
					title: '<?php echo trans('lang.account_transaction_report');?>',
					className: 'btn btn-sm btn-fill ',
					orientation:'landscape',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5, 6, 7]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.account_transaction_report');?>',
					text:   'Print',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
					}
				}
			]
    } );
	
	
} );
	//delete function
	$("#dodelete").click(function(e){
		
		var id=$("#iddelete").val();
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: "{{ url('account/delete')}}",
            data: {iddelete:id},
            dataType: "JSON",
            success: function(data) {
				//$("#message").html(data);
				$("#message3").css({'display':"block"});
				$('#delete').modal('hide');
				location.href="{{ url('account')}}";
            }
		});
	});
	




</script>
@endsection