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
                            <h4 class="title"><?php echo trans('lang.goal_list');?></h4>
                            </div>
                            <div class="">
                            <div class="d-flex flex-row">
                               <a href="#'" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?php echo trans('lang.add_goal');?></a>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="content">
										<div id="message2" style="display:none" class="alert alert-success"><?php echo trans('lang.data_added');?></div>
										<div id="message3" style="display:none" class="alert alert-success"><?php echo trans('lang.data_deleted');?></div>
										<div id="message4" style="display:none" class="alert alert-success"><?php echo trans('lang.data_updated');?></div>
										<div id="msgdeposit" style="display:none" class="alert alert-success"><?php echo trans('lang.deposit_added');?></div>
						<div class="table-responsive">
						<table id="data" class="table" cellspacing="0" width="100%">
							<thead>
								<tr>

									<th>Goal ID</th>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.opening');?></th>
									<th><?php echo trans('lang.target');?></th>
									<th><?php echo trans('lang.remaining');?></th>
									<th><?php echo trans('lang.date');?></th>									
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
<!--delete data -->
<div id="getdelete" data-url="{{ url('goals/delete')}}">
    @include('layouts.delete')
</div>
<!-- delete data -->
 <!--edit data -->
<div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="#" id="formedit" autocomplete="off">
            	<div class="modal-header">
                <h5 class="modal-title"><?php echo trans('lang.edit');?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
			  <div id="messageerror" style="display:none;" class="alert alert-warning"></div>
              <div class="modal-body">
               <div class="row">
					 <div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.name');?></label>
					    <input type="text" class="form-control" name="editname" required  id="editname" placeholder="<?php echo trans('lang.name');?>">
					</div>
					<div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.opening_balance');?></label>
					    <div class="input-group">
							<span class="input-group-addon currency" id="currency"  style="border: 1px solid #cecece;"></span>
								<input class="form-control number" required placeholder="<?php echo trans('lang.opening_balance');?>" id="editopening" name="editopening" type="text" >
						</div>
					</div>
					
				</div>
                <div class="row">
					<div class="form-group col-lg-6">
					<label><small class="req text-danger">* </small><?php echo trans('lang.target');?></label>
						<div class="input-group">
							<span class="input-group-addon currency" id="editcurrency"  style="border: 1px solid #cecece;"></span>
								<input class="form-control number" required placeholder="<?php echo trans('lang.target');?>" id="edittarget" name="edittarget" type="text" >
						</div>
					</div>
					<div class="form-group col-lg-6" id="targetdate">
									<label for="date" class="control-label"> 
									<small class="req text-danger">* </small><?php echo trans('lang.target_date');?></label>
									<div  class="input-group date" data-date-format="mm-dd-yyyy">
										<input id="edate" class="form-control" type="text" value="<?php echo date("Y-m-d");?>" required name="edate"/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
					</div>
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
<!-- Make deposit -->
<div id="deposit" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <form action="#" id="formdeposit" autocomplete="off">
            	<div class="modal-header">
                <h5 class="modal-title"><?php echo trans('lang.deposit');?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
			  <div id="errordeposit" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
			    <div class="row">
					<div class="form-group col-lg-12">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.deposit');?></label>
					    <div class="input-group">
							<span class="input-group-addon currency" id="currency" style="border: 1px solid #cecece;"></span>
								<input class="form-control number" required placeholder="<?php echo trans('lang.deposit');?>" id="depositvalue" name="depositvalue" type="text" >
						</div>
					</div>
				</div>

              </div>
              <div class="modal-footer">
								<input type="hidden" value="" name="id" id="iddeposit"/>
                <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?php echo trans('lang.close');?></button>
                <input type="submit" class="btn btn-sm btn-fill btn-info" value="<?php echo trans('lang.save');?>"/>
              </div>
            </form>
          </div>
        </div>
      </div>  
	  
<!--add new data -->
<div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="#" id="formadd"  autocomplete="off">
            	<div class="modal-header">
                <h5 class="modal-title"><?php echo trans('lang.add_goal');?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
            
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
			    <div class="row">
					 <div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.name');?></label>
					    <input type="text" class="form-control" name="name" required  id="name" placeholder="<?php echo trans('lang.name');?>">
					</div>
					<div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.opening_balance');?></label>
					    <div class="input-group">
							<span class="input-group-addon currency"  id="currency" style="border: 1px solid #cecece;"></span>
								<input class="form-control number" required placeholder="<?php echo trans('lang.opening_balance');?>" id="opening" name="opening" type="text" >
						</div>
					</div>
					
				</div>
                <div class="row">
					<div class="form-group col-lg-6">
					<label><small class="req text-danger">* </small><?php echo trans('lang.target');?></label>
						<div class="input-group">
							<span class="input-group-addon currency" id="goalcurrency"  style="border: 1px solid #cecece;"></span>
								<input class="form-control number" required placeholder="<?php echo trans('lang.target');?>" id="target" name="target" type="text" >
						</div>
					</div>
					<div class="form-group col-lg-6" id="targetdate">
									<label for="date" class="control-label"> 
									<small class="req text-danger">* </small><?php echo trans('lang.target_date');?></label>
									<div  class="input-group date" data-date-format="mm-dd-yyyy">
										<input id="tdate" class="form-control" type="text" value="<?php echo date("Y-m-d");?>" name="tdate" required/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
					</div>
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
<script>


$(document).ready(function() {

	
	//do save data
   $("#formadd").validate({
      submitHandler: function(forms) {
	      var name 				= $("#name").val();
				var opening 		= $("#opening").val();
				var target 			= $("#target").val();
				var deadline 		= $("#tdate").val();
				
				$.ajax({
					type: "POST",
		            url: "{{ url('goals/save')}}",
		            data: {name:name,opening:opening,target:target,deadline:deadline},
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

	//get data
    $('#data').DataTable( {
			
			
            ajax: "{{ url('goals/getdata')}}",
            
						columns: [
							{ data: 'goalsid', orderable: false, searchable: false, visible: false},
							{ data: 'name'},
							{ data: 'balance'},
							{ data: 'amount'},				
							{ data: 'remaining',  orderable: false, searchable: false},		
							{ data: 'deadline'},
							{data: 'action',  orderable: false, searchable: false}
						],
		
						buttons: [
							{
								extend: 'copy',
								text:   'Copy',
								title: '<?php echo trans('lang.goal_list');?>',
								className: 'btn btn-sm btn-fill ',
								exportOptions: {
									columns: [ 1, 2, 3, 4, 5 ]
								}
							}, 
							{
								extend:'csv',
								text:   'CSV',
								title: '<?php echo trans('lang.goal_list');?>',
								className: 'btn btn-sm btn-fill ',
								exportOptions: {
									columns: [ 1, 2, 3, 4, 5 ]
								}
							},
							{
								extend:'pdf',
								text:   'PDF',
								title: '<?php echo trans('lang.goal_list');?>',
								orientation:'landscape',
								className: 'btn btn-sm btn-fill ',
								exportOptions: {
									columns: [1, 2, 3, 4, 5]
								},
								customize : function(doc){
									doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
								}
							},
							{
								extend:'print',
								title: '<?php echo trans('lang.goal_list');?>',
								text:   'Print',
								className: 'btn btn-sm btn-fill ',
								exportOptions: {
									columns: [ 1, 2, 3, 4, 5 ]
								}
							}
						]
    } );
	

	//do save edit
   $("#formedit").validate({
      submitHandler: function(forms) {
	      var id 				= $("#idedit").val();
				var name 			= $("#editname").val();
				var opening 	= $("#editopening").val();
				var target 		= $("#edittarget").val();
				var date 			= $("#edate").val();
				
				$.ajax({
					type: "POST",
		      url: "{{ url('goals/edit')}}",
					dataType: "JSON",
		      data: {id:id,name:name,opening:opening,target:target,date:date},
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


	//do save data
   $("#formdeposit").validate({
      submitHandler: function(forms) {
	      var id			= $("#iddeposit").val();
				var deposit = $("#depositvalue").val();
				
				$.ajax({
					type: "POST",
		            url: "{{ url('goals/deposit')}}",
		            data: {id:id,deposit:deposit},
		            dataType: "JSON",
		            success: function(data) {
									$("#msgdeposit").css({'display':"block"});
									$('#deposit').modal('hide');
									window.setTimeout(function(){location.reload()},2000)
		            }
				});
	      return false;
	     }
  });
		
		
		//for deposit to modal
		$('#deposit').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
            $("#iddeposit").val(id);
        });

		
		//for get id to modal edit

		$('#edit').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
            
			$.ajax({
				type: "POST",
				url: "{{ url('goals/getedit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					console.log(data);
					$("#editname").val(data.message[0].name);
					$("#edittarget").val(data.message[0].amount);
					$("#edate").val(data.message[0].deadline);
					$("#editopening").val(data.message[0].balance);
					$("#idedit").val(id);
				}
			});
		
		
        });
		
//for balance support number only
$('.number').keypress(function(event) {
		var $this = $(this);
		if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
		   ((event.which < 48 || event.which > 57) &&
		   (event.which != 0 && event.which != 8))) {
			   event.preventDefault();
		}

		var text = $(this).val();
		if ((event.which == 46) && (text.indexOf('.') == -1)) {
			setTimeout(function() {
				if ($this.val().substring($this.val().indexOf('.')).length > 3) {
					$this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
				}
			}, 1);
		}

		if ((text.indexOf('.') != -1) &&
			(text.substring(text.indexOf('.')).length > 2) &&
			(event.which != 0 && event.which != 8) &&
			($(this)[0].selectionStart >= text.length - 2)) {
				event.preventDefault();
		}      
	});

	$('.number').bind("paste", function(e) {
	var text = e.originalEvent.clipboardData.getData('Text');
	if ($.isNumeric(text)) {
		if ((text.substring(text.indexOf('.')).length > 3) && (text.indexOf('.') > -1)) {
			e.preventDefault();
			$(this).val(text.substring(0, text.indexOf('.') + 3));
	   }
	}
	else {
			e.preventDefault();
		 }
	});

$('#targetdate #tdate').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd",
            todayHighlight: true
        });	
$('#edate').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd",
            todayHighlight: true
        });			

</script>
@endsection