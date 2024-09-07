@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
		<div class="row">

			<div class="col-md-4 pb-2">
                <div class="d-flex align-items-stretch">
                    <div class="home-icon-content background-green color-white p-3 rounded flex-fill">
                        <p class="home-icon mb-0"> <i class="ti-user"></i></p>
                    </div>
                    <div class="background-grey p-3 rounded flex-fill">
                        <p class="transactiontitle"></span><span id="totalusers"></span></p> 
                        <p class="small-font mb-0"><?php echo trans('lang.total_user');?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 pb-2">
                <div class="d-flex align-items-stretch">
                    <div class="home-icon-content background-green color-white p-3 rounded flex-fill">
                        <p class="home-icon mb-0"> <i class="ti-bolt"></i></p>
                    </div>
                    <div class="background-grey p-3 rounded flex-fill">
                        <p class="transactiontitle"></span><span id="activeuser"></span></p> 
                        <p class="small-font mb-0"><?php echo trans('lang.active_user');?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 pb-2">
                <div class="d-flex align-items-stretch">
                    <div class="home-icon-content background-green color-white p-3 rounded flex-fill">
                        <p class="home-icon mb-0"> <i class="ti-pulse"></i></p>
                    </div>
                    <div class="background-grey p-3 rounded flex-fill">
                        <p class="transactiontitle"></span><span id="inactiveuser"></span></p> 
                        <p class="small-font mb-0"><?php echo trans('lang.inactive_user');?></p>
                    </div>
                </div>
            </div>


        </div>
		
        <div class="row">
			<!--add data-->
      
            <div class="col-lg-12 col-md-11 pt-4">
                <div class="card">

                	<div class="header">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="pb-3 pb-md-0">
                            <h4 class="title"><?php echo trans('lang.user_list');?></h4>
                            </div>
                            <div class="">
                            <div class="d-flex flex-row">
                                <a href="#'" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?php echo trans('lang.add_new_user');?></a>
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
									<th>User ID</th>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.email');?></th>
									<th><?php echo trans('lang.role');?></th>
									<th><?php echo trans('lang.phone');?></th>
									<th><?php echo trans('lang.status');?></th>
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
<!--delete data -->
<div id="getdelete" data-url="{{ url('settings/deleteuser')}}">
    @include('layouts.delete')
</div>
<!-- delete data -->
<div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="#" id="formadd"  autocomplete="off">
              <div class="modal-header">
                <h5 class="modal-title"><?php echo trans('lang.add_new_user');?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
			  <div id="message5" style="display:none" class="alert alert-warning"><?php echo trans('lang.email_already');?></div>
              <div class="modal-body">
			  <div class="row">
				<div class="col-lg-6">
					<div class="form-group">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.full_name');?></label>
					  <input type="text" class="form-control" name="name"  required id="name" placeholder="<?php echo trans('lang.full_name');?>">
					</div>
					<div class="form-group">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.email');?></label>
					  <input type="email"  class="form-control" name="email" required id="email"  placeholder="<?php echo trans('lang.email');?>">
					</div>
					<div class="form-group">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.password');?></label>
					  <input type="password"  class="form-control" name="password" id="password"  placeholder="<?php echo trans('lang.password');?>">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
					  <label><?php echo trans('lang.phone');?></label>
					  <input type="text"  class="form-control" name="phones" id="phones"  placeholder="<?php echo trans('lang.phone');?>">
					</div>
					<div class="form-group">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.role');?></label>
					  <select name="role" id="role" class="form-control" required>
					  <?php if(Auth::user()['role'] !== 'Staff'){?>
					  <option value="Administrator">Administrator</option>
					  <?php }?>
					  <option value="Staff">Staff</option>
					  </select>
					  <label for="role" class="error"></label>
					</div>
					<div class="form-group">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.status');?></label>
					  <select name="status" id="status" class="form-control" required>
					  <option value="Active">Active</option>
					  <option value="Inactive">Inactive</option>
					  </select>
					  <label for="status" class="error"></label>
					</div>
				</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<p><b><?php echo trans('lang.module_permission');?></b></p>
						<div class="col-lg-12">
							<div class="maincheckbox">
							</div>
						</div>
					</div>
				</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?php echo trans('lang.close');?></button>
                <input type="submit" class="btn btn-sm btn-fill btn-info"  value="<?php echo trans('lang.save');?>"/>
              </div>
            </form>
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
				<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
					  <label><?php echo trans('lang.full_name');?></label>
					  <input type="text" class="form-control" name="editname"  id="editname" required placeholder="<?php echo trans('lang.full_name');?>">
					</div>
					<div class="form-group">
					  <label><?php echo trans('lang.email');?></label>
					  <input type="email"  class="form-control" name="editemail" id="editemail" required placeholder="<?php echo trans('lang.email');?>">
					</div>
					<div class="form-group">
					  <label><?php echo trans('lang.password');?></label>
					  <input type="password"  class="form-control" name="editpassword" id="editpassword"  placeholder="<?php echo trans('lang.password');?>">
					  <p class="text-help"><?php echo trans('lang.note_password');?></p>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
					  <label><?php echo trans('lang.phone');?></label>
					  <input type="text"  class="form-control" name="editphone" id="editphone"  placeholder="<?php echo trans('lang.phone');?>">
					</div>
					<div class="form-group">
					  <label><?php echo trans('lang.role');?></label>
					  <select name="editrole" id="editrole" class="form-control" required>
					  <option value="Administrator">Administrator</option>
					  <option value="Staff">Staff</option>
					  </select>
					</div>
					<div class="form-group">
					  <label><?php echo trans('lang.status');?></label>
					  <select name="editstatus" id="editstatus" class="form-control" required>
					  <option value="Active">Active</option>
					  <option value="Inactive">Inactive</option>
					  </select>
					</div>
				</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<p><b><?php echo trans('lang.module_permission');?></b></p>
						<div class="col-lg-12">
							<div class="maincheckbox2">
							</div>
						</div>
					</div>
				</div>
              </div>
              <div class="modal-footer">
				<input type="hidden" value="" name="id" id="idedit"/>
                <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?php echo trans('lang.close');?></button>
                <input type="submit" class="btn btn-sm btn-fill btn-info"  value="<?php echo trans('lang.save');?>"/>
              </div>
            </form>
          </div>
        </div>
      </div> 

</div>	
<script src="{{ asset('js/general.js') }}"></script>  
<script>

$(document).ready(function() {

	//counting users
	$.ajax({
        type: "GET",
        url: "{{ url('settings/totalusers')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
			var objs = html;
			$("#totalusers").html(objs.totaluser);
			
			$("#activeuser").html(objs.activeuser[0].user_count);
			
			if(objs.inactiveuser.length > 0){
				$("#inactiveuser").html(objs.inactiveuser[0].user_count);
			}else{
				$("#inactiveuser").html('0');
			}
			
        },
    });
	
	//get role/menu access
	$.ajax({
        type: "GET",
        url: "{{ url('settings/getrole')}}",
        dataType: "json",
        data: "{}",
        success: function (html) {
        	console.log(html);
			var objs = html;
			var options='';
			var options2='';
			$.each(objs, function(index, object) {
					options += '<div class="checkbox">'+
						  '<label><input type="checkbox" id="chk'+object.roleid+'" class="access" name="access[]" id="access" value="' + object.roleid + '">'+object.name+'</label>'+
							'</div>';
				});
				$('.maincheckbox').html(options);
				
			$.each(objs, function(index, object) {
					options2 += '<div class="checkbox">'+
						  '<label><input type="checkbox" id="echk'+object.roleid+'" class="access" name="access[]" id="access" value="' + object.roleid + '">'+object.name+'</label>'+
							'</div>';
				});
				$('.maincheckbox2').html(options2);	
        },
    });
   
   
	//populate data to table
    $('#data').DataTable( {
			

            ajax: "{{ url('settings/getuser')}}",
			columns: [
				{ data: 'userid', orderable: false, searchable: false, visible: false},
				{ data: 'name'},
				{data: 'email'},
				{ data: 'role'},
				{ data: 'phone'},
				{ data: 'status'},
				{data: 'action',  orderable: false, searchable: false}
			],
			buttons: [
				{
					extend: 'copy',
					text:   'Copy',
					title: '<?php echo trans('lang.user_list');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5 ]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV ',
					title: '<?php echo trans('lang.user_list');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF',
					title: '<?php echo trans('lang.user_list');?>',
					orientation:'landscape',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5 ]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					className: 'btn btn-sm btn-fill ',
					title: '<?php echo trans('lang.user_list');?>',
					text:   'Print ',
					exportOptions: {
						columns: [ 1, 2, 3, 4, 5 ]
					}
				}
			]
    } );



    $("#formadd").validate({
     
      submitHandler: function(forms) {
        var name 		= $("#name").val();
		var email 		= $("#email").val();
		var password 	= $("#password").val();
		var phone 		= $("#phones").val();
		var role 		= $("#role").val();
		var status 		= $("#status").val();
		//var dataroles  =  'datarole[]';
		var dataroles   = []; 	
		$("input:checked").each(function() {
		   dataroles.push($(this).val());
		});

        $.ajax({
			type: "POST",
            url: "{{ url('settings/saveuser')}}",
            data: {name:name,password:password,email:email,phone:phone,role:role,status:status,dataroles},
            dataType: "JSON",
            success: function(data) {
				if(data.success=='error'){
					$("#message5").css({'display':"block"});
					window.setTimeout(function(){location.reload()},2000);
				}else{
					$("#message2").css({'display':"block"});
					$('#add').modal('hide');
					window.setTimeout(function(){location.reload()},2000);
				}
            }
		});
        return false;
      }
    });


    $("#formedit").validate({
     
      submitHandler: function(forms) {
       var name 			= $("#editname").val();
		var email 			= $("#editemail").val();
		var phone 			= $("#editphone").val();
		var status 			= $("#editstatus").val();
		var role 			= $("#editrole").val();
		var password 		= $("#editpassword").val();
		var id 				= $("#idedit").val();
		var dataroles   = []; 	
		$("input:checked").each(function() {
		   dataroles.push($(this).val());
		});

        $.ajax({
			type: "POST",
            url: "{{ url('settings/saveprofilebyadmin')}}",
            data: {id:id,name:name,email:email,phone:phone,password:password,status:status,role:role,dataroles},
            dataType: "JSON",
            success: function(data) {
				//$("#message").html(data);
				$("#message4").css({'display':"block"});
				$('#edit').modal('hide');
				window.setTimeout(function(){location.reload()},2000)
            }
		});
        return false;
      }
    });

	
} );


		
		//for get id to modal edit

		$('#edit').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
            
			$.ajax({
				type: "POST",
				url: "{{ url('settings/getuseredit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					var objs =data.role;
					$("#idedit").val(id);
					$("#editname").val(data.user[0].name);
					$("#editemail").val(data.user[0].email);
					$("#editphone").val(data.user[0].phone);
					$("#editstatus").val(data.user[0].status);
					$("#editrole").val(data.user[0].role);
					$.each(objs, function(index, object) {						
							$('#echk'+object.roleid).each(function(){
								if(this.value = object.roleid) {
									$('#echk'+object.roleid).prop( "checked", true );
								}
							});
					});
				}
			});
		
		
        });
		

</script>
@endsection