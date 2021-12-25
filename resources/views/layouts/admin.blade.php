<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8" />
	<title>@yield('page_title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN PLUGIN CSS -->

	<link href="{{ URL::to('dist/assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
	{{--<link href="{{ URL::to('dist/assets/plugins/jquery-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />--}}

	{{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">--}}
	<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

	<link href="{{ URL::to('dist/assets/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::to('dist/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::to('dist/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" rel="stylesheet" type="text/css" />

	<link href="{{ URL::to('dist/assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" media="screen" />
	<link href="{{ URL::to('dist/assets/plugins/bootstrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::to('dist/assets/plugins/bootstrapv3/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="{{ URL::to('dist/assets/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::to('dist/assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" />

	<link href="{{ URL::to('dist/assets/plugins/bootstrap-select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- END PLUGIN CSS -->
	<!-- BEGIN CORE CSS FRAMEWORK -->
	<link href="{{ URL::to('dist/webarch/css/webarch.css') }}" rel="stylesheet" type="text/css" />
	<!-- END CORE CSS FRAMEWORK -->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
	<link href="{{ URL::to('css/main.css') }}" rel="stylesheet" type="text/css" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse ">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="navbar-inner">
		<div class="header-seperation">
			<ul class="nav pull-left notifcation-center visible-xs visible-sm">
				<li class="dropdown">
					<a href="#main-menu" data-webarch="toggle-left-side">
						<i class="material-icons">menu</i>
					</a>
				</li>
			</ul>
			<!-- BEGIN LOGO -->
			<a href="dashboard">
				<img src="{{ URL::to('dist/assets/img/logo.png') }}" class="logo" alt="" data-src="{{ URL::to('dist/assets/img/logo.png') }}" data-src-retina="{{ URL::to('dist/assets/img/logo2x.png') }}" width="106" height="21" />
			</a>
			<!-- END LOGO -->
			<ul class="nav pull-right notifcation-center">
				<li class="dropdown hidden-xs hidden-sm">
					<a href="dashboard" class="dropdown-toggle active" data-toggle="">
						<i class="material-icons">home</i>
					</a>
				</li>
				<li class="dropdown hidden-xs hidden-sm">
					<a href="email.html" class="dropdown-toggle">
						<i class="material-icons">email</i><span class="badge bubble-only"></span>
					</a>
				</li>
				<li class="dropdown visible-xs visible-sm">
					<a href="#" data-webarch="toggle-right-side">
						<i class="material-icons">chat</i>
					</a>
				</li>
			</ul>
		</div>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<div class="header-quick-nav">
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="pull-left">
				<ul class="nav quick-section">
					<li class="quicklinks">
						<a href="#" class="" id="layout-condensed-toggle">
							<i class="material-icons">menu</i>
						</a>
					</li>
				</ul>
				<ul class="nav quick-section">
					<li class="quicklinks  m-r-10">
						<a href="#" class="">
							<i class="material-icons">refresh</i>
						</a>
					</li>
					<li class="quicklinks">
						<a href="#" class="">
							<i class="material-icons">apps</i>
						</a>
					</li>
					<li class="quicklinks"> <span class="h-seperate"></span></li>
					<li class="quicklinks">
						<a href="#" class="" id="my-task-list" data-placement="bottom" data-content='' data-toggle="dropdown" data-original-title="Notifications">
							<i class="material-icons">notifications_none</i>
							<span class="badge badge-important bubble-only"></span>
						</a>
					</li>
					<li class="m-r-10 input-prepend inside search-form no-boarder">
						<span class="add-on"> <i class="material-icons">search</i></span>
						<input name="" type="text" class="no-boarder " placeholder="Search Dashboard" style="width:250px;">
					</li>
				</ul>
			</div>
			<div id="notification-list" style="display:none">
				<div style="width:300px">
					<div class="notification-messages info">
						<div class="user-profile">
							<img src="assets/img/profiles/d.jpg" alt="" data-src="assets/img/profiles/d.jpg" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35">
						</div>
						<div class="message-wrapper">
							<div class="heading">
								David Nester - Commented on your wall
							</div>
							<div class="description">
								Meeting postponed to tomorrow
							</div>
							<div class="date pull-left">
								A min ago
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="notification-messages danger">
						<div class="iconholder">
							<i class="icon-warning-sign"></i>
						</div>
						<div class="message-wrapper">
							<div class="heading">
								Server load limited
							</div>
							<div class="description">
								Database server has reached its daily capicity
							</div>
							<div class="date pull-left">
								2 mins ago
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="notification-messages success">
						<div class="user-profile">
							<img src="assets/img/profiles/h.jpg" alt="" data-src="assets/img/profiles/h.jpg" data-src-retina="assets/img/profiles/h2x.jpg" width="35" height="35">
						</div>
						<div class="message-wrapper">
							<div class="heading">
								You haveve got 150 messages
							</div>
							<div class="description">
								150 newly unread messages in your inbox
							</div>
							<div class="date pull-left">
								An hour ago
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<!-- END TOP NAVIGATION MENU -->
			<!-- BEGIN CHAT TOGGLER -->
			<div class="pull-right">
				<div class="chat-toggler sm">
					<div class="profile-pic">
						<img src="{{ URL::to('dist/assets/img/profiles/avatar_small.jpg') }}" alt="" data-src="{{ URL::to('dist/assets/img/profiles/avatar_small.jpg') }}" data-src-retina="{{ URL::to('dist/assets/img/profiles/avatar_small2x.jpg') }}"
						width="35" height="35" />
						<div class="availability-bubble online"></div>
					</div>
				</div>
				<ul class="nav quick-section ">
					<li class="quicklinks">
						<a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
							<i class="material-icons">tune</i>
						</a>
						<ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
							<li>
								<a href="user-profile.html"> My Account</a>
							</li>
							<li>
								<a href="calender.html">My Calendar</a>
							</li>
							<li>
								<a href="email.html"> My Inbox&nbsp;&nbsp;
									<span class="badge badge-important animated bounceIn">2</span>
								</a>
							</li>
							<li class="divider"></li>
							<li>
								{{--<a href="login.html"><i class="material-icons">power_settings_new</i>&nbsp;&nbsp;Log Out</a>--}}
								<a href="{{ route('admin.logout') }}"
										onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
									<i class="material-icons">power_settings_new</i> Logout
								</a>

								<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						</ul>
					</li>
					<li class="quicklinks"> <span class="h-seperate"></span></li>
					{{--<li class="quicklinks">--}}
						{{--<a href="#" class="chat-menu-toggle" data-webarch="toggle-right-side"><i class="material-icons">chat</i><span class="badge badge-important hide">1</span>--}}
						{{--</a>--}}
						{{--<div class="simple-chat-popup chat-menu-toggle hide">--}}
							{{--<div class="simple-chat-popup-arrow"></div>--}}
							{{--<div class="simple-chat-popup-inner">--}}
								{{--<div style="width:100px">--}}
									{{--<div class="semi-bold">David Nester</div>--}}
									{{--<div class="message">Hey you there </div>--}}
								{{--</div>--}}
							{{--</div>--}}
						{{--</div>--}}
					{{--</li>--}}
				</ul>
			</div>
			<!-- END CHAT TOGGLER -->
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar " id="main-menu">
		<!-- BEGIN MINI-PROFILE -->
		@include('partials.admin-sidebar')
	</div>
	<a href="#" class="scrollup">Scroll</a>
	{{--<div class="footer-widget">--}}
		{{--<div class="progress transparent progress-small no-radius no-margin">--}}
			{{--<div class="progress-bar progress-bar-success animate-progress-bar" data-percentage="79%" style="width: 79%;"></div>--}}
		{{--</div>--}}
		{{--<div class="pull-right">--}}
			{{--<div class="details-status"> <span class="animate-number" data-value="86" data-animation-duration="560">86</span>% </div>--}}
			{{--<a href="lockscreen.html"><i class="material-icons">power_settings_new</i></a></div>--}}
	{{--</div>--}}
	<!-- END SIDEBAR -->
	<!-- BEGIN PAGE CONTAINER-->
	<div class="page-content">
		<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
		<div id="portlet-config" class="modal hide">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button"></button>
				<h3>Widget Settings</h3>
			</div>
			<div class="modal-body"> Widget settings form goes here </div>
		</div>
		<div class="clearfix"></div>
		<div class="content">

			<ul class="breadcrumb">
				<li>
					<p>YOU ARE HERE</p>
				</li>
				<li><a href="#" class="active">Buttons</a> </li>
			</ul>
			<div class="page-title"> <i class="icon-custom-left"></i>
				<h3>@yield('page_heading') <span class="semi-bold"></span></h3>
			</div>

			@yield('content')

			<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">TCA</h4>
						</div>
						<div class="modal-body">
							<p>Loading...</p>
						</div>
						<div class="modal-footer">

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- BEGIN CHAT -->
	<div class="chat-window-wrapper">
		<div id="main-chat-wrapper" class="inner-content">
			<div class="chat-window-wrapper scroller scrollbar-dynamic" id="chat-users">
				<div class="chat-header">
					<div class="pull-left">
						<input type="text" placeholder="search">
					</div>
					<div class="pull-right">
						<a href="#" class="">
							<div class="iconset top-settings-dark "></div>
						</a>
					</div>
				</div>
				<div class="side-widget">
					<div class="side-widget-title">group chats</div>
					<div class="side-widget-content">
						<div id="groups-list">
							<ul class="groups">
								<li>
									<a href="#">
										<div class="status-icon green"></div>Office work</a>
								</li>
								<li>
									<a href="#">
										<div class="status-icon green"></div>Personal vibes</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="side-widget fadeIn">
					<div class="side-widget-title">favourites</div>
					<div id="favourites-list">
						<div class="side-widget-content">
							<div class="user-details-wrapper active" data-chat-status="online" data-chat-user-pic="assets/img/profiles/d.jpg" data-chat-user-pic-retina="assets/img/profiles/d2x.jpg" data-user-name="Jane Smith">
								<div class="user-profile">
									<img src="assets/img/profiles/d.jpg" alt="" data-src="assets/img/profiles/d.jpg" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35">
								</div>
								<div class="user-details">
									<div class="user-name">
										Jane Smith
									</div>
									<div class="user-more">
										Hello you there?
									</div>
								</div>
								<div class="user-details-status-wrapper">
									<span class="badge badge-important">3</span>
								</div>
								<div class="user-details-count-wrapper">
									<div class="status-icon green"></div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="user-details-wrapper" data-chat-status="busy" data-chat-user-pic="assets/img/profiles/d.jpg" data-chat-user-pic-retina="assets/img/profiles/d2x.jpg" data-user-name="David Nester">
								<div class="user-profile">
									<img src="assets/img/profiles/c.jpg" alt="" data-src="assets/img/profiles/c.jpg" data-src-retina="assets/img/profiles/c2x.jpg" width="35" height="35">
								</div>
								<div class="user-details">
									<div class="user-name">
										David Nester
									</div>
									<div class="user-more">
										Busy, Do not disturb
									</div>
								</div>
								<div class="user-details-status-wrapper">
									<div class="clearfix"></div>
								</div>
								<div class="user-details-count-wrapper">
									<div class="status-icon red"></div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="side-widget">
					<div class="side-widget-title">more friends</div>
					<div class="side-widget-content" id="friends-list">
						<div class="user-details-wrapper" data-chat-status="online" data-chat-user-pic="assets/img/profiles/d.jpg" data-chat-user-pic-retina="assets/img/profiles/d2x.jpg" data-user-name="Jane Smith">
							<div class="user-profile">
								<img src="assets/img/profiles/d.jpg" alt="" data-src="assets/img/profiles/d.jpg" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35">
							</div>
							<div class="user-details">
								<div class="user-name">
									Jane Smith
								</div>
								<div class="user-more">
									Hello you there?
								</div>
							</div>
							<div class="user-details-status-wrapper">
							</div>
							<div class="user-details-count-wrapper">
								<div class="status-icon green"></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="user-details-wrapper" data-chat-status="busy" data-chat-user-pic="assets/img/profiles/d.jpg" data-chat-user-pic-retina="assets/img/profiles/d2x.jpg" data-user-name="David Nester">
							<div class="user-profile">
								<img src="assets/img/profiles/h.jpg" alt="" data-src="assets/img/profiles/h.jpg" data-src-retina="assets/img/profiles/h2x.jpg" width="35" height="35">
							</div>
							<div class="user-details">
								<div class="user-name">
									David Nester
								</div>
								<div class="user-more">
									Busy, Do not disturb
								</div>
							</div>
							<div class="user-details-status-wrapper">
								<div class="clearfix"></div>
							</div>
							<div class="user-details-count-wrapper">
								<div class="status-icon red"></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="user-details-wrapper" data-chat-status="online" data-chat-user-pic="assets/img/profiles/d.jpg" data-chat-user-pic-retina="assets/img/profiles/d2x.jpg" data-user-name="Jane Smith">
							<div class="user-profile">
								<img src="assets/img/profiles/c.jpg" alt="" data-src="assets/img/profiles/c.jpg" data-src-retina="assets/img/profiles/c2x.jpg" width="35" height="35">
							</div>
							<div class="user-details">
								<div class="user-name">
									Jane Smith
								</div>
								<div class="user-more">
									Hello you there?
								</div>
							</div>
							<div class="user-details-status-wrapper">
							</div>
							<div class="user-details-count-wrapper">
								<div class="status-icon green"></div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="user-details-wrapper" data-chat-status="busy" data-chat-user-pic="assets/img/profiles/d.jpg" data-chat-user-pic-retina="assets/img/profiles/d2x.jpg" data-user-name="David Nester">
							<div class="user-profile">
								<img src="assets/img/profiles/h.jpg" alt="" data-src="assets/img/profiles/h.jpg" data-src-retina="assets/img/profiles/h2x.jpg" width="35" height="35">
							</div>
							<div class="user-details">
								<div class="user-name">
									David Nester
								</div>
								<div class="user-more">
									Busy, Do not disturb
								</div>
							</div>
							<div class="user-details-status-wrapper">
								<div class="clearfix"></div>
							</div>
							<div class="user-details-count-wrapper">
								<div class="status-icon red"></div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="chat-window-wrapper" id="messages-wrapper" style="display:none">
				<div class="chat-header">
					<div class="pull-left">
						<input type="text" placeholder="search">
					</div>
					<div class="pull-right">
						<a href="#" class="">
							<div class="iconset top-settings-dark "></div>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="chat-messages-header">
					<div class="status online"></div><span class="semi-bold">Jane Smith(Typing..)</span>
					<a href="#" class="chat-back"><i class="icon-custom-cross"></i></a>
				</div>
				<div class="chat-messages scrollbar-dynamic clearfix">
					<div class="inner-scroll-content clearfix">
						<div class="sent_time">Yesterday 11:25pm</div>
						<div class="user-details-wrapper ">
							<div class="user-profile">
								<img src="assets/img/profiles/d.jpg" alt="" data-src="assets/img/profiles/d.jpg" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35">
							</div>
							<div class="user-details">
								<div class="bubble">
									Hello, You there?
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="sent_time off">Yesterday 11:25pm</div>
						</div>
						<div class="user-details-wrapper ">
							<div class="user-profile">
								<img src="assets/img/profiles/d.jpg" alt="" data-src="assets/img/profiles/d.jpg" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35">
							</div>
							<div class="user-details">
								<div class="bubble">
									How was the meeting?
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="sent_time off">Yesterday 11:25pm</div>
						</div>
						<div class="user-details-wrapper ">
							<div class="user-profile">
								<img src="assets/img/profiles/d.jpg" alt="" data-src="assets/img/profiles/d.jpg" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35">
							</div>
							<div class="user-details">
								<div class="bubble">
									Let me know when you free
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="sent_time off">Yesterday 11:25pm</div>
						</div>
						<div class="sent_time ">Today 11:25pm</div>
						<div class="user-details-wrapper pull-right">
							<div class="user-details">
								<div class="bubble sender">
									Let me know when you free
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="sent_time off">Sent On Tue, 2:45pm</div>
						</div>
					</div>
				</div>
				<div class="chat-input-wrapper" style="display:none">
					<textarea id="chat-message-input" rows="1" placeholder="Type your message"></textarea>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- END CHAT -->
</div>
<!-- END CONTAINER -->
<!-- END CONTAINER -->
<script src="{{ URL::to('dist/assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
<!-- BEGIN JS DEPENDECENCIES-->
<script src="{{ URL::to('dist/assets/plugins/jquery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('dist/assets/plugins/bootstrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('dist/assets/plugins/jquery-block-ui/jqueryblockui.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('dist/assets/plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('dist/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('dist/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('dist/assets/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('dist/assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>


{{--<script src="//code.jquery.com/jquery-1.12.3.js"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>--}}
{{--<script	src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>--}}
{{--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">--}}
{{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">--}}
{{--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>--}}
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>



<script src="{{ URL::to('dist/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('dist/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('dist/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('dist/assets/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>

<script src="{{ URL::to('dist/assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js') }}" type="text/javascript"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- END CORE JS DEPENDECENCIES-->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="{{ URL::to('dist/webarch/js/webarch.js') }}" type="text/javascript"></script>
<script src="{{ URL::to('dist/assets/js/chat.js') }}" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS -->
<!-- include summernote css/js -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<script src="{{ URL::to('js/main.js') }}" type="text/javascript"></script>
</body>
</html>