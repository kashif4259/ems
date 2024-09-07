@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
	
        <div class="row" id="gettotal" data-url="{{ url('expense/gettotal')}}">
        	<div class="col-md-3 pb-2">
                <div class="d-flex align-items-stretch">
                    <div class="home-icon-content background-red color-white p-3 rounded flex-fill">
                        <p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
                    </div>
                    <div class="background-grey p-3 rounded flex-fill">
                        <p class="transactiontitle"><span class="currency"></span><span id="overall"></span></p> 
                        <p class="small-font mb-0"><?php echo trans('lang.overall');?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 pb-2">
                <div class="d-flex align-items-stretch">
                    <div class="home-icon-content background-red color-white p-3 rounded flex-fill">
                        <p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
                    </div>
                    <div class="background-grey p-3 rounded flex-fill">
                        <p class="transactiontitle"><span class="currency"></span><span id="month"></span></p> 
                        <p class="small-font mb-0"><?php echo trans('lang.in_this_month');?></p>
                    </div>
                </div>
            </div>
			
			<div class="col-md-3 pb-2">
                <div class="d-flex align-items-stretch">
                    <div class="home-icon-content background-red color-white p-3 rounded flex-fill">
                        <p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
                    </div>
                    <div class="background-grey p-3 rounded flex-fill">
                        <p class="transactiontitle"><span class="currency"></span><span id="week"></span></p> 
                        <p class="small-font mb-0"><?php echo trans('lang.in_this_week');?></p>
                    </div>
                </div>
            </div>
			
			<div class="col-md-3 pb-2">
                <div class="d-flex align-items-stretch">
                    <div class="home-icon-content background-red color-white p-3 rounded flex-fill">
                        <p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
                    </div>
                    <div class="background-grey p-3 rounded flex-fill">
                        <p class="transactiontitle"><span class="currency"></span><span id="today"></span></p> 
                        <p class="small-font mb-0"><?php echo trans('lang.today');?></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-11 pt-4">
                <div class="card">
                	<div class="header">
						<div class="d-flex justify-content-between flex-sm-row flex-column">
							<div class="pb-3 pb-md-0">
							<h4 class="title"><?php echo trans('lang.expense_list');?></h4>
							</div>
							<div class="">
							<div class="d-flex flex-row">
                                 
                                <a href="{{url('transaction/index')}}" class="btn btn-sm btn-fill btn-info"><i class="ti-plus"></i> <?php echo trans('lang.add_new_expense');?></a>
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
									<th>Transaction ID</th>
									<th><?php echo trans('lang.name');?></th>
									<th><?php echo trans('lang.amount');?></th>
									<th><?php echo trans('lang.date');?></th>
									<th><?php echo trans('lang.category');?></th>
									<th><?php echo trans('lang.account');?></th>
									<th><?php echo trans('lang.sub_category');?></th>
									<th><?php echo trans('lang.reference');?></th>
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
<!--import data -->
 <div class="modal fade" id="imports" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo trans('lang.import');?></h4>
        </div>
        <div class="modal-body">
        <div id="messagecsv" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
        <div id="messagecsverror" style="display:none;" class="alert alert-warning"><?php echo trans('lang.messagecsverror');?></div>
        <div id="categoryerror" style="display:none;" class="alert alert-warning"><?php echo trans('lang.csvcategory');?></div>
        <div id="accounterror" style="display:none;" class="alert alert-warning"><?php echo trans('lang.csvaccount');?></div>
        
        <form action="" method="POST">
            <h5><?php echo trans('lang.estep1');?></h5>
                        <hr/>
                        <small><?php echo trans('lang.estep11');?></small><br/>
                        <a href="upload/csv/example.csv" style="color:#2780e3"><?php echo trans('lang.download_csv');?></a><br/>
                        <h5><?php echo trans('lang.estep2');?></h5>
                        <hr/>
                        <small><?php echo trans('lang.estep22');?>
                              <p style="color:#BD1518"><?php echo trans('lang.estep23');?></p></small>
                         <h5><?php echo trans('lang.estep3');?></h5>  
                         <hr/>
            <label for="csv"><?php echo trans('lang.csv_file');?></label>                
          <input type="file" value="" name="csv" id="csv" required/>
          </form>
        </div>
        <div class="modal-footer">
           <input type="submit" class="btn btn-primary" id="importcsv" value="<?php echo trans('lang.import');?>"/>
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('lang.close');?></button>
        </div>
      </div>
    </div>
  </div>
<!--delete data -->
<div id="getdelete" data-url="{{ url('expense/delete')}}">
    @include('layouts.delete')
</div>
<!-- delete data -->

 <!--edit data -->
<div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="#" id="formeditexpense" enctype="multipart/form-data" autocomplete="off">
             <div class="modal-header">
                <h5 class="modal-title"><?php echo trans('lang.edit');?></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>	
			  <div id="message" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
			  <div id="messageerror" style="display:none;" class="alert alert-warning"></div>
              <div class="modal-body">
               <div class="row">
								<div class="col-lg-12">
									<div class="form-group">
									  <label><small class="req text-danger">* </small><?php echo trans('lang.name');?></label>
									  <input type="text" class="form-control" name="expensename" required id="expensename" placeholder="<?php echo trans('lang.name');?>">
									 </div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="expenseamount" class="control-label"><small class="req text-danger">* </small><?php echo trans('lang.amount');?></label> 
										<div class="input-group">
											<span class="input-group-addon currency" id="currency" style="border: 1px solid #cecece;"></span>                                      
											<input class="form-control number" required  id="expenseamount" name="expenseamount" type="text" placeholder="<?php echo trans('lang.amount');?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
									  <label><?php echo trans('lang.reference');?></label>
									  <input type="text" class="form-control" name="expensereference"  id="expensereference" placeholder="<?php echo trans('lang.reference');?>">
									</div>
								</div>
							</div>				
							<div class="row">	
								<div class="form-group col-lg-6" id="expensedate">
									<label for="date" class="control-label"> 
									<small class="req text-danger">* </small><?php echo trans('lang.date');?></label>
									<div  class="input-group date" data-date-format="mm-dd-yyyy">
										<input id="edate" class="form-control" name="edate" required type="text" value="<?php echo date("Y-m-d");?>"/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
								</div>
								<div class="form-group col-lg-6">
								  <label><small class="req text-danger">* </small><?php echo trans('lang.account');?></label>
								  <select id="expenseaccount" name="expenseaccount" required class="form-control" data-url="{{ url('account/getdata')}}"></select>
								  <label for="expenseaccount" class="error"></label>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-6">
								  <label><small class="req text-danger">* </small><?php echo trans('lang.expense_category');?></label>
								  <select id="expensecategory" class="form-control" name="expensecategory" required data-url="{{ url('expensecategory/getdata')}}">
								  <option value=""><?php echo trans('lang.select_a_category');?></option>
								  </select>
								  <label for="expensecategory" class="error"></label>
								</div>
								<div class="form-group col-lg-6">
								  <label><small class="req text-danger">* </small><?php echo trans('lang.expense_sub_category');?></label>
								  <select id="expensesubcategory" class="form-control" name="expensesubcategory" required data-url="{{ url('expensecategory/subgetdatabycat')}}"></select>
								  <label for="expensesubcategory" class="error"></label>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-12">
								  <label><?php echo trans('lang.note');?></label>
								  <textarea id="expensenote" class="form-control" name="expensenote" placeholder="<?php echo trans('lang.note');?>"></textarea>
								</div>
							</div>
							<div class="row" id="attachexpense">
                                <div class="form-group col-lg-12">
                                  <label class="filelabel">
                                        <i class="fa fa-paperclip">
                                        </i>
                                        <span class="title">
                                           <?php echo trans('lang.attach');?>
                                        </span>
                                        <input class="attachfile" id="expensefile" name="expensefile" type="file"/>
                                    </label>
                                </div>
                            </div>
              </div>
              <div class="modal-footer">
				<input type="hidden" value="" name="id" id="idedit"/>
                <button type="button" class="btn btn-sm btn-fill" data-dismiss="modal"><?php echo trans('lang.close');?></button>
                <input type="submit" class="btn btn-sm btn-fill btn-info" id="saveedit" value="<?php echo trans('lang.save');?>"/>
              </div>
            </form>
          </div>
        </div>
      </div> 
  
</div>

<script src="{{ asset('js/general.js') }}"></script>
<script src="{{ asset('js/expense.js') }}"></script>
<script src="{{ asset('js/account.js') }}"></script>
<script src="{{ asset('js/category.js') }}"></script>	  
<script>


$(document).ready(function() {

	//get data
    $('#data').DataTable( {
			
			
            ajax: "{{ url('expense/getdata')}}",
           
			columns: [
				{
                "class":          "details-control",
                "orderable":      false,
				"searchable":      false,
                "data":           null,
                "defaultContent": ""
				},
				{ data: 'transactionid', orderable: false, searchable: false, visible: false},
				{ data: 'name'},
				{ data: 'amount'},
				{ data: 'transactiondate'},
				{ data: 'category'},
				{ data: 'account'},
				{ data: 'subcategory', orderable: false, searchable: false, visible: false},
				{ data: 'reference', orderable: false, searchable: false, visible: false},
				{ data: 'description', orderable: false, searchable: false, visible: false},
				{data: 'action',  orderable: false, searchable: false}
			],
			buttons: [
				{
					extend: 'copy',
					text:   'Copy',
					title: '<?php echo trans('lang.expense_list');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [ 2, 3, 4, 5, 6, 7, 8, 9  ]
					}
				}, 
				{
					extend:'csv',
					text:   'CSV',
					title: '<?php echo trans('lang.expense_list');?>',
					className: 'btn btn-sm btn-fill ',
					exportOptions: {
						columns: [   2, 3, 4, 5, 6, 7, 8, 9 ]
					}
				},
				{
					extend:'pdf',
					text:   'PDF',
					title: '<?php echo trans('lang.expense_list');?>',
					className: 'btn btn-sm btn-fill ',
					orientation:'landscape',
					exportOptions: {
						columns: [   2, 3, 4, 5, 6, 7, 8, 9 ]
					},
					customize : function(doc){
						doc.styles.tableHeader.alignment = 'left';
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
					}
				},
				{
					extend:'print',
					title: '<?php echo trans('lang.expense_list');?>',
					className: 'btn btn-sm btn-fill ',
					text:   'Print',
					exportOptions: {
						columns: [  2, 3, 4, 5, 6, 7, 8, 9 ]
					}
				}
			]
    } );
	
	
	function format ( d ) {
	return '<table cellpadding="10" cellspacing="0" border="0" width="100%" class="table-detail" style="">'+

		'<tr class="table-detail" height="30">'+
            '<td width="50"><strong>&nbsp;</td>'+
            '<td><strong><?php echo trans('lang.reference');?></strong>:</td>'+
            '<td><strong><?php echo trans('lang.category');?></strong>:</td>'+
            '<td><strong><?php echo trans('lang.sub_category');?></strong>:</td>'+
            '<td><strong><?php echo trans('lang.note');?></strong>:</td>'+
            '<td><strong><?php echo trans('lang.created_by');?></strong>:</td>'+
        '</tr >'+
		'<tr class="" height="30">'+
            '<td width="50"><strong>&nbsp;</td>'+
            '<td>'+d.reference+'</td>'+
            '<td>'+d.category+'</td>'+
            '<td>'+d.subcategory+'</td>'+
            '<td>'+d.description+'</td>'+
            '<td>'+d.user+'</td>'+
        '</tr >'+
    '</table>';
	
   
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
	
    //import csv
    $("#importcsv").click(function(e){

        var form = new FormData();
        var file  = $('#csv')[0].files[0];
        form.append('csvfile', file);
        if(file =='' || file==null){
            $("#messagecsv").css({'display':"block"});
            return false;
        }

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ url('transaction/importcsv2')}}",
            data: form,
            contentType: 'multipart/form-data',
            processData: false,
            contentType: false,
             success: function(data) {
                console.log(data);
                if(data.message=='1'){
                $("#message2").css({'display':"block"});
                $('#imports').modal('hide');
                window.setTimeout(function(){location.reload()},2000)
                }
                if(data.message=='0'){
                    $("#messagecsv").css({'display':"block"});
                }
                if(data=='2'){
                    $("#categoryerror").css({'display':"block"});
                }
                if(data=='3'){
                    $("#categoryerror").css({'display':"block"});
                }
            },
            error: function (error) {
                var errordata = error.responseJSON.csvfile[1];
                $("#messagecsverror").css({'display':"block"});
                $("#messagecsverror").html(errordata);
            }
        });
    });




    //do save expense
   $("#formeditexpense").validate({
        submitHandler: function(forms) {
            var form 			= new FormData();
			var id 				= $("#idedit").val();
			var name 			= $("#expensename").val();
			var amount			= $("#expenseamount").val();
			var reference 		= $("#expensereference").val();
			var account 		= $("#expenseaccount").val();
			var category 		= $("#expensecategory").val();
			var subcategory 	= $("#expensesubcategory").val();
			var date 			= $("#edate").val();
			var note 			= $("#expensenote").val();
			var file  			= $('#expensefile')[0].files[0];
			
			form.append('id', id);
			form.append('expensename', name);
			form.append('expenseamount', amount);
			form.append('expensereference', reference);
			form.append('expenseaccount', account);
			form.append('expensecategory', category);
			form.append('expensesubcategory', subcategory);
			form.append('expensenote', note);
			form.append('expensedate', date);
			form.append('expensefile', file);
            
            $.ajax({
				type: "POST",
	            url: "{{ url('expense/edit')}}",
	            data: form,
				contentType: 'multipart/form-data',
				processData: false,
	            contentType: false,
	             success: function(data) {
					$("#edit").modal('hide');
					$("#message4").css({'display':"block"});
					window.setTimeout(function(){location.reload()},2000)
	            },
				error: function (error) {
					var errordata = error.responseJSON.expensefile[0];
					$("#messageerror").css({'display':"block"});
					$("#messageerror").html(errordata);
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
				url: "{{ url('expense/getedit')}}",
				data: {id:id},
				dataType: "JSON",
				success: function(data) {
					console.log(data);
					$("#expensename").val(data.message[0].name);
					$("#expenseamount").val(data.message[0].amount);
					$("#expensereference").val(data.message[0].reference);
					$("#expenseaccount").val(data.message[0].accountid);
					$("#expensecategory").val(data.message[0].categoryid2);
					$('#expensecategory').trigger("change");
					$("#edate").val(data.message[0].transactiondate);
					$("#expensenote").val(data.message[0].description);
					$("#idedit").val(id);

                    var catid = data.message[0].categoryid2;
                    
                    $.ajax({
                        type: "POST",
                        url: "{{ url('expensecategory/subgetdatabycat')}}",
                        dataType: "json",
                        data: {id:catid},
                        success: function (html) {
                            var objs = html.message;
                            var options;
                            if (objs.length === 0) {
                                $('#expensesubcategory').empty();
                            }
                            $.each(objs, function(index, object) {
                                    options += '<option value="' + object.subcategoryid + '">' + object.name + '</option>';
                                });
                                $('#expensesubcategory').html(options);
                                $("#expensesubcategory").val(data.message[0].categoryid);
                                //$("#expensesubcategory").trigger('change');
                            },
                        });
				}
			});
		
		
        });
		
	
</script>
@endsection