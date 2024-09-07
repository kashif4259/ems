$(document).ready(function() {

var gettotal = $('#gettotal').attr("data-url");	
var gettotal2 = $('#gettotal2').attr("data-url");	
	//get expense
	$.ajax({
        type: "GET",
        url: gettotal,
        dataType: "json",
        success: function (html) {
			var objs = html;
			$("#overall").html(objs.totalbalance);
			$("#month").html(objs.month);
			$("#today").html(objs.day);
			$("#week").html(objs.week);
			$(".expenseyear").html(objs.year);

        },
    });

    $.ajax({
        type: "GET",
        url: gettotal2,
        dataType: "json",
        success: function (html) {
			var objs = html;
			$("#overall").html(objs.totalbalance);
			$("#month").html(objs.month);
			$("#today").html(objs.day);
			$("#week").html(objs.week);
			$(".expenseyear").html(objs.year);

        },
    });
});


