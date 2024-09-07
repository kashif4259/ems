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
                            <h4 class="title"><?php echo trans('lang.budget_list');?></h4>
                            </div>
                            <div class="">
                            <div class="d-flex flex-row">
                                <a href="#'" data-toggle="modal" data-target="#add" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?php echo trans('lang.add_budget');?></a>
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
									<th></th>
									<th>Budget ID</th>
									<th>Original</th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.amount');?></th>
									<th><?php echo trans('lang.month');?></th>
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
<div id="getdelete" data-url="{{ url('budget/delete')}}">
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
			  <div id="messageerror" style="display:none;" class="alert alert-warning"></div>
              <div class="modal-body">
               <div class="row">
					 <div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.month');?></label>
					    <select disabled id="editmonths" class="form-control">
							<option value="01"><?php echo trans('lang.jan');?></option>
							<option value="02"><?php echo trans('lang.feb');?></option>
							<option value="03"><?php echo trans('lang.mar');?></option>
							<option value="04"><?php echo trans('lang.apr');?></option>
							<option value="05"><?php echo trans('lang.may');?></option>
							<option value="06"><?php echo trans('lang.jun');?></option>
							<option value="07"><?php echo trans('lang.jul');?></option>
							<option value="08"><?php echo trans('lang.aug');?></option>
							<option value="09"><?php echo trans('lang.sep');?></option>
							<option value="10"><?php echo trans('lang.oct');?></option>
							<option value="11"><?php echo trans('lang.nov');?></option>
							<option value="12"><?php echo trans('lang.dec');?></option>
						</select>

					</div>
					<div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.year');?></label>
					    <select disabled id="edityears" class="form-control">
						<?php
							for ( $i = date( "Y" ); $i < date( "Y" )+10; $i++ ) {
								echo "<option value=$i>" . $i . "</option>";
							}
							?>
						</select>
					</div>
				</div>
                <div class="row">
					<div class="form-group col-lg-6">
					<label><small class="req text-danger">* </small><?php echo trans('lang.category');?></label>
						<select disabled id="editcategory" class="form-control">
							<option value=""><?php echo trans('lang.select_a_category');?></option>
							<optgroup label="<?php echo trans('lang.income');?>" id="income">
							</optgroup>
							<optgroup label="<?php echo trans('lang.expense');?>" id="expense">
							</optgroup>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label><small class="req text-danger">* </small><?php echo trans('lang.sub_category');?></label>
							<select disabled id="editsubcategory" class="form-control"></select>
					</div>
				</div>
				<div class="form-group">
                  <label><small class="req text-danger">* </small><?php echo trans('lang.amount');?></label>
					<div class="input-group">
						<span class="input-group-addon currency" id="editcurrency" style="border: 1px solid #cecece;"></span>
						<input class="form-control number" id="editamount" name="editamount" required type="text" placeholder="<?php echo trans('lang.amount');?>">
					</div>
                </div>
              </div>
              <div class="modal-footer">
				<input type="hidden" value="" name="id" id="idedit"/>
                <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?php echo trans('lang.close');?></button>
                <input type="submit" class="btn btn-sm btn-fill btn-info" id="save" value="<?php echo trans('lang.save');?>"/>
              </div>
            </form>
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
                <h5 class="modal-title"><?php echo trans('lang.add_budget');?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
			  <div id="exist" style="display:none;" class="alert alert-warning"><?php echo trans('lang.budget_already');?></div>
              <div class="modal-body">
			    <div class="row">
					 <div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.month');?></label>
					    <select id="months" class="form-control" name="months" required>
							<option value="01"><?php echo trans('lang.jan');?></option>
							<option value="02"><?php echo trans('lang.feb');?></option>
							<option value="03"><?php echo trans('lang.mar');?></option>
							<option value="04"><?php echo trans('lang.apr');?></option>
							<option value="05"><?php echo trans('lang.may');?></option>
							<option value="06"><?php echo trans('lang.jun');?></option>
							<option value="07"><?php echo trans('lang.jul');?></option>
							<option value="08"><?php echo trans('lang.aug');?></option>
							<option value="09"><?php echo trans('lang.sep');?></option>
							<option value="10"><?php echo trans('lang.oct');?></option>
							<option value="11"><?php echo trans('lang.nov');?></option>
							<option value="12"><?php echo trans('lang.dec');?></option>
						</select>

					</div>
					<div class="form-group col-lg-6">
					  <label><small class="req text-danger">* </small><?php echo trans('lang.year');?></label>
					    <select id="years" class="form-control" name="years" required>
						<?php
for ( $i = date( "Y" ); $i < date( "Y" )+10; $i++ ) {
	echo "<option value=$i>" . $i . "</option>";
}
?>
						</select>
					</div>
				</div>
                <div class="row">
					<div class="form-group col-lg-6">
					<label><small class="req text-danger">* </small><?php echo trans('lang.category');?></label>
						<select id="category" class="form-control" name="category" required>
							<option value=""><?php echo trans('lang.select_a_category');?></option>
							<optgroup label="<?php echo trans('lang.income');?>" id="income">
							</optgroup>
							<optgroup label="<?php echo trans('lang.expense');?>" id="expense">
							</optgroup>
						</select>
					</div>
					<div class="form-group col-lg-6">
						<label><small class="req text-danger">* </small><?php echo trans('lang.sub_category');?></label>
							<select id="subcategory" class="form-control" name="subcategory" required></select>
					</div>
				</div>
				<div class="form-group">
                  <label><small class="req text-danger">* </small><?php echo trans('lang.amount');?></label>
					<div class="input-group">
						<span class="input-group-addon currency" id="currency" style="border: 1px solid #cecece;"></span>
						<input class="form-control number"  placeholder="Amount" id="amount" name="amount" required type="text" placeholder="<?php echo trans('lang.amount');?>">
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
<script src="{{ asset('js/category.js') }}"></script>
<script>
$(document).ready(function() {
	

	//get income category
	$.ajax({
        type: "GET",
        url: "{{ url('incomecategory/getdata')}}",
        dataType: "json",
        success: function (html) {
			var objs = html.data;
			jQuery.each(objs, function (index, record) {
                var id = decodeURIComponent(record.categoryid);
                var name = decodeURIComponent(record.name);
				//alert(name);
                $("#category #income").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
				$("#editcategory #income").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
            });
        },
    });

	//get expense category
	$.ajax({
        type: "GET",
        url: "{{ url('expensecategory/getdata')}}",
        dataType: "json",
        success: function (html) {
			var objs = html.data;
			jQuery.each(objs, function (index, record) {
                var id = decodeURIComponent(record.categoryid);
                var name = decodeURIComponent(record.name);
				//alert(name);
                $("#category #expense").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
				$("#editcategory #expense").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
            });
        },
    });

	//get  sub category
	$("select#category.form-control").change(function(){
		var id = $(this).val();
		$.ajax({
        type: "POST",
        url: "{{ url('incomecategory/subgetdatabycat')}}",
        dataType: "json",
        data: {id:id},
        success: function (html) {
			var objs = html.message;
			var options;
			if (objs.length === 0) {
				$('#subcategory').empty();
			}
			$.each(objs, function(index, object) {
					options += '<option value="' + object.subcategoryid + '">' + object.name + '</option>';
				});
				$('#subcategory').html(options);
			
			},
		});
	});

	//get  sub category
	$("select#editcategory.form-control").change(function(){
		var id = $(this).val();
		$.ajax({
        type: "POST",
        url: "{{ url('incomecategory/subgetdatabycat')}}",
        dataType: "json",
        data: {id:id},
        success: function (html) {
			var objs = html.message;
			var options;
			if (objs.length === 0) {
				$('#editsubcategory').empty();
			}
			$.each(objs, function(index, object) {
					options += '<option value="' + object.subcategoryid + '">' + object.name + '</option>';
				});
				$('#editsubcategory').html(options);
			},
		});
	});


	

	//do save budget
   $("#formadd").validate({
      submitHandler: function(forms) {
		    var months 			= $("#months").val();
			var years 			= $("#years").val();
			var subcategory 	= $("#subcategory").val();
			var amount 			= $("#amount").val();
				
			$.ajax({
				type: "POST",
	            url: "{{ url('budget/save')}}",
	            data: {months:months,years:years,subcategory:subcategory,amount:amount},
	            dataType: "JSON",
	            success: function(data) {
					console.log(data);
					if(data.message=='0'){
						$("#exist").css({'display':"block"});
					}
					if(data.message=='1'){
						$("#message2").css({'display':"block"});
						$('#add').modal('hide');
						window.setTimeout(function(){location.reload()},2000)
					}
	            }
			});
	      	return false;
	     }
  	});



	//get data
    $('#data').DataTable( {

            ajax: "{{ url('budget/getdata')}}",       
			columns: [
				{
                "class":          "details-control",
                "orderable":      false,
				"searchable":      false,
                "data":           null,
                "defaultContent": ""
				},
				{ data: 'budgetid', orderable: false, searchable: false, visible: false},
				{ data: 'originalamount', orderable: false, searchable: false, visible: false},
				{ data: 'category'},
				{ data: 'subcategory'},
				{ data: 'amount'},
				{ data: 'fromdate'},
				{data: 'action',  orderable: false, searchable: false}
			],
			buttons: [
				{
					extend: 'copy',
					text:   'Copy',
					title: '<?php echo trans('lang.budget_list');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 3, 4, 5, 6 ]
					}
				},
				{
					extend:'csv',
					text:   'CSV',
					title: '<?php echo trans('lang.budget_list');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 3, 4, 5, 6 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF',
					title: '<?php echo trans('lang.budget_list');?>',
					orientation:'landscape',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [3, 4, 5, 6 ]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					text:   'Print',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 3, 4, 5, 6 ]
					}
				}
			]
    } );


	function format ( d ) {

	return '<div class="d-flex justify-content-between flex-sm-row flex-column">'+
                            '<div class="pb-3 pb-md-0 " style="min-width:400px;">'+
	                            '<h4 class="mb-0"><?php echo trans('lang.budget_remaining');?></h4>'+
	                            '<h3 classs="mt-0" style="margin-top:0;"><span class="currency">{{$data[0]->currency}}</span><span id="remainingbudget"></span></h3>'+
	                            '<div class="row">'+
	                            	'<div class="col-md-6">'+
	                            			'<p class="mb-0 text-blue"><?php echo trans('lang.planned');?></p>'+
	                            			'<p>'+d.amount+'</p>'+
	                            	'</div>'+
	                            	'<div class="col-md-6">'+
	                            			'<p class="mb-0 text-green"><?php echo trans('lang.actual');?></p>'+
	                            			'<p id="actualbudget"></p>'+
	                            	'</div>'+
	                            '</div>'+
	                            '<small><?php echo trans('lang.created_by');?>: <b>'+d.user+'</b></small>'+
                            '</div>'+
                            
                            '<div class="d-flex flex-row">'+
                               '<div id="chart"></div>'+
                            '</div>'+
                    		'</div>';




}

	// Array to track the ids of the details displayed rows
    var detailRows = [];

    $('#data tbody').on( 'click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
		var table = $('#data').DataTable();
        var row = table.row( tr );
        var idx = $.inArray( tr.attr('id'), detailRows );

        if ( row.child.isShown() ) {
            tr.removeClass( 'details' );
            row.child.hide();

            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
            tr.addClass( 'details' );
            row.child( format( row.data() ) ).show();
			var id = row.data().categoryid;
			var date = row.data().fromdate;
			//start search by id expense/income category detail
			$.ajax({
				type: "POST",
				url: "{{ url('budget/gettransactionbydate')}}",
				data: {id:id,date:date},
				dataType: "JSON",
				success: function(data) {
					var remaining = row.data().originalamount - data.totalamount;
					$("#currencybudget").html(data.currency);
					$("#actualbudget").html(data.amountcurrency);
					$("#remainingbudget").html( remaining.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
					Morris.Donut({
					  element: 'chart',
					  data: [
						{label: "<?php echo trans('lang.planned');?>", value: row.data().originalamount},
						{label: "<?php echo trans('lang.actual');?>", value: data.totalamount}
					  ],
					  colors: ['#3E7EFF','#1DC873']
					});

				}
			});


            // Add to the 'open' array
            if ( idx === -1 ) {
                detailRows.push( tr.attr('id') );
            }
        }
    } );

    // On each draw, loop over the `detailRows` array and show any child rows
    $('#data').on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    } );



    //do save edit budget
   $("#formedit").validate({
      submitHandler: function(forms) {
		    var id 				= $("#idedit").val();
			var months 			= $("#editmonths").val();
			var years 			= $("#edityears").val();
			var subcategory 	= $("#editsubcategory").val();
			var amount 			= $("#editamount").val();
				
			$.ajax({
				type: "POST",
	            url: "{{ url('budget/edit')}}",
	            data: {id:id,months:months,years:years,subcategory:subcategory,amount:amount},
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


		//for get id to modal edit

		$('#edit').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');

			$.ajax({
				type: "POST",
				url: "{{ url('budget/getedit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					console.log(data);
					$("#expensename").val(data.message[0].name);
					$("#editamount").val(data.message[0].amount);
					$("#editmonths").val(data.months);
					$("#edityears").val(data.years);
					$("#editcategory").val(data.message[0].realcategoryid);
					$('#editcategory').trigger("change");
					$("#idedit").val(id);
				}
			});


        });


</script>
@endsection
