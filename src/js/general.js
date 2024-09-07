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

		function attachedfile(type, e){
			//file input
		   	var labelVal = $(type.toString()+" .title").text();
		   	var oldfileName = $(type).val();
		   	fileName = e.target.value.split( '\\' ).pop();

		   	if (oldfileName == fileName) {return false;}
		   	var extension = fileName.split('.').pop();
		   	if ($.inArray(extension,['jpg','jpeg','png']) >= 0) {
		   		$(type.toString()+ " .filelabel i").removeClass().addClass('fa fa-file-image-o');
		   		$(type.toString()+ " .filelabel i," + type.toString()+" .filelabel .title").css({'color':'#1DC873'});
		   		$(type.toString()+ " .filelabel").css({'border':' 1px solid #1DC873'});
		   	}
		   	else if(extension == 'pdf'){
		   		$(type.toString()+ " .filelabel i").removeClass().addClass('fa fa-file-pdf-o');
		   		$(type.toString()+ " .filelabel i, " + type.toString()+" .filelabel .title").css({'color':'#FF5668'});
		   		$(type.toString()+ " .filelabel").css({'border':' 1px solid #FF5668'});

		   	}
		   	else if(extension == 'doc' || extension == 'docx'){
		   		$(type.toString()+ " .filelabel i").removeClass().addClass('fa fa-file-word-o');
		   		$(type.toString()+ " .filelabel i, " + type.toString()+" .filelabel .title").css({'color':'#41D5E2'});
		   		$(type.toString()+ " .filelabel").css({'border':' 1px solid #41D5E2'});
		   	}
		   	else{
		   		$(type.toString()+ ".filelabel i").removeClass().addClass('fa fa-file-o');
		   		$(type.toString()+ ".filelabel i, " + type.toString()+" .filelabel .title").css({'color':'#66615b'});
		   		$(type.toString()+ ".filelabel").css({'border':' 1px solid #66615b'});
		   	}

		   	if(fileName ){
		   		if (fileName.length > 10){
		   			$(type.toString()+ " .filelabel .title").text(fileName.slice(0,6)+'...'+extension);
		   		}
		   		else{
		   			$(type.toString()+ " .filelabel .title").text(fileName);
		   		}
		   	}
		   	else{
		   		$(type.toString()+ " .filelabel .title").text(labelVal);
		   	}
	}	

	
	var dateToday = new Date(); 
	$('.upcomingdate, #tdate').datepicker({
	            autoclose: true,
	            format: "yyyy-mm-dd",
	            todayHighlight: true,
	            startDate: '-0d',
	            maxDate: "+2Y",
	            defaultDate: "+1w",
	            numberOfMonths: 1 
	        });

	
	$('#idate, #edate, #editidate, #fromdate, #todate').datepicker({
		autoclose: true,
		format: "yyyy-mm-dd",
		todayHighlight: true
	});

	

	 jQuery.extend(jQuery.validator.messages, {
        required: "This field is required.",
        remote: "Please fix this field.",
        email: "Please enter a valid email address.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a valid number.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Please enter the same value again.",
        accept: "Please enter a value with a valid extension.",
        maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
        minlength: jQuery.validator.format("Please enter at least {0} characters."),
        rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
        range: jQuery.validator.format("Please enter a value between {0} and {1}."),
        max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
        min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
    });		



	 //error show
	$.fn.dataTable.ext.errMode = 'none';
	$('#data').on('error.dt', function(e, settings, techNote, message) {
		console.log( 'an error reported ', message);
		alert('Connection to database error, please refresh this page.');
	});

	//set default config datatables
	$.extend(true, $.fn.dataTable.defaults, {
		processing: true,
		serverSide: true, 
		'lengthMenu': [
		[10, 25, 50, 100, -1],
		['10', '25', '50', '100', 'Overall'
		]
		],
		processing: true,
		serverSide: true,
		'lengthMenu' : [
		[ 10, 25, 50,100, -1 ],
		[ '10', '25', '50','100', overall ]
		],  
		"language": {
			"decimal":        "",
			"emptyTable":     demptyTable,
			"info":           dshowing + "  _START_ " + dto + " _END_ " + dof + " _TOTAL_ " + dentries,
			"infoEmpty":      dinfoEmpty,
			"infoFiltered":   "(" + dfilter +  " _MAX_ " + total+ " " +dentries + ")",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     dshow+' '+ "_MENU_" + ' ' + dentries,
			"loadingRecords": dloadingRecords,
			"processing":     dprocessing,
			"search":         dsearch,
			"zeroRecords":    dzeroRecords,
			"paginate": {
				"first":      " ",
				"last":       dlast,
				"next":       dnext,
				"previous":   dprevious
			}
		},

		dom: "<'row'<'col-sm-9 text-left'B><'col-sm-3'f>>" +
		"<'row'<'col-sm-12'tr>>" +
		"<'d-flex justify-content-between flex-sm-row flex-column'<''l><''i><''p>>",
    });


    //delete function
    var getdelete = $('#getdelete').attr("data-url");

	$("#dodelete").click(function(e){
		var id=$("#iddelete").val();
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: getdelete,
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

	//delete sub cat
	 var getdeletesub = $('#getdeletesub').attr("data-url");
	 $("#subdodelete").click(function(e){	
		var id=$("#subiddelete").val();
		e.preventDefault();
		$.ajax({
			type: "POST",
            url: getdeletesub,
            data: {iddelete:id},
            dataType: "JSON",
            success: function(data) {
				var success = data.success;
				if(success=='false'){
					$("#message9").css({'display':"block"});
				} 
				if(success=='true'){
					$("#message7").css({'display':"block"});
				}
				$('#deletesub').modal('hide');
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

	$('#deletesub').on('show.bs.modal', function(e) {
            var $modal = $(this),
            id = $(e.relatedTarget).attr('customdata');
            $("#subiddelete").val(id);
        });

    $("#attachincome .attachfile").on('change',function (e) {
	 		var type = '#attachincome';
	 		attachedfile(type, e);
	});

	 $("#editattachincome .attachfile").on('change',function (e) {
	 		var type = '#editattachincome';
	 		attachedfile(type, e);
	});

	$("#attachexpense .attachfile").on('change',function (e) {
	 		var type = '#attachexpense';
	 		attachedfile(type, e);
	});

	$("#attachlogo .attachfile").on('change',function (e) {
	 		var type = '#attachlogo';
	 		attachedfile(type, e);
	});

	