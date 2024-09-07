@extends('layouts.app')
@section('content')
<div class="content">

		<div class="container-fluid">
			<div class="row">
					<div class="col-md-4 pb-2">
								<div class="d-flex align-items-stretch">
		                    <div class="home-icon-content background-blue color-white p-3 rounded flex-fill">
		                        <p class="home-icon mb-0"><i class="ti-angle-double-up"></i></p>
		                    </div>
		                    <div class="background-grey p-3 rounded flex-fill">
		                        <p class="transactiontitle"><span class="currency"></span><span id="incomemonth"></span></p> 
		                        <p class="small-font mb-0"><?php echo trans('lang.in_this_month');?> (<?php echo date("F")?>)</p>
		                    </div>
		                </div>
		            </div>

								<div class="col-md-4 pb-2">
		                <div class="d-flex align-items-stretch">
		                    <div class="home-icon-content background-red color-white p-3 rounded flex-fill">
		                        <p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
		                    </div>
		                    <div class="background-grey p-3 rounded flex-fill">
		                        <p class="transactiontitle"><span class="currency"></span><span id="expensemonth"></span></p> 
		                        <p class="small-font mb-0"><?php echo trans('lang.in_this_month');?> (<?php echo date("F")?>)</p>
		                    </div>
		                </div>
		            </div>

		            <div class="col-md-4 pb-2">
		                <div class="d-flex align-items-stretch">
		                    <div class="home-icon-content background-green color-white p-3 rounded flex-fill">
		                        <p class="home-icon mb-0"><i class="ti-wallet"></i></p>
		                    </div>
		                    <div class="background-grey p-3 rounded flex-fill">
		                        <p class="transactiontitle"><span class="currency"></span><span id="monthbalance"></span></p> 
		                        <p class="small-font mb-0"><?php echo trans('lang.balance');?> <?php echo trans('lang.in_this_month');?> (<?php echo date("F")?>)</p>
		                    </div>
		                </div>
		            </div>

		           
		            <div class="col-lg-12 col-md-11 pt-4">
		                <div class="card">
		                	<div class="header">
		                			<h4 class="title"><?php echo trans('lang.income_expense');?></h4> 
		                	</div>
		                	<div class="content">
								<div id="mycalendar"></div>
							</div>
		                </div>
		            </div>
			</div>

		</div>


</div>	
<script src="{{ asset('js/general.js') }}"></script>  
<script>

 document.addEventListener('DOMContentLoaded', function() {

 	$.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });

        var calendarEl = document.getElementById('mycalendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          headerToolbar:{
				left: 'title',
				right: 'prev,next,timeGridDay,dayGridMonth'
			},
		locale: language,	
    	eventSources: [
			
			{
			  url: "{{ url('income/getdatacalendar')}}",
			  color: '#41D5E2',
			  textColor: 'white'
			},
			{
			  url: "{{ url('expense/getdatacalendar')}}",
			  color: '#FF5668',
			  textColor: 'white'
			}
		],
		eventContent: function(arg) {
		  let italicEl = document.createElement('div')
		   italicEl.innerHTML = '<div class="p-2">'+arg.event.title + '<br>' +currency+ arg.event.extendedProps.amount + '</div>';

		  let arrayOfDomNodes = [ italicEl ]
		  return { domNodes: arrayOfDomNodes }
		},
		eventDidMount: function(arg) {
	        $(arg.el).tooltip({ 
		        title: arg.event.title + ' (' +currency+ arg.event.extendedProps.amount + ')',
		        placement: "top",
		        trigger: "hover",
		        container: "body"
		      });
	      }
        });

        	//reload data on click previous date
			var moment = calendar.getDate();
			var date   = moment.toISOString(); 
			   $.ajax({
					type: "POST",
		            url: "{{ url('income/gettotalfilterdate')}}",
		            data: {date:date},
		            success: function(data) {
									$('#monthbalance').html(data.monthbalance);
									$('.monthname').html(data.monthname);
									$('#incomemonth').html(data.monthincome);
									$('#expensemonth').html(data.monthexpense);
		            }
				});
			

			
		calendar.render();

      });





</script>
@endsection