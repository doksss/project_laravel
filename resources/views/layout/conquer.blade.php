<!DOCTYPE html>
<!-- 
Template Name: Conquer - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 2.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/conquer-responsive-admin-dashboard-template/3716838?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
	<meta charset="utf-8" />
	<title>Conquer | Admin Dashboard Template</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="MobileOptimized" content="320">
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
	<link href="{{ asset('conquer/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('conquer/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('conquer/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('conquer/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
	<link href="{{ asset('conquer/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('conquer/plugins/fullcalendar/fullcalendar/fullcalendar.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('conquer/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN THEME STYLES -->
	<link href="{{ asset('conquer/css/style-conquer.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('conquer/css/style.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('conquer/css/style-responsive.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('conquer/css/plugins.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('conquer/css/pages/tasks.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('conquer/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color" />
	<link href="{{ asset('conquer/css/custom.css')}}" rel="stylesheet" type="text/css" />
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
	@yield('javascript')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="page-header-fixed">
	<!-- BEGIN HEADER -->
	<div class="header navbar navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="header-inner">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="index.html">
					<img src="{{ asset('conquer/img/logo.png')}}" alt="logo" />
				</a>
			</div>
			<form class="search-form search-form-header" role="form" action="index.html">
				<div class="input-icon right">
					<i class="icon-magnifier"></i>
					<input type="text" class="form-control input-sm" name="query" placeholder="Search...">
				</div>
			</form>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<img src="{{ asset('conquer/img/menu-toggler.png')}}" alt="" />
			</a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN NOTIFICATION DROPDOWN -->
				<li class="dropdown" id="header_notification_bar">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-bell"></i>
						<span class="badge badge-success">
							6 </span>
					</a>
					<ul class="dropdown-menu extended notification">
						<li>
							<p>
								You have 14 new notifications
							</p>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 250px;">
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-success">
											<i class="fa fa-plus"></i>
										</span>
										New user registered. <span class="time">
											Just now </span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-danger">
											<i class="fa fa-bolt"></i>
										</span>
										Server #12 overloaded. <span class="time">
											15 mins </span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-warning">
											<i class="fa fa-bell"></i>
										</span>
										Server #2 not responding. <span class="time">
											22 mins </span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-info">
											<i class="fa fa-bullhorn"></i>
										</span>
										Application error. <span class="time">
											40 mins </span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-danger">
											<i class="fa fa-bolt"></i>
										</span>
										Database overloaded 68%. <span class="time">
											2 hrs </span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-danger">
											<i class="fa fa-bolt"></i>
										</span>
										2 user IP blocked. <span class="time">
											5 hrs </span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-warning">
											<i class="fa fa-bell"></i>
										</span>
										Storage Server #4 not responding. <span class="time">
											45 mins </span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-info">
											<i class="fa fa-bullhorn"></i>
										</span>
										System Error. <span class="time">
											55 mins </span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="label label-sm label-icon label-danger">
											<i class="fa fa-bolt"></i>
										</span>
										Database overloaded 68%. <span class="time">
											2 hrs </span>
									</a>
								</li>
							</ul>
						</li>
						<li class="external">
							<a href="#">See all notifications <i class="fa fa-angle-right"></i></a>
						</li>
					</ul>
				</li>
				<!-- END NOTIFICATION DROPDOWN -->
				<!-- BEGIN INBOX DROPDOWN -->
				<li class="dropdown" id="header_inbox_bar">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-envelope-open"></i>
						<span class="badge badge-info">
							5 </span>
					</a>
					<ul class="dropdown-menu extended inbox">
						<li>
							<p>
								You have 12 new messages
							</p>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 250px;">
								<li>
									<a href="inbox.html?a=view">
										<span class="photo">
											<img src="{{ asset('conquer/img/avatar2.jpg')}}" alt="" />
										</span>
										<span class="subject">
											<span class="from">
												Lisa Wong </span>
											<span class="time">
												Just Now </span>
										</span>
										<span class="message">
											Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
									</a>
								</li>
								<li>
									<a href="inbox.html?a=view">
										<span class="photo">
											<img src="{{ asset('conquer/img/avatar3.jpg')}}" alt="" />
										</span>
										<span class="subject">
											<span class="from">
												Richard Doe </span>
											<span class="time">
												16 mins </span>
										</span>
										<span class="message">
											Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
									</a>
								</li>
								<li>
									<a href="inbox.html?a=view">
										<span class="photo">
											<img src="{{ asset('conquer/img/avatar1.jpg')}}" alt="" />
										</span>
										<span class="subject">
											<span class="from">
												Bob Nilson </span>
											<span class="time">
												2 hrs </span>
										</span>
										<span class="message">
											Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
									</a>
								</li>
								<li>
									<a href="inbox.html?a=view">
										<span class="photo">
											<img src="{{ asset('conquer/img/avatar2.jpg')}}" alt="" />
										</span>
										<span class="subject">
											<span class="from">
												Lisa Wong </span>
											<span class="time">
												40 mins </span>
										</span>
										<span class="message">
											Vivamus sed auctor 40% nibh congue nibh... </span>
									</a>
								</li>
								<li>
									<a href="inbox.html?a=view">
										<span class="photo">
											<img src="{{ asset('conquer/img/avatar3.jpg')}}" alt="" />
										</span>
										<span class="subject">
											<span class="from">
												Richard Doe </span>
											<span class="time">
												46 mins </span>
										</span>
										<span class="message">
											Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
									</a>
								</li>
							</ul>
						</li>
						<li class="external">
							<a href="inbox.html">See all messages <i class="fa fa-angle-right"></i></a>
						</li>
					</ul>
				</li>
				<!-- END INBOX DROPDOWN -->
				<!-- BEGIN TODO DROPDOWN -->
				<li class="dropdown" id="header_task_bar">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-calendar"></i>
						<span class="badge badge-warning">
							5 </span>
					</a>
					<ul class="dropdown-menu extended tasks">
						<li>
							<p>
								You have 12 pending tasks
							</p>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 250px;">
								<li>
									<a href="#">
										<span class="task">
											<span class="desc">
												New release v1.2 </span>
											<span class="percent">
												30% </span>
										</span>
										<span class="progress">
											<span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													40% Complete </span>
											</span>
										</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="task">
											<span class="desc">
												Application deployment </span>
											<span class="percent">
												65% </span>
										</span>
										<span class="progress progress-striped">
											<span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													65% Complete </span>
											</span>
										</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="task">
											<span class="desc">
												Mobile app release </span>
											<span class="percent">
												98% </span>
										</span>
										<span class="progress">
											<span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													98% Complete </span>
											</span>
										</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="task">
											<span class="desc">
												Database migration </span>
											<span class="percent">
												10% </span>
										</span>
										<span class="progress progress-striped">
											<span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													10% Complete </span>
											</span>
										</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="task">
											<span class="desc">
												Web server upgrade </span>
											<span class="percent">
												58% </span>
										</span>
										<span class="progress progress-striped">
											<span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													58% Complete </span>
											</span>
										</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="task">
											<span class="desc">
												Mobile development </span>
											<span class="percent">
												85% </span>
										</span>
										<span class="progress progress-striped">
											<span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													85% Complete </span>
											</span>
										</span>
									</a>
								</li>
								<li>
									<a href="#">
										<span class="task">
											<span class="desc">
												New UI release </span>
											<span class="percent">
												18% </span>
										</span>
										<span class="progress progress-striped">
											<span style="width: 18%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
												<span class="sr-only">
													18% Complete </span>
											</span>
										</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="external">
							<a href="#">See all tasks <i class="fa fa-angle-right"></i></a>
						</li>
					</ul>
				</li>
				<!-- END TODO DROPDOWN -->
				<li class="devider">
					&nbsp;
				</li>
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<li class="dropdown user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img alt="" src="{{ asset('conquer/img/avatar3_small.jpg')}}" />
						<span class="username username-hide-on-mobile">{{ Auth::user()->name }} </span>
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="extra_profile.html"><i class="fa fa-user"></i> My Profile</a>
						</li>
						<li>
							<a href="page_calendar.html"><i class="fa fa-calendar"></i> My Calendar</a>
						</li>
						<li>
							<a href="page_inbox.html"><i class="fa fa-envelope"></i> My Inbox <span class="badge badge-danger">
									3 </span>
							</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-tasks"></i> My Tasks <span class="badge badge-success">
									7 </span>
							</a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-key"></i>
								{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</li>
					</ul>
				</li>
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	<div class="clearfix">
	</div>
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			<div class="page-sidebar navbar-collapse collapse">
				<!-- BEGIN SIDEBAR MENU -->
				<!-- DOC: for circle icon style menu apply page-sidebar-menu-circle-icons class right after sidebar-toggler-wrapper -->
				<ul class="page-sidebar-menu">
					<li class="sidebar-toggler-wrapper">
						<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
						<div class="sidebar-toggler">
						</div>
						<div class="clearfix">
						</div>
						<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					</li>
					<li class="sidebar-search-wrapper">
						<form class="search-form" role="form" action="index.html" method="get">
							<div class="input-icon right">
								<i class="icon-magnifier"></i>
								<input type="text" class="form-control" name="query" placeholder="Search...">
							</div>
						</form>
					</li>
					<li class="start active ">
						<a href="{{route('hotels.index')}}">
							<i class="icon-home"></i>
							<span class="title">Hotel</span>
							<span class="selected"></span>
						</a>
					</li>
					<li>
						<a href="{{route('customer.index')}}">
							<i class="icon-puzzle"></i>
							<span class="title">Customer</span>
							<span class="selected"></span>
						</a>
					</li>
					<li>
						<a href="{{route('product.index')}}">
							<i class="icon-present"></i>
							<span class="title">Product</span>
							<span class="selected"></span>
						</a>
					</li>
					<li>
						<a href="{{route('transaction.index')}}">
							<i class="icon-calendar"></i>
							<span class="title">Transaction</span>
							<span class="selected"></span>
						</a>
					</li>
					<li>
						<a href="{{route('type.index')}}">
							<i class="icon-docs"></i>
							<span class="title">Type</span>
							<span class="selected"></span>
						</a>
					</li>
				</ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				@yield("content")
			</div>
		</div>

		<!-- END CONTENT -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-inner">
			2013 &copy; Conquer by keenthemes.
		</div>
		<div class="footer-tools">
			<span class="go-top">
				<i class="fa fa-angle-up"></i>
			</span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<script src="{{ asset('conquer/plugins/jquery-1.11.0.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jquery-migrate-1.2.1.min.js')}}" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="{{ asset('conquer/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="{{ asset('conquer/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jquery.peity.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jquery.pulsate.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jquery-knob/js/jquery.knob.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/flot/jquery.flot.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/flot/jquery.flot.resize.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/bootstrap-daterangepicker/moment.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/gritter/js/jquery.gritter.js')}}" type="text/javascript"></script>
	<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
	<script src="{{ asset('conquer/plugins/fullcalendar/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="{{ asset('conquer/scripts/app.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/scripts/index.js')}}" type="text/javascript"></script>
	<script src="{{ asset('conquer/scripts/tasks.js')}}" type="text/javascript"></script>
	<!-- END PAGE LEVEL SCRIPTS -->
	<script>
		jQuery(document).ready(function() {
			App.init(); // initlayout and core plugins
			Index.init();
			Index.initJQVMAP(); // init index page's custom scripts
			Index.initCalendar(); // init index page's custom scripts
			Index.initCharts(); // init index page's custom scripts
			Index.initChat();
			Index.initMiniCharts();
			Index.initPeityElements();
			Index.initKnowElements();
			Index.initDashboardDaterange();
			Tasks.initDashboardWidget();
		});
	</script>
	@yield('js')
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>