        
<!DOCTYPE html>
<html id="locale" lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title class="company"></title>

	  <!-- Bootstrap core CSS     -->
    <!--<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet">
    
    <!--  Paper Dashboard core CSS    -->

    <link href="{{ asset('css/paper-dashboard.css') }}" rel="stylesheet"/>
	
	<!--  Datatables    -->
	<link href="{{ asset('plugin/datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/themify-icons.css') }}"  rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}"  rel="stylesheet">
	<link href="{{ asset('plugin/datatables/css/buttons.dataTables.min.css') }}"  rel="stylesheet">
	<link href="{{ asset('plugin/datatables/css/buttons.bootstrap.min.css') }}"  rel="stylesheet">
	<link href="{{ asset('plugin/morris/morris.css') }}"  rel="stylesheet">
	<link href="{{ asset('plugin/fullcalendar2/main.css') }}"  rel="stylesheet">

	<!-- Scripts -->


     
     <!-- Script -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('plugin/datatables/js/datatables.min.js') }}"></script>
    

    <script src="{{ asset('plugin/jqueryvalidation/jquery.validate.js') }}"></script>
    <script src="{{ asset('plugin/jqueryvalidation/additional-methods.js') }}"></script>
	<script src="{{ asset('plugin/chartjs/Chart.min.js') }}"></script>
	<script src="{{ asset('plugin/morris/morris.min.js') }}"></script>
	<script src="{{ asset('plugin/jscolor/jscolor.js') }}"></script>
	<script src="{{ asset('plugin/morris/raphael-min.js') }}"></script>
	<script src="{{ asset('plugin/chartjs/Chart.PieceLabel.js') }}"></script>
    <script src="{{ asset('plugin/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugin/fullcalendar2/main.min.js') }}"></script>

    <script>
        var company     = "{{$data[0]->company}}";
        var currency    = "{{$data[0]->currency}}";
        var language    = "{{$data[0]->languages}}";
        var website     = "{{$data[0]->website}}";
        var phone       = "{{$data[0]->phone}}";
        var city        = "{{$data[0]->city}}";
        var logo        = "{{url('/upload/').'/'.$data[0]->logo}}";
        var address     = "{{$data[0]->address}}";
        var dateformat  = "{{$data[0]->dateformat}}";

        //lang for datatables
        var overall             = "{{trans('lang.overall')}}";
        var demptyTable         = "{{trans('lang.demptyTable')}}";
        var dshowing            = "{{trans('lang.dshowing')}}";
        var dto                 = "{{trans('lang.dto')}}";
        var dof                 = "{{trans('lang.dof')}}";
        var dentries            = "{{trans('lang.dentries')}}";
        var dinfoEmpty          = "{{trans('lang.dinfoEmpty')}}";
        var dfilter             = "{{trans('lang.dfilter')}}";
        var total               = "{{trans('lang.total')}}";
        var dshow               = "{{trans('lang.dshow')}}";
        var dloadingRecords     = "{{trans('lang.dloadingRecords')}}";
        var dprocessing         = "{{trans('lang.dprocessing')}}";
        var dsearch             = "{{trans('lang.dsearch')}}";
        var dzeroRecords        = "{{trans('lang.dzeroRecords')}}";
        var dlast               = "{{trans('lang.dlast')}}";
        var dnext               = "{{trans('lang.dnext')}}";
        var dprevious           = "{{trans('lang.dprevious')}}";
    </script>

    <script>
    $(document).ready(function() {

        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });

        $("body").tooltip({ selector: '[data-toggle=tooltip]' });
        $(".company").html(company);
        $("#city").val(city);
        $(".currency").val(currency);
        $(".currency").html(currency);
        $("#phone").val(phone);
        $("#address").val(address);    
        $("#locale").attr(language);  
        $("#website").val(website);
       });
    </script>
</head>
<body>
 
        
<div class="sidebar">	
<div class=" sidebar-wrapper">
    <div class="logo">
                <img class="logoimg" src="{{url('/upload/').'/'.$data[0]->logo}}" style="width:200px"/>
        </a>
    </div>
    <ul class="nav">
			
            <li class="{{ Request::is( 'home') ? 'active' : '' }}">
                <a href="{{ URL::to( 'home') }}" >
                    <i class="ti-panel"></i>
					<?php echo trans('lang.dashboard');?>
                </a>
            </li>
			@if(Auth::check())
				@if (Auth::user()->isrole('2'))
			 <li class="{{ Request::is( 'transaction') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'transaction') }}" >
                    <i class="ti-direction-alt"></i>
					<?php echo trans('lang.transactions');?>
                </a>
            </li>
				@endif
			@endif
			@if(Auth::check())
				@if (Auth::user()->isrole('3'))
			 <li class="{{ Request::is( 'income') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'income') }}" >
                    <i class="ti-stats-up"></i>
					<?php echo trans('lang.income');?>
                </a>
            </li>
				@endif
			@endif
            @if(Auth::check())
                @if (Auth::user()->isrole('19'))
             <li class="{{ Request::is( 'upcomingincome') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'upcomingincome') }}" >
                    <i class="ti-angle-double-up"></i>
                    <?php echo trans('lang.upcomingincome');?>
                </a>
            </li>
                @endif
            @endif
			@if(Auth::check())
				@if (Auth::user()->isrole('4'))
			 <li class="{{ Request::is( 'expense') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'expense') }}" >
                    <i class="ti-stats-down"></i>
					<?php echo trans('lang.expense');?>
                </a>
            </li>
				@endif
			@endif
             @if(Auth::check())
                @if (Auth::user()->isrole('20'))
             <li class="{{ Request::is( 'upcomingexpense') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'upcomingexpense') }}" >
                    <i class="ti-angle-double-down"></i>
                    <?php echo trans('lang.upcomingexpense');?>
                </a>
            </li>
                @endif
            @endif
			@if(Auth::check())
				@if (Auth::user()->isrole('5'))
			 <li class="{{ Request::is( 'account') || Request::is('account/detail*') ? 'active' : '' }}">
                <a href="{{ URL::to( 'account') }}" >
                    <i class="ti-wallet"></i>
					<?php echo trans('lang.accounts');?>
                </a>
            </li>
				@endif
			@endif
			@if(Auth::check())
				@if (Auth::user()->isrole('6'))
			 <li class="{{ Request::is( 'budget') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'budget') }}" >
                    <i class="ti-package"></i>
					<?php echo trans('lang.track_budget');?> 
                </a>
            </li>
				@endif
			@endif
			@if(Auth::check())
				@if (Auth::user()->isrole('7'))
			 <li class="{{ Request::is( 'goals') ? 'active' : '' }}">
                <a href="{{ URL::to( 'goals') }}" >
                    <i class="ti-cup"></i>
					<?php echo trans('lang.set_goals');?>
                </a>
            </li>
				@endif
			@endif
			@if(Auth::check())
				@if (Auth::user()->isrole('8'))
			<li class="{{ Request::is( 'calendar') ? 'active' : '' }}">
                <a href="{{ URL::to( 'calendar') }}" >
                    <i class="ti-calendar"></i>
					<?php echo trans('lang.calendar');?>
                </a>
            </li>
				@endif
			@endif
			
             @if(Auth::check())
                            @if (Auth::user()->isrole('11') || Auth::user()->isrole('12') || Auth::user()->isrole('13') || Auth::user()->isrole('14') || Auth::user()->isrole('15') || Auth::user()->isrole('16') || Auth::user()->isrole('19') || Auth::user()->isrole('20'))  

			 <li class="{{ Request::is( 'reports/allreports') || Request::is('reports/income') || Request::is('reports/expense') || Request::is('reports/incomevsexpense') || Request::is('reports/upcomingincome') || Request::is('reports/incomemonth') || Request::is('reports/expensemonth') || Request::is('reports/account') || Request::is('reports/upcomingexpense') ? 'active' : '' }}">
                <a href="{{ URL::to( 'reports/allreports') }}" >
                    <i class="ti-pie-chart"></i>
					<?php echo trans('lang.report_menu');?>
                </a>
            </li>
            @endif
            @endif

				 @if(Auth::check())
                            @if (Auth::user()->isrole('9') || Auth::user()->isrole('10') )   
			 <li>
                 <a data-toggle="collapse" href="#category" class="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? '' : 'collapsed' }}" aria-expanded="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? 'true' : 'false' }}">
                    <i class="ti-flag-alt"></i>
                    <?php echo trans('lang.category');?><b class="caret"></b>
                </a>
				<div class="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? 'collapse in' : 'collapse' }}" id="category" aria-expanded="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? 'true' : 'false' }}" style="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? '' : 'height: 0px;' }}">
                    <ul class="nav">
						@if(Auth::check())
							@if (Auth::user()->isrole('9'))
                          <li class="{{ Request::is( 'incomecategory') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'incomecategory') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.income_category');?></span>
                            </a>
                        </li>
							@endif
						@endif
						@if(Auth::check())
							@if (Auth::user()->isrole('10'))
						<li class="{{ Request::is( 'expensecategory') ? 'active' : '' }}">
                           <a href="{{ URL::to( 'expensecategory') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.expense_category');?></span>
                            </a>
                        </li>
							@endif
						@endif
                    </ul>
                </div>
            </li>
                @endif
            @endif

			 <li>
                 <a data-toggle="collapse" href="#settings" class="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? '' : 'collapsed' }}" aria-expanded="{{Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? 'true' : 'false' }}">
                    <i class="ti-settings"></i>
                    <?php echo trans('lang.setting_menu');?><b class="caret"></b>
                </a>
				<div class="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? 'collapse in' : 'collapse' }}" id="settings" aria-expanded="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? 'true' : 'false' }}" style="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? '' : 'height: 0px;' }}">
                    <ul class="nav">
                        <li class="{{ Request::is( 'settings/profile') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'settings/profile') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.profile_settings');?></span>
                            </a>
                        </li>
						@if(Auth::check())
							@if (Auth::user()->isrole('17'))
						<li class="{{ Request::is( 'settings/allusers') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'settings/allusers') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.user_role');?></span>
                            </a>
                        </li>
							@endif
						@endif
						@if(Auth::check())
							@if (Auth::user()->isrole('18'))
                           <li class="{{ Request::is( 'settings/application') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'settings/application') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.application_setting');?></span>
                            </a>
                        </li>
							@endif
						@endif	
                    </ul>
                </div>
    </ul>
</div>
</div>
<div class="main-panel">
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="d-none navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a class="navbar-brand" href="#"><p class="company mb-0"></p></a>
        </div>

        <!--responsive-->
        <div class="collapse" id="myNavbar">
        <ul class="nav">
            
            <li  class="{{ Request::is( 'home') ? 'active' : '' }}">
                <a  href="{{ URL::to( 'home') }}" >
                    <?php echo trans('lang.dashboard');?>
                </a>
            </li>
            @if(Auth::check())
                @if (Auth::user()->isrole('2'))
             <li class="{{ Request::is( 'transaction') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'transaction') }}" >
                   <?php echo trans('lang.transactions');?>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('3'))
             <li class="{{ Request::is( 'income') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'income') }}" >
                    <?php echo trans('lang.income');?>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('19'))
             <li class="{{ Request::is( 'upcomingincome') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'upcomingincome') }}" >
                    <?php echo trans('lang.upcomingincome');?>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('4'))
             <li class="{{ Request::is( 'expense') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'expense') }}" >
                    <?php echo trans('lang.expense');?>
                </a>
            </li>
                @endif
            @endif
             @if(Auth::check())
                @if (Auth::user()->isrole('20'))
             <li class="{{ Request::is( 'upcomingexpense') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'upcomingexpense') }}" >
                    <?php echo trans('lang.upcomingexpense');?>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('5'))
             <li class="{{ Request::is( 'account') || Request::is( 'account/detail*') ? 'active' : '' }}">
                <a href="{{ URL::to( 'account') }}" >
                    <?php echo trans('lang.accounts');?>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('6'))
             <li class="{{ Request::is( 'budget') ? 'active' : '' }}">
                 <a href="{{ URL::to( 'budget') }}" >
                    <?php echo trans('lang.track_budget');?>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('7'))
             <li class="{{ Request::is( 'goals') ? 'active' : '' }}">
                <a href="{{ URL::to( 'goals') }}" >
                    <?php echo trans('lang.set_goals');?>
                </a>
            </li>
                @endif
            @endif
            @if(Auth::check())
                @if (Auth::user()->isrole('8'))
            <li class="{{ Request::is( 'calendar') ? 'active' : '' }}">
                <a href="{{ URL::to( 'calendar') }}" >
                    <?php echo trans('lang.calendar');?>
                </a>
            </li>
                @endif
            @endif
            
            @if(Auth::check())
                            @if (Auth::user()->isrole('11') || Auth::user()->isrole('12') || Auth::user()->isrole('13') || Auth::user()->isrole('14') || Auth::user()->isrole('15') || Auth::user()->isrole('16') || Auth::user()->isrole('19') || Auth::user()->isrole('20'))

             <li class="{{ Request::is( 'reports/allreports') || Request::is('reports/income') || Request::is('reports/expense') || Request::is('reports/incomevsexpense') || Request::is('reports/upcomingincome') || Request::is('reports/incomemonth') || Request::is('reports/expensemonth') || Request::is('reports/account') || Request::is('reports/upcomingexpense') ? 'active' : '' }}">
                <a href="{{ URL::to( 'reports/allreports') }}" >
                    <?php echo trans('lang.report_menu');?>
                </a>
            </li>
            @endif
            @endif
             
              @if(Auth::check())
                            @if (Auth::user()->isrole('9') || Auth::user()->isrole('10') )   

             <li>
                 <a data-toggle="collapse" href="#categorys" class="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? '' : 'collapsed' }}" aria-expanded="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? 'true' : 'false' }}">
                    <p><?php echo trans('lang.category');?><b class="caret"></b></p>
                </a>
                <div class="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? 'collapse in' : 'collapse' }}" id="categorys" aria-expanded="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? 'true' : 'false' }}" style="{{ Request::is( 'incomecategory') || Request::is( 'expensecategory') ? '' : 'height: 0px;' }}">
                    <ul class="nav">
                        @if(Auth::check())
                            @if (Auth::user()->isrole('9'))
                          <li class="{{ Request::is( 'incomecategory') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'incomecategory') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.income_category');?></span>
                            </a>
                        </li>
                            @endif
                        @endif
                        @if(Auth::check())
                            @if (Auth::user()->isrole('10'))
                        <li class="{{ Request::is( 'expensecategory') ? 'active' : '' }}">
                           <a href="{{ URL::to( 'expensecategory') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.expense_category');?></span>
                            </a>
                        </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </li>
             @endif
                        @endif

             <li>
                 <a data-toggle="collapse" href="#settingss" class="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? '' : 'collapsed' }}" aria-expanded="{{Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? 'true' : 'false' }}">
                    <p><?php echo trans('lang.setting_menu');?><b class="caret"></b></p>
                </a>
                <div class="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? 'collapse in' : 'collapse' }}" id="settingss" aria-expanded="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? 'true' : 'false' }}" style="{{ Request::is( 'settings/profile') || Request::is( 'settings/allusers') || Request::is( 'settings/application') ? '' : 'height: 0px;' }}">
                    <ul class="nav">
                        <li class="{{ Request::is( 'settings/profile') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'settings/profile') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.profile_settings');?></span>
                            </a>
                        </li>
                        @if(Auth::check())
                            @if (Auth::user()->isrole('17'))
                        <li class="{{ Request::is( 'settings/allusers') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'settings/allusers') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.user_role');?></span>
                            </a>
                        </li>
                            @endif
                        @endif
                        @if(Auth::check())
                            @if (Auth::user()->isrole('18'))
                           <li class="{{ Request::is( 'settings/application') ? 'active' : '' }}">
                            <a href="{{ URL::to( 'settings/application') }}" >
                                <span class="sidebar-mini"><i class="ti-angle-right"></i></span>
                                <span class="sidebar-normal"><?php echo trans('lang.application_setting');?></span>
                            </a>
                        </li>
                            @endif
                        @endif  


                    </ul>
                </div>
                <li>
                    <a href="{{ URL::to( 'logout') }}">
                        
                        <?php echo trans('lang.logout');?>
                    </a>
                </li>
            </ul>
    </div>
        <!--end responsive-->

        <div class="d-none d-md-block ">

            <ul class="right-nav mb-0">
				<li>
                    <a href="#">
                        <i class="ti-user"></i>
                        Welcome, {{ Auth::user()->name }}
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to( 'settings/profile') }}">
                        <i class="ti-settings"></i>
                        <?php echo trans('lang.profile_settings');?>
                    </a>
                </li>
				<li>
                    <a href="{{ URL::to( 'logout') }}">
                        <i class="ti-back-right"></i>
                        <?php echo trans('lang.logout');?>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>

        @yield('content')
<footer class="footer">
    <div class="container-fluid">
        
        <div class="copyright pull-right">
            
        </div>
    </div>
</footer>
</div>

</body>
</html>

