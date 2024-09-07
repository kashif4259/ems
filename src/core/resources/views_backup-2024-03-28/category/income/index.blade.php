@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
	
        <div class="row">
		<div class="card col-lg-12">

      <ul class="nav nav-tabs" id="categorytab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="income-tab" data-toggle="tab" href="#cat" role="tab" aria-controls="cat" aria-selected="true"><?php echo trans('lang.category');?></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="expense-tab" data-toggle="tab" href="#subcat" role="tab" aria-controls="subcat" aria-selected="false"><?php echo trans('lang.sub_category');?></a>
                      </li>
                    </ul>

		
			<div class="tab-content">
			 <div id="cat" class="tab-pane show active">
				<div class="">

                      <div class="header">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="pb-3 pb-md-0">
                            <h4 class="title"><?php echo trans('lang.income_category_list');?></h4>
                            </div>
                            <div class="">
                            <div class="d-flex flex-row">
                                <a href="#'" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?php echo trans('lang.add_income_category');?></a>
                            </div>
                            </div>
                        </div>
                    </div>

           <div class="content">
					<div id="message2" style="display:none" class="alert alert-success"><?php echo trans('lang.data_added');?></div>
					<div id="message3" style="display:none" class="alert alert-success"><?php echo trans('lang.data_deleted');?></div>
					<div id="message4" style="display:none" class="alert alert-success"><?php echo trans('lang.data_updated');?></div>
					<div id="message10" style="display:none" class="alert alert-danger"><?php echo trans('lang.category_cannot_deleted');?></div>
						<div class="table-responsive">
            <table id="data" class="table " cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Category ID</th>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.description');?></th>
									<th><?php echo trans('lang.color');?></th>
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
			<!--sub category-->
			 <div id="subcat" class="tab-pane fade">
				<div class="">

            <div class="header">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="pb-3 pb-md-0">
                            <h4 class="title"><?php echo trans('lang.income_sub_category_list');?></h4>
                            </div>
                            <div class="">
                            <div class="d-flex flex-row">
                                <a href="#'" data-toggle="modal" data-target="#addsub" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?php echo trans('lang.add_sub_category');?></a>
                            </div>
                            </div>
                        </div>
                    </div>



                   
                    <div class="content">
					<div id="message6" style="display:none" class="alert alert-success"><?php echo trans('lang.data_added');?></div>
					<div id="message7" style="display:none" class="alert alert-success"><?php echo trans('lang.data_deleted');?></div>
					<div id="message8" style="display:none" class="alert alert-success"><?php echo trans('lang.data_updated');?></div>
					<div id="message9" style="display:none" class="alert alert-danger"><?php echo trans('lang.subcategory_cannot_deleted');?></div>
						<div class="table-responsive">
            <table id="datasub" class="table" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><?php echo trans('lang.sub_category_id');?></th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
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
    </div>
</div>	
<!--add new data -->
<div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="#" id="formadd"  autocomplete="off">
              <div class="modal-header">
                <h5 class="modal-title"><?php echo trans('lang.add_income_category');?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
				
                <div class="form-group">
                  <label><?php echo trans('lang.name');?></label>
                  <input type="text" class="form-control" name="name"  id="name" placeholder="<?php echo trans('lang.name');?>" required>
                </div>
				 <div class="form-group">
                  <label><?php echo trans('lang.description');?></label>
                  <textarea class="form-control" name="description" id="description" placeholder="<?php echo trans('lang.description');?>"></textarea>
                </div>
				<div class="form-group">
                  <label><?php echo trans('lang.color');?></label>
                  <input type="text" class="form-control jscolor" name="color"  id="color" placeholder="<?php echo trans('lang.color');?>" required>
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
<!--delete data -->
<div id="getdelete" data-url="{{ url('incomecategory/delete')}}">
    @include('layouts.delete')
</div>
<!-- delete data -->


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
                  <label><?php echo trans('lang.name');?></label>
                  <input type="text" class="form-control" name="editname"  id="editname" placeholder="<?php echo trans('lang.name');?>" required>
                </div>
				 <div class="form-group">
                  <label><?php echo trans('lang.description');?></label>
                  <textarea class="form-control" name="editdescription" id="editdescription" placeholder="<?php echo trans('lang.description');?>"></textarea>
                </div>
				<div class="form-group">
                  <label><?php echo trans('lang.color');?></label>
                  <input type="text" class="form-control jscolor" name="editcolor"  id="editcolor" placeholder="<?php echo trans('lang.color');?>" required>
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
<!--subcat-->	  
<!--add new data -->
<div id="addsub" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="#" id="formsubadd"  autocomplete="off">
              <div class="modal-header">
                <h5 class="modal-title"><?php echo trans('lang.add_sub_income_category');?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
				<div class="form-group">
                  <label><?php echo trans('lang.category');?></label>
                 <select id="incomecategory" data-url="{{ url('incomecategory/getdata')}}" class="form-control" name="incomecategory" required >
                  <label for="incomecategory" class="error"></label>
				 </select>
                </div>
                <div class="form-group">
                  <label><?php echo trans('lang.sub_category');?></label>
                  <input type="text" class="form-control" name="name"  id="subname" placeholder="<?php echo trans('lang.sub_category');?>" required>
                </div>
				 <div class="form-group">
                  <label><?php echo trans('lang.description');?></label>
                  <textarea class="form-control" name="description" id="subdescription" placeholder="<?php echo trans('lang.description');?>"></textarea>
                </div>
				
              </div>
              <div class="modal-footer">
				
                <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?php echo trans('lang.close');?></button>
                <input type="submit" class="btn btn-sm btn-fill btn-info" value="<?php echo trans('lang.save');?>"/>
              </div>
            </form>
          </div>
        </div>
      </div>
<!--delete data -->
<div id="getdeletesub" data-url="{{ url('incomecategory/subdelete')}}">
    @include('layouts.deletesub')
</div>
<!-- delete data -->
 <!--edit data -->
<div id="editsub" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="#" id="formsubedit"  autocomplete="off">
              <div class="modal-header">
                <h5 class="modal-title"><?php echo trans('lang.edit');?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
              <div class="modal-body">
				<div class="form-group">
                  <label><?php echo trans('lang.category');?></label>
                 <select id="editcategory" class="form-control subcategoryid" name="editcategory" required>
                  <label for="editcategory" class="error"></label>
				 </select>
                </div>
                <div class="form-group">
                  <label><?php echo trans('lang.sub_category');?></label>
                  <input type="text" class="form-control" name="editname"  id="subeditname" placeholder="<?php echo trans('lang.sub_category');?>" required>
                </div>
				 <div class="form-group">
                  <label><?php echo trans('lang.description');?></label>
                  <textarea class="form-control" name="editdescription" id="subeditdescription" placeholder="<?php echo trans('lang.description');?>"></textarea>
                </div>
              </div>
              <div class="modal-footer">
				<input type="hidden" value="" name="id" id="subidedit"/>
                <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?php echo trans('lang.close');?></button>
                <input type="submit" class="btn btn-sm btn-fill btn-info" value="<?php echo trans('lang.save');?>"/>
              </div>
            </form>
          </div>
        </div>
      </div> 
  
</div>

<script src="{{ asset('js/general.js') }}"></script>
<script src="{{ asset('js/category.js') }}"></script>	  
<script>
$(document).ready(function() {



    $('#data').DataTable( {
			
		
      ajax: "{{ url('incomecategory/getdata')}}",
            
			columns: [
				{ data: 'categoryid', orderable: false, searchable: false, visible: false},
				{ data: 'name'},
				{ data: 'description'},
				{ data: 'color', orderable: false, searchable: false},
				{data: 'action',  orderable: false, searchable: false}
			],
		
			buttons: [
				{
					extend: 'copy',
					text:   'Copy',
					title: '<?php echo trans('lang.income_category_list');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 1, 2]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV',
					title: '<?php echo trans('lang.income_category_list');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [  1, 2]
					}
				},
				{
					extend:'pdf',
					text:   'PDF',
					title: '<?php echo trans('lang.income_category_list');?>',
					className: 'btn btn-sm btn-fill ',
					orientation:'landscape',
					exportOptions: {
						columns: [  1, 2]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.income_category_list');?>',
					className: 'btn btn-sm btn-fill ',
					text:   'Print',
					exportOptions: {
						columns: [ 1, 2]
					}
				}
			]
    } );
	
	//sub category datatables
	$('#datasub').DataTable( {
			
			
      ajax: "{{ url('incomecategory/subgetdata')}}",
           
			columns: [
				{ data: 'subcategoryid', orderable: false, searchable: false},
				{ data: 'category'},
				{ data: 'name'},
				{ data: 'description'},
				{data: 'action',  orderable: false, searchable: false}
			],
			
			buttons: [
				{
					extend: 'copy',
					text:   'Copy',
					title: '<?php echo trans('lang.income_sub_category_list');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 1, 2, 3]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV',
					title: '<?php echo trans('lang.income_sub_category_list');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [  1, 2, 3]
					}
				},
				{
					extend:'pdf',
					text:   'PDF',
					title: '<?php echo trans('lang.income_sub_category_list');?>',
					className: 'btn btn-sm btn-fill ',
					orientation:'landscape',
					exportOptions: {
						columns: [  1, 2, 3]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.income_sub_category_list');?>',
					className: 'btn btn-sm btn-fill ',
					text:   'Print',
					exportOptions: {
						columns: [ 1, 2, 3]
					}
				}
			]
    } );
	



  $("#formadd").validate({
     
      submitHandler: function(forms) {
        var name        = $("#name").val();
        var description = $("#description").val();
        var color       = $("#color").val();

        $.ajax({
        method: "POST",
              url: "{{ url('incomecategory/save')}}",
              data: {color:color,name:name,description:description},
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


  //sub save
  $("#formsubadd").validate({
     
      submitHandler: function(forms) {
        var category    = $("#addsub #incomecategory").val();
        var name        = $("#subname").val();
        var description = $("#subdescription").val();

        $.ajax({
        method: "POST",
              url: "{{ url('incomecategory/subsave')}}",
              data: {category:category,name:name,description:description},
              dataType: "JSON",
              success: function(data) {
                //$("#message").html(data);
                $("#message6").css({'display':"block"});
                $('#addsub').modal('hide');
                window.setTimeout(function(){location.reload()},2000)
              }
        });
          return false;
      }
    });


  $("#formedit").validate({
     
      submitHandler: function(forms) {
        var name        = $("#editname").val();
        var description = $("#editdescription").val();
        var color       = $("#editcolor").val();
        var id          = $("#idedit").val();

        $.ajax({
          type: "POST",
                url: "{{ url('incomecategory/edit')}}",
                data: {id:id,color:color,name:name,description:description},
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

	 $("#formsubedit").validate({
     
      submitHandler: function(forms) {
        var name          = $("#subeditname").val();
        var description   = $("#subeditdescription").val();
        var category      = $("#editsub #editcategory").val();
        var id            = $("#editsub #subidedit").val();

       $.ajax({
        type: "POST",
              url: "{{ url('incomecategory/subedit')}}",
              data: {id:id,category:category,name:name,description:description},
              dataType: "JSON",
              success: function(data) {
                //$("#message").html(data);
                $("#message8").css({'display':"block"});
                $('#editsub').modal('hide');
                window.setTimeout(function(){location.reload()},2000)
              }
      });
          return false;
      }
    });


} );


		
		//for get id to modal edit

		$('#editsub').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
			$.ajax({
				type: "POST",
				url: "{{ url('incomecategory/subgetedit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					$("#editsub #subidedit").val(id);
					$("#editsub #editcategory").val(data.message[0].categoryid);
					$("#subeditname").val(data.message[0].name);
					$("#subeditdescription").val(data.message[0].description);
				}
			});

        });
		$('#edit').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
			$.ajax({
				type: "POST",
				url: "{{ url('incomecategory/getedit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					$("#idedit").val(id);
					$("#editname").val(data.message[0].name);
					$("#editdescription").val(data.message[0].description);
					$("#editcolor").val(data.color);
				}
			});

        });
		



</script>
@endsection