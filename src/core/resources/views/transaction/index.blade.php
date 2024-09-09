@extends('layouts.app')
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="row">
			<div class="col-md-6">
				<div class="card">
							<div class="header">
								<h4 class="title"><?php echo trans('lang.income_transaction');?></h4> 
							</div>
							<div class="content">
							<div id="message2" style="display:none;" class="alert alert-success"><?php echo trans('lang.income_added');?></div>
							<div id="message3" style="display:none;"  class="alert alert-warning"></div>
							<form action="#" id="formaddincome" enctype="multipart/form-data" autocomplete="off">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
									  <label><small class="req text-danger">* </small><?php echo trans('lang.name');?></label>
									  <input type="text" class="form-control" name="name" required id="incomename" placeholder="<?php echo trans('lang.name');?>">
									 </div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="incomeamount" class="control-label"><small class="req text-danger">* </small><?php echo trans('lang.amount');?></label> 
										<div class="input-group">
											<span class="input-group-addon" id="currency" style="border: 1px solid #cecece;">{{$data[0]->currency}}</span>                                      
											<input class="form-control number" required placeholder="Amount" id="incomeamount" name="incomeamount" type="text" placeholder="<?php echo trans('lang.amount');?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
									  <label><?php echo trans('lang.reference');?></label>
									  <input type="text" class="form-control" name="incomereference"  id="incomereference" placeholder="<?php echo trans('lang.reference');?>">
									</div>
								</div>
							</div>				
							<div class="row">	
								<div class="form-group col-lg-6" id="incomedate">
									<label for="date" class="control-label"> 
									<small class="req text-danger">* </small><?php echo trans('lang.date');?></label>
									<div  class="input-group date" data-date-format="mm-dd-yyyy">
										<input id="idate" class="form-control" required type="text" value="<?php echo date("Y-m-d");?>" disabled/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
								</div>
								<div class="form-group col-lg-6">
								  <label><small class="req text-danger">* </small><?php echo trans('lang.account');?></label>
								  <select id="incomeaccount" name="incomeaccount" class="form-control required" required data-url="{{ url('account/getdata')}}"></select>
								  <label for="incomeaccount" class="error"></label>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-6">
								  <label><small class="req text-danger">* </small><?php echo trans('lang.income_category');?></label>
								  <select id="incomecategory" name="incomecategory" class="form-control required" required data-url="{{ url('incomecategory/getdata')}}">
								  	<option value=""><?php echo trans('lang.select_a_category');?></option>
								  </select>
								  <label for="incomecategory" class="error"></label>
								</div>
								<div class="form-group col-lg-6">
								  <label><small class="req text-danger">* </small><?php echo trans('lang.income_sub_category');?></label>
								  <select id="incomesubcategory" name="incomesubcategory" class="form-control" required data-url="{{ url('incomecategory/subgetdatabycat')}}"></select>
								  <label for="incomesubcategory" class="error"></label>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-lg-12">
								  <label><?php echo trans('lang.note');?></label>
								  <textarea id="incomenote" class="form-control" placeholder="<?php echo trans('lang.note');?>"></textarea>
								</div>
							</div>
							<div class="row" id="attachincome">
								<div class="form-group col-lg-12">
								  <label class="filelabel">
									    <i class="fa fa-paperclip">
									    </i>
									    <span class="title">
									       <?php echo trans('lang.attach');?>
									    </span>
									    <input class="attachfile" id="incomefile" name="incomefile" type="file"/>
									</label>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 pt-3 pb-3">
									<button type="submit" id="incomesave" class="btn btn-info btn-fill btn-wd"><i class="ti-check"></i> <?php echo trans('lang.save_income');?></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<!--expense-->
			<div class="col-md-6">
				<div class="card">
							<div class="header">
								<h4 class="title"><?php echo trans('lang.expense_transaction');?></h4>
							</div>
							<div class="content">
							<div id="message6" style="display:none;" class="alert alert-warning"><?php echo trans('lang.all_field_required');?></div>
							<div id="message7" style="display:none;" class="alert alert-success"><?php echo trans('lang.expense_added');?></div>
							<div id="message5" style="display:none;"  class="alert alert-warning"></div>
							<form action="#" id="formaddexpense" enctype="multipart/form-data" autocomplete="off">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
									  <label><small class="req text-danger">* </small><?php echo trans('lang.name');?></label>
									  <input type="text" class="form-control" required name="expensename"  id="expensename" placeholder="<?php echo trans('lang.name');?>">
									 </div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="expenseamount" class="control-label"><small class="req text-danger">* </small><?php echo trans('lang.amount');?></label> 
										<div class="input-group">
											<span class="input-group-addon" id="currency" style="border: 1px solid #cecece;">{{$data[0]->currency}}</span>                                      
											<input class="form-control number" required="" placeholder="Amount" id="expenseamount" name="expenseamount" type="text" placeholder="<?php echo trans('lang.amount');?>">
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
										<input id="edate" class="form-control" required name="edate" type="text" value="<?php echo date("Y-m-d");?>" disabled/>
										<span class="input-group-addon" style="border: 1px solid #cecece;"><i class="fa fa-calendar"></i></span>
									</div>
								</div>
								<div class="form-group col-lg-6">
								  <label><small class="req text-danger">* </small><?php echo trans('lang.account');?></label>
								  <select id="expenseaccount" class="form-control" name="expenseaccount" required></select>
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
								  <textarea id="expensenote" class="form-control" placeholder="<?php echo trans('lang.note');?>"></textarea>
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
							<div class="row">
								<div class="col-lg-12 pt-3 pb-3">
									<button id="expensesave" class="btn btn-info btn-fill btn-wd"/><i class="ti-check"></i> <?php echo trans('lang.save_expense');?></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>	
</div>	
</div>  
<script src="{{ asset('js/category.js') }}"></script>
<script src="{{ asset('js/account.js') }}"></script>
<script src="{{ asset('js/general.js') }}"></script>
<script>


$(document).ready(function() {


	//do save income
   $("#formaddincome").validate({
   		rules: {
             incomename: {
                 required: true
             }
         },
	   	submitHandler: function(forms) {
	   		var form 		= new FormData();
	   		var name 		= $("#incomename").val();
	   		var amount 		= $("#incomeamount").val();
	   		var reference 	= $("#incomereference").val();
	   		var account 	= $("#incomeaccount").val();
	   		var category 	= $("#incomecategory").val();
	   		var subcategory = $("#incomesubcategory").val();
	   		var date 		= $("#idate").val();
	   		var note 		= $("#incomenote").val();
	   		var file  		= $('#incomefile')[0].files[0];

	   		form.append('incomename', name);
	   		form.append('incomeamount', amount);
	   		form.append('incomereference', reference);
	   		form.append('incomeaccount', account);
	   		form.append('incomecategory', category);
	   		form.append('incomesubcategory', subcategory);
	   		form.append('incomenote', note);
	   		form.append('incomedate', date);
	   		form.append('incomefile', file);

	   		$.ajax({
	   			type: "POST",
	   			url: "{{ url('transaction/saveincome')}}",
	   			data: form,
	   			contentType: 'multipart/form-data',
	   			processData: false,
	   			contentType: false,
	   			success: function(data) {
	   				console.log(data);
	   				$("#message2").css({'display':"block"});
	   				window.setTimeout(function(){location.reload()},2000);
	   			},
	   			error: function (error) {
	   				var errordata = error.responseJSON.incomefile[1];
	   				console.log(errordata);
	   				$("#message3").css({'display':"block"});
	   				$("#message3").html(errordata);
	   			}
	   		});
	   		return false;
	   	}
    });
	

	//do save expense
   $("#formaddexpense").validate({
   		rules: {
             incomename: {
                 required: true
             }
         },
	   	submitHandler: function(forms) {
	   		var form = new FormData();
				var name=$("#expensename").val();
				var amount=$("#expenseamount").val();
				var reference=$("#expensereference").val();
				var account=$("#expenseaccount").val();
				var category=$("#expensecategory").val();
				var subcategory=$("#expensesubcategory").val();
				var date=$("#edate").val();
				var note=$("#expensenote").val();
				var file  = $('#expensefile')[0].files[0];
				
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
		            url: "{{ url('transaction/saveexpense')}}",
		            data: form,
					contentType: 'multipart/form-data',
					processData: false,
		            contentType: false,
		            success: function(data) {
						console.log(data);
						$("#message7").css({'display':"block"});
						window.setTimeout(function(){location.reload()},2000)
		            },
					error: function (error) {
						console.log(error);
						var errordata = error.responseJSON.expensefile[1];
						$("#message5").css({'display':"block"});
						console.log(errordata);
						$("#message5").html(errordata);
					}
				});
	   		return false;
	   	}
    });


} );


</script>
@endsection