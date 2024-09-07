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
                            <h4 class="title"><?php echo trans('lang.account_list');?></h4>
                            </div>
                            <div class="">
                            <div class="d-flex flex-row">
                                <a href="#'" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?php echo trans('lang.add_new_account');?></a>
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
									<th><?php echo trans('lang.account_id');?></th>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.opening_balance');?></th>
									<th><?php echo trans('lang.description');?></th>
									<th><?php echo trans('lang.action');?></th>
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
                <h5 class="modal-title"><?php echo trans('lang.add_new_account');?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
                <div class="form-group">
                  <label><small class="req text-danger">* </small><?php echo trans('lang.name');?></label>
                  <input type="text" class="form-control" name="name"  id="name" placeholder="<?php echo trans('lang.name');?>" required>
                </div>
                <div class="form-group">
                  <label><small class="req text-danger">* </small><?php echo trans('lang.opening_balance');?></label>
				  <div class="input-group">
						<span class="input-group-addon currency" id="currency" style="border: 1px solid #cecece;"></span>                                   
						<input class="form-control number" required placeholder="<?php echo trans('lang.opening_balance');?>" id="balance" name="balance" type="text" >
					</div>
                </div>
                <div class="form-group">
                  <label><small class="req text-danger">* </small><?php echo trans('lang.account_number');?></label>
				  <input class="form-control" required placeholder="<?php echo trans('lang.account_number');?>" id="accountnumber" name="accountnumber" type="text">
                </div>
				<div class="form-group">
                  <label><small class="req text-danger">* </small>Assign User</label>
				  <select id="accountuser" class="form-control" name="accountuser" required>
				  	<option value="">Select a User</option>
					@foreach($users as $user)
						<option value="{{ $user->userid }}">{{$user->name}}</option>
					@endforeach
				  </select>
                </div>
				 <div class="form-group">
                  <label><?php echo trans('lang.description');?></label>
                  <textarea class="form-control" name="description" id="description" placeholder="<?php echo trans('lang.description');?>"></textarea>
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
		  <input type="hidden" value="" name="iddelete" id="iddelete"/>
		  </form>
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?php echo trans('lang.close');?></button>
          <input type="submit" class="btn btn-sm btn-fill btn-info" id="dodelete" value="<?php echo trans('lang.delete');?>"/>
        </div>
      </div>
    </div>
  </div>


 <!--edit data -->
<div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="#" id="formedit"  autocomplete="off">
              <div class="modal-header">
                <h5 class="modal-title"><?php echo trans('lang.edit');?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
                <div class="form-group">
                  <label><small class="req text-danger">* </small><?php echo trans('lang.name');?></label>
                  <input type="text" class="form-control" name="editname"  id="editname" placeholder="<?php echo trans('lang.name');?>" required>
                </div>
                <div class="form-group">
                  <label><small class="req text-danger">* </small><?php echo trans('lang.opening_balance');?></label>
                   <div class="input-group">
						<span class="input-group-addon currency" id="editcurrency" style="border: 1px solid #cecece;"></span>                                   
						<input class="form-control number" required placeholder="<?php echo trans('lang.opening_balance');?>" id="editbalance" name="editbalance" type="text" placeholder="Amount">
					</div>
                </div>
                <div class="form-group">
                  <label><small class="req text-danger">* </small><?php echo trans('lang.account_number');?></label>
				  <input class="form-control" required placeholder="<?php echo trans('lang.account_number');?>" id="editaccountnumber" name="editaccountnumber" type="text">
                </div>
				<div class="form-group">
                  <label><small class="req text-danger">* </small>Assign User</label>
				  <select id="editaccountuser" class="form-control" name="editaccountuser" required>
				  	<option value="">Select a User</option>
					@foreach($users as $user)
						<option value="{{ $user->userid }}">{{$user->name}}</option>
					@endforeach
				  </select>
                </div>
				 <div class="form-group">
                  <label><?php echo trans('lang.description');?></label>
                  <textarea class="form-control" name="editdescription" id="editdescription" placeholder="<?php echo trans('lang.description');?>"></textarea>
                </div>
              </div>
              <div class="modal-footer">
								<input type="hidden" value="" name="id" id="idedit"/>
                <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?php echo trans('lang.close');?></button>
                <input type="submit" class="btn btn-sm btn-fill btn-info" value="<?php echo trans('lang.save');?>"/>
              </div>
            </form>
          </div>
        </div>
      </div> 
  
</div>	  
<script src="{{ asset('js/general.js') }}"></script>
<script src="{{ asset('js/account.js') }}"></script>
<script>


$(document).ready(function() {

   
	
   //load data
    $('#data').DataTable( {
          ajax: "{{ url('account/getdata')}}",
					columns: [
						{ data: 'accountid', orderable: false, searchable: false},
						{ data: 'name'},
						{data: 'balance'},
						{ data: 'description'},
						{data: 'action',  orderable: false, searchable: false}
					],
			buttons: [
				{
					extend: 'copy',
					text:   'Copy ',
					title: '<?php echo trans('lang.account_list');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 1, 2, 3 ]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV ',
					title: '<?php echo trans('lang.account_list');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [  1, 2, 3 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF ',
					title: '<?php echo trans('lang.account_list');?>',
					orientation:'landscape',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [  1, 2, 3 ]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.account_list');?>',
					text:   'Print ',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 1, 2, 3 ]
					}
				}
			]
    } );



   //do save expense
   $("#formadd").validate({
      submitHandler: function(forms) {
	      var name 					= $("#name").val();
				var balance 			= $("#balance").val();
				var description 	= $("#description").val();
				var accountnumber = $("#accountnumber").val();
				var accountuser = $("#accountuser").val();
				
				$.ajax({
					type: "POST",
		            url: "{{ url('account/save')}}",
		            data: {name:name,balance:balance,description:description,accountnumber:accountnumber,accountuser:accountuser},
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
   $("#formedit").validate({
      submitHandler: function(forms) {
	      var name 					= $("#editname").val();
				var balance 			= $("#editbalance").val();
				var description 	= $("#editdescription").val();
				var accountnumber = $("#editaccountnumber").val();
				var id 						= $("#idedit").val();
				var editaccountuser = $("#editaccountuser").val();
				$.ajax({
					type: "POST",
		            url: "{{ url('account/edit')}}",
		            data: {id:id,name:name,balance:balance,description:description,accountnumber:accountnumber,editaccountuser:editaccountuser},
		            dataType: "JSON",
		            success: function(data) {
										$("#message4").css({'display':"block"});
										$('#edit').modal('hide');
										window.setTimeout(function(){location.reload()},2000)
		            }
				});
	      return false;
	     }
  }); 
     
	
	
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
				window.setTimeout(function(){location.reload()},2000)
            }
		});
	});
	

		//for get id to modal

		$('#delete').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
            $("#iddelete").val(id);
        });
		
		//for get id to modal edit

		$('#edit').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
            
			$.ajax({
				type: "POST",
				url: "{{ url('account/getedit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					$("#idedit").val(id);
					$("#editname").val(data.message[0].name);
					$("#editbalance").val(data.message[0].balance);
					$("#editdescription").val(data.message[0].description);
					$("#editaccountnumber").val(data.message[0].accountnumber);
					$("#editaccountuser option").each(function() {
					// Check if the value of the option matches the user ID
					if ($(this).val() == data.message[0].user_id) {
						// Set the selected attribute if there's a match
						$(this).prop("selected", true);
					}
				});
				}
			});
		
		
        });
		

</script>
@endsection