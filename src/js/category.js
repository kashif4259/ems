$(document).ready(function() {

var incomecategory 		= $('#incomecategory').attr("data-url");
var expensecategory 	= $('#expensecategory').attr("data-url");
var incomesubcategory 	= $('#incomesubcategory').attr("data-url");
var expensesubcategory 	= $('#expensesubcategory').attr("data-url");


//enable search category
//$('#category').select2();
$('.subcategoryid').select2();
$('#subcategory').select2();
$('#incomecategory').select2();
$('#expensecategory').select2();
$('#incomesubcategory').select2();
$('#expensesubcategory').select2();
$('#editincomecategory').select2();
$('#editincomesubcategory').select2();

//get income category
	$.ajax({
        type: "GET",
        url: incomecategory,
        dataType: "json",
        success: function (html) {
			var objs = html.data;
			jQuery.each(objs, function (index, record) {
                var id = decodeURIComponent(record.categoryid);
                var name = decodeURIComponent(record.name);
				//alert(name);
                $("#incomecategory").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
                 $("#editincomecategory").append($("<option></option>")
                    .attr("value",id)
                    .text(name));   
                 $("#form #category").append($("<option></option>")
                    .attr("value",id)
                    .text(name));    
                 $("#addsub #category").append($("<option></option>")
                    .attr("value",id)
                    .text(name)); 
                $("#editcategory").append($("<option></option>")
                    .attr("value",id)
                    .text(name));                  
            });
        },
    });
	
	//get expense category
	$.ajax({
        type: "GET",
        url: expensecategory,
        dataType: "json",
        success: function (html) {
			var objs = html.data;
			jQuery.each(objs, function (index, record) {
                var id = decodeURIComponent(record.categoryid);
                var name = decodeURIComponent(record.name);
                $("#expensecategory").append($("<option></option>")
                    .attr("value",id)
                    .text(name));
               $("#editexpensecategory").append($("<option></option>")
                    .attr("value",id)
                    .text(name));    
               $("#addsub #category").append($("<option></option>")
                    .attr("value",id)
                    .text(name)); 
                $("#editcategory").append($("<option></option>")
                    .attr("value",id)
                    .text(name));                      
            });
        },
    });
	
	//get income sub category
	$("#incomecategory, #editincomecategory").change(function(e){
		var id = $(this).val();
		$.ajax({
        type: "POST",
        url: incomesubcategory,
        dataType: "json",
        data: {id:id},
        success: function (html) {
			var objs = html.message;
			var options;
			if (objs.length === 0) {
				$('#incomesubcategory, #editincomesubcategory').empty();
			}
			$.each(objs, function(index, object) {
					options += '<option value="' + object.subcategoryid + '">' + object.name + '</option>';
				});
				$('#incomesubcategory, #editincomesubcategory').html(options);
			},
		});
	});
	
	//get expense sub category
	$("#expensecategory").change(function(e){
		var id = $(this).val();
		$.ajax({
        type: "POST",
        url: expensesubcategory,
        dataType: "json",
        data: {id:id},
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
			},
		});
	});

});