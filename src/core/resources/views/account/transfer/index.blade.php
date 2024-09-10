@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
	
        <div class="row">
			<!--add data-->
      
            <div class="col-lg-12 col-md-11">
                <div class="card">
                	<div class="header">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="pb-3 pb-md-0">
                            <h4 class="title">Internal Transfer List</h4>
                            </div>
                            <div class="">
                            <div class="d-flex flex-row">
                                <a href="#'" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> Internal Transfer</a>
                            </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="content">
                    	
					<div id="message2" style="display:none" class="alert alert-success"><?php echo trans('lang.data_added');?></div>
					<div id="message3" style="display:none" class="alert alert-success"><?php echo trans('lang.data_deleted');?></div>
					<div id="message4" style="display:none" class="alert alert-success"><?php echo trans('lang.data_updated');?></div>
						<div class="table-responsive">
						<table id="data" class="table" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Transfer ID</th>
									<th>From Account</th>
									<th>To Account</th>
									<th>Amount</th>
									<th>Transfer Date</th>
                                    <th>Transfer By</th>
									<th>Description</th>
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
<!--add new data -->
<div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
          	<form action="#" id="formadd"  autocomplete="off">
          		<div class="modal-header">
                <h5 class="modal-title">Internal Transfer</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
                
                <div class="form-group">
                  <label><small class="req text-danger">* </small>Amount</label>
				  <div class="input-group">
						<span class="input-group-addon currency" id="currency" style="border: 1px solid #cecece;"></span>                                   
						<input class="form-control number" required placeholder="Amount" id="amount" name="amount" type="text" >
					</div>
                </div>
                <div class="form-group">
                  <label><small class="req text-danger">* </small>From Account</label>
				  <select id="fromaccount" class="form-control" name="fromaccount" required>
				  	<option value="">Select a From Account</option>
					@foreach($accounts as $account)
						<option value="{{ $account['accountid'] }}">{{$account['name']}}</option>
					@endforeach
				  </select>
                </div>
                <div class="form-group">
                  <label><small class="req text-danger">* </small>To Account</label>
				  <select id="toaccount" class="form-control" name="toaccount" required>
				  	<option value="">Select a To Account</option>
					@foreach($accounts as $account)
                    <option value="{{ $account['accountid'] }}">{{$account['name']}}</option>
					@endforeach
				  </select>
                </div>

				<div class="form-group">
                  <label><small class="req text-danger"> </small>Description</label>
				  <input type="text" id="description" name="description" class="form-control" />
                </div>

              </div>
              <div class="modal-footer">
								<button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?php echo trans('lang.close');?></button>
                <input type="submit" class="btn btn-sm btn-fill btn-info" id="save" value="<?php echo trans('lang.save');?>"/>
              </div>
            </form>
          </div>
        </div>
      </div>

<script src="{{ asset('js/general.js') }}"></script>
<script src="{{ asset('js/account.js') }}"></script>
<script>


$(document).ready(function() {

   
	
   //load data
    $('#data').DataTable( {
          ajax: "{{ url('internaltransfer/getdata')}}",
					columns: [
						{ data: 'transferid', orderable: false, searchable: false},
						{ data: 'fromaccount'},
						{ data: 'toaccount'},
						{data: 'amount'},
						{ data: 'transferdate'},
						{ data: 'transferby'},
						{ data: 'description'}
					],
			buttons: [
				{
					extend: 'copy',
					text:   'Copy ',
					title: 'Internal Transfer List',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5, 6 ]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV ',
					title: 'Internal Transfer List',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5, 6 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF ',
					title: 'Internal Transfer List',
					orientation:'landscape',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5, 6 ]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: 'Internal Transfer List',
					text:   'Print ',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5, 6 ]
					}
				}
			]
    } );



   //do save expense
   $("#formadd").validate({
      submitHandler: function(forms) {
				var amount 			= $("#amount").val();
				var fromaccount = $("#fromaccount").val();
				var toaccount = $("#toaccount").val();
				var description = $("#description").val();

				$.ajax({
					type: "POST",
		            url: "{{ url('internaltransfer/save')}}",
		            data: {amount:amount,fromaccount:fromaccount,toaccount:toaccount,description:description},
		            dataType: "JSON",
		            success: function(data) {
									$("#message2").css({'display':"block"});
									$('#add').modal('hide');
									window.setTimeout(function(){location.reload()},2000)
					      }
				});
	      return false;
	     }
  });


  //do edit expense
   
     
	
	
} );
	//delete function
	
	

		//for get id to modal

		
		//for get id to modal edit

		
		

</script>
@endsection