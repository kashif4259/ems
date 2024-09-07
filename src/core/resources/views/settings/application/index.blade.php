@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
			<div class="card col-lg-12">
					<div class="header">
						
							
							<h4 class="title"><?php echo trans('lang.application_setting');?></h4>
							
						
                    </div>
					
					<div class="content">
					<div id="message" style="display:none" class="alert alert-danger"><?php echo trans('lang.all_field_required');?></div>
					<div id="message2" style="display:none" class="alert alert-success"><?php echo trans('lang.data_updated');?></div>
						
						<form action="#"  name="formsetting" id="formsetting">
						<div class="row">
						<div class="col-lg-6">
								<div class="form-group">
								  <label><?php echo trans('lang.company_name');?></label>
								  <input type="text" class="form-control" name="company"  id="company" placeholder="<?php echo trans('lang.company_name');?>" required>
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.city');?></label>
								  <input type="text" class="form-control" name="city"  id="city" placeholder="<?php echo trans('lang.city');?>" required>
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.currency');?></label>
								  <input type="text" class="form-control" name="currency"  id="currency" placeholder="<?php echo trans('lang.currency');?>" required>
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.language');?></label>
								  <select name="language" id="language" class="form-control" required>
								  	<option value="en">English</option>
								  	<option value="es">Spanish</option>
								  	<option value="tk">Turkey</option>
								  	<option value="fr">French</option>
								  </select>
								</div>
						</div>
						<div class="col-lg-6">
								<div class="form-group">
								  <label><?php echo trans('lang.website');?></label>
								  <input type="text" class="form-control" name="website"  id="website" placeholder="<?php echo trans('lang.website');?>" required>
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.phone');?></label>
								  <input type="text" class="form-control" name="phone"  id="phone" placeholder="<?php echo trans('lang.phone');?>" required>
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.address');?></label>
								  <input type="text" class="form-control" name="address"  id="address" placeholder="<?php echo trans('lang.address');?>" required>
								</div>
								<div class="form-group">
								  <label><?php echo trans('lang.date_format');?></label>
								  <select name="dateformat" id="dateformat" class="form-control" required>
								  	<option value="d-m-Y">d-m-Y</option>
								  	<option value="m-d-Y">m-d-Y</option>
								  	<option value="Y-m-d">Y-m-d</option>
								  	<option value="d/m/Y">d/m/Y</option>
								  	<option value="m/d/Y">m/d/Y</option>
								  	<option value="Y/m/d">Y/m/d</option>
								  	<option value="d.m.Y">d.m.Y</option>
								  	<option value="m.d.Y">m.d.Y</option>
								  	<option value="Y.m.d">Y.m.d</option>
								  </select>
								</div>
						</div>

						<div class="col-lg-6" id="attachlogo">
								<div class="form-group col-lg-12">
								  <label class="filelabel">
									    <i class="fa fa-paperclip">
									    </i>
									    <span class="title">
									       <?php echo trans('lang.logo');?>
									    </span>
									    <input class="attachfile" id="logofile" name="logo" type="file" accept="image/*"/>
									</label>
								</div>
							</div>

						
						<div class="col-lg-6">
								<img id="logoimg" src="" style="width:257px;"/>
						</div>
						<div class="col-lg-6" style="padding-left:15px;padding-bottom:15px;">
							<button type="submit" class="btn btn-info btn-fill btn-wd" id="save"><i class="ti-check"></i> <?php echo trans('lang.save_settings');?></button>
						</div>
						</div>
						</form>
					
					</div>
			</div>
		</div>	
	</div>
</div>	

<script src="{{ asset('js/general.js') }}"></script>

<script>
$(document).ready(function() {
   
	$("#company").val(company);
	$("#city").val(city);
	$("#currency").val(currency);
	$("#phone").val(phone);
	$("#address").val(address);
	$("#website").val(website);
	$("#language").val(language);
	$("#dateformat").val(dateformat);
	$("#logoimg").attr("src",logo);

    $("#formsetting").validate({
     
      submitHandler: function(forms) {
        var form 			= new FormData();
		var name 			= $("#name").val();
		var company 		= $("#company").val();
		var city 			= $("#city").val();
		var currency 		= $("#currency").val();
		var address 		= $("#address").val();
		var phone 			= $("#phone").val();
		var website 		= $("#website").val();
		var language		= $("#language").val();
		var dateformat 		= $("#dateformat").val();
		var logo  			= $('#logofile')[0].files[0];
		
		
		form.append('company', company);
		form.append('city', city);
		form.append('currency', currency);
		form.append('address', address);
		form.append('website', website);
		form.append('phone', phone);
		form.append('language', language);
		form.append('dateformat', dateformat);
		form.append('logo', logo);

      	$.ajax({
			type: "POST",
            url: "{{ url('settings/saveapplication')}}",
            data: form,
			contentType: 'multipart/form-data',
			processData: false,
            contentType: false,
            success: function(data) {				
				$("#message2").css({'display':"block"});
				window.setTimeout(function(){location.reload()},2000)
            }
		});
        return false;
      }
    });

});	


	
</script>
@endsection		