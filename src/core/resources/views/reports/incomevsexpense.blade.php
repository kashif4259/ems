 @extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-4 pb-2" id="gettotal" data-url="{{ url('income/gettotal')}}">
				<div class="d-flex align-items-center">
					<div class="home-icon-content background-blue color-white p-3 rounded flex-fill">
						<p class="home-icon mb-0"><i class="ti-angle-double-up"></i></p>
					</div>
					<div class="background-grey p-3 rounded flex-fill">
						<p class="transactiontitle"><span class="currency"></span><span class="incomeyear"></span></p> 
						<p class="small-font mb-0"><?php echo trans('lang.in_this_year');?> </p>
					</div>
				</div>
			</div>

			<div class="col-md-4 pb-2">
				<div class="d-flex align-items-center" id="gettotal2" data-url="{{ url('expense/gettotal')}}">
					<div class="home-icon-content background-red color-white p-3 rounded flex-fill">
						<p class="home-icon mb-0"><i class="ti-angle-double-down"></i></p>
					</div>
					<div class="background-grey p-3 rounded flex-fill">
						<p class="transactiontitle"><span class="currency"></span><span class="expenseyear"></span></p> 
						<p class="small-font mb-0"><?php echo trans('lang.in_this_year');?> </p>
					</div>
				</div>
			</div>

			<div class="col-md-4 pb-2">
				<div class="d-flex align-items-center">
					<div class="home-icon-content background-green color-white p-3 rounded flex-fill">
						<p class="home-icon mb-0"><i class="ti-wallet"></i></p>
					</div>
					<div class="background-grey p-3 rounded flex-fill">
						<p class="transactiontitle"><span class="currency"></span><span class="totalbalance"></span></p> 
						<p class="small-font mb-0"><?php echo trans('lang.balance');?> <?php echo trans('lang.in_this_year');?> </p>
					</div>
				</div>
			</div>
		</div>
		
        <div class="row">
            <div class="col-lg-12 col-md-12 pt-3">
                <div class="card">
                    <div class="header">
						<h4 class="title"><?php echo trans('lang.income_vs_expense_reports');?></h4>
                    </div>
                    <div class="content">
						<canvas id="incomevsexpense"></canvas>
                    </div>
                </div>
            </div>
        </div>
		
    </div>
</div>	


<script src="{{ asset('js/general.js') }}"></script>
<script src="{{ asset('js/expense.js') }}"></script>
<script src="{{ asset('js/income.js') }}"></script>

<script>


$(document).ready(function() {

	
	
	//balance
	//expense total
	$.ajax({
        type: "GET",
        url: "{{ url('reports/getbalance')}}",
        dataType: "json",
        success: function (data) {
			$(".totalbalance").html(data.year);
			
        },
    });
	
	//incomevsexpense
	$.ajax({
        type: "GET",
        url: "{{ url('home/incomevsexpense')}}",
        dataType: "json",
        success: function (data) {
			var cincomevsexpense = document.getElementById("incomevsexpense");
			var incomevsexpense = new Chart(cincomevsexpense, {
				type: 'line',
				legendPosition: 'bottom',
				data: {
					labels: ["<?php echo trans('lang.jan');?>", "<?php echo trans('lang.feb');?>", "<?php echo trans('lang.mar');?>", "<?php echo trans('lang.apr');?>", "<?php echo trans('lang.may');?>", "<?php echo trans('lang.jun');?>", "<?php echo trans('lang.jul');?>", "<?php echo trans('lang.aug');?>", "<?php echo trans('lang.sep');?>", "<?php echo trans('lang.oct');?>", "<?php echo trans('lang.nov');?>", "<?php echo trans('lang.dec');?>"],
					datasets: [
					{
						label: '<?php echo trans('lang.income');?>',
						data: [data.ijan, data.ifeb, data.imar, data.iapr, data.imay, data.ijun,  data.ijul, data.iags, data.isep, data.iokt, data.inov, data.ides],
						backgroundColor: '#41D5E2',
						borderColor: '#41D5E2',
						borderWidth: 1
					},{
						label: '<?php echo trans('lang.expense');?>',
						data: [data.ejan, data.efeb, data.emar, data.eapr, data.emay, data.ejun, data.ejul, data.eags, data.esep, data.eokt, data.enov, data.edes],
						backgroundColor: '#FF5668',
						borderColor:	'#FF5668',
						borderWidth: 1
					}
					]
				},
				options: {
					 pieceLabel: {
					  // render 'label', 'value', 'percentage' or custom function, default is 'percentage'
					  render: 'label'
					 }, 
					legend: {
						   position: 'bottom',
						},
					tooltips: {
							mode: 'index',
							intersect: false,
							callbacks: {
								label: function(tooltipItem, data) {
									return currency+tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
								},
							}
						},
					hover: {
							mode: 'nearest',
							intersect: true
						},
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero:true,
								callback: function(value, index, values) {
								  if(parseInt(value) >= 1000){
									return  currency+value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
								  } else {
									return currency + value;
								  }
								}
							}
						}]
					}
				}
			});
			
        },
    });
		
} );

</script>
@endsection