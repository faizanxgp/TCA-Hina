<div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
	<div class="user-info-wrapper sm">
		<div class="profile-wrapper sm">
			<img src="{{ URL::to('dist/assets/img/profiles/avatar.jpg') }}" alt="" data-src="{{ URL::to('dist/assets/img/profiles/avatar.jpg') }}" data-src-retina="{{ URL::to('dist/assets/img/profiles/avatar2x.jpg') }}" width="69" height="69" />
			<div class="availability-bubble online"></div>
		</div>
		<div class="user-info sm">
			<div class="username">{{ Auth::user()->name }} <span class="semi-bold"></span></div>
			<div class="status">Admin</div>
		</div>
	</div>
	<!-- END MINI-PROFILE -->
	<!-- BEGIN SIDEBAR MENU -->
	<p class="menu-title sm">BROWSE <span class="pull-right"><a href="javascript:;"><i class="material-icons">refresh</i></a></span></p>


	<ul>
		<li class="start "> <a href="{{ route('admin.dashboard') }}"><i class="material-icons">home</i> <span class="title">Admin Dashboard</span> <span class="selected"></span> </a>

		</li>
		<li>
			<a href="{{ route('admin.events') }}" title="Events"> <i class="material-icons">panorama_horizontal</i> <span class="title">Events</span> </a>
		</li>

		@if( Auth::user()->level == 1)
		<li>
			<a href="{{ route('admin.admins') }}" title="Staff"> <i class="material-icons">panorama_horizontal</i> <span class="title">Staff</span> </a>
		</li>
		@endif
		<li>
			<a href="{{ route('admin.users') }}" title="Members"> <i class="material-icons">panorama_horizontal</i> <span class="title">Members</span> </a>
		</li>
		<li>
			<a href="{{ route('admin.get-messages') }}" title="Messages"> <i class="material-icons">panorama_horizontal</i> <span class="title">Messages</span> <span class="label label-important bubble-only pull-right "></span></a>
		</li>
		<li>
			<a href="{{ route('admin.community') }}" title="Community Notes"> <i class="material-icons">panorama_horizontal</i> <span class="title">Community Notes</span> <span class="label label-important bubble-only pull-right "></span></a>
		</li>
		@if( Auth::user()->level == 1)
		<li>
			<a href="{{ route('admin.packages') }}" title="Packages"> <i class="material-icons">panorama_horizontal</i> <span class="title">Packages</span> </a>
		</li>
		<li>
			<a href="{{ route('admin.countries') }}" title="Countries"> <i class="material-icons">panorama_horizontal</i> <span class="title">Countries</span> </a>
		</li>
		<li>
			<a href="{{ route('admin.categories') }}" title="Categories"> <i class="material-icons">panorama_horizontal</i> <span class="title">Sectors</span> </a>
		</li>
		<li>
			<a href="{{ route('admin.etypes') }}" title="Types"> <i class="material-icons">panorama_horizontal</i> <span class="title">Types</span> </a>
		</li>
		@endif
		<li>
			<a href="{{ route('admin.profile') }}" title="Profile"> <i class="material-icons">email</i> <span class="title">Profile</span> </a>
		</li>
		@if( Auth::user()->level == 1)
		<li>
			<a href="{{ route('admin.csv') }}" title="Events"> <i class="material-icons">panorama_horizontal</i> <span class="title">Upload Event - CSV </span> </a>
		</li>
		@endif
		{{--<li>
			<a href="javascript:;"> <i class="material-icons">invert_colors</i> <span class="title">Themes</span> <span class=" arrow"></span> </a>
			<ul class="sub-menu">
				<li> <a href="theme_coporate.html">Coporate </a> </li>
				<li> <a href="theme_simple.html">Simple</a> </li>
				<li> <a href="theme_elegant.html">Elegant</a> </li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"> <i class="material-icons">airplay</i> <span class="title">Layouts</span> <span class=" arrow"></span> </a>
			<ul class="sub-menu">
				<li> <a href="layout_options.html"> Layout Options </a> </li>
				<li> <a href="boxed_layout.html">Boxed Layout </a> </li>
				<li> <a href="boxed_layout_v2.html">Inner Boxed Layout </a> </li>
				<li> <a href="extended_layout.html">Extended Layout</a> </li>
				<li> <a href="RTL.html">RTL Layout</a> </li>
				<li> <a href="horizontal_menu.html">Horizontal Menu</a> </li>
				<li> <a href="horizontal_menu_boxed.html">Horizontal Menu & Boxed</a> </li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"> <i class="material-icons">flip</i><span class="title"> UI Elements</span> <span class=" arrow"></span> </a>
			<ul class="sub-menu">
				<li> <a href="typography.html"> Typography </a> </li>
				<li> <a href="messages_notifications.html"> Messages & Notifications </a> </li>
				<li> <a href="notifications.html"> Notifications </a> </li>
				<li> <a href="icons.html">Icons</a> </li>
				<li class=""> <a href="buttons.html">Buttons</a> </li>
				<li> <a href="tabs_accordian.html"> Tabs & Accordions </a> </li>
				<li> <a href="sliders.html">Sliders</a> </li>
				<li> <a href="group_list.html">Group list </a> </li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"> <i class="material-icons">view_stream</i> <span class="title">Forms</span> <span class=" arrow"></span> </a>
			<ul class="sub-menu">
				<li> <a href="form_elements.html">Form Elements </a> </li>
				<li> <a href="form_validations.html">Form Validations</a> </li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"> <i class="material-icons">apps</i> <span class="title">Grids</span> <span class=" arrow"></span> </a>
			<ul class="sub-menu">
				<li> <a href="grids_simple.html">Simple Grids</a> </li>
				<li> <a href="grids_draggable.html">Draggable Grids </a> </li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"> <i class="material-icons">playlist_add_check</i> <span class="title">Tables</span> <span class=" arrow"></span> </a>
			<ul class="sub-menu">
				<li> <a href="tables.html"> Basic Tables </a> </li>
				<li> <a href="datatables.html"> Data Tables </a> </li>
			</ul>
		</li>
		<li>
			<a href="javascript:;"> <i class="material-icons">location_on</i> <span class="title">Maps</span> <span class=" arrow"></span> </a>
			<ul class="sub-menu">
				<li> <a href="google_map.html"> Google Maps </a> </li>
				<li> <a href="vector_map.html"> Vector Maps </a> </li>
			</ul>
		</li>
		<li>
			<a href="charts.html"> <i class="material-icons">timeline</i> <span class="title">Charts</span> </a>
		</li>
		<li class="open active">
			<a href="javascript:;"> <i class="material-icons">layers</i> <span class="title">Extra</span> <span class=" open  arrow"></span> </a>
			<ul class="sub-menu">
				<li> <a href="user-profile.html"> User Profile </a> </li>
				<li> <a href="time_line.html"> Time line </a> </li>
				<li> <a href="support_ticket.html"> Support Ticket </a> </li>
				<li> <a href="gallery.html"> Gallery</a> </li>
				<li class=""><a href="calender.html"> Calendar</a> </li>
				<li> <a href="search_results.html"> Search Results </a> </li>
				<li> <a href="invoice.html"> Invoice </a> </li>
				<li> <a href="404.html"> 404 Page </a> </li>
				<li> <a href="500.html"> 500 Page </a> </li>
				<li> <a href="blank_template.html"> Blank Page </a> </li>
				<li> <a href="login.html"> Login </a> </li>
				<li> <a href="login_v2.html">Login v2</a> </li>
				<li> <a href="lockscreen.html"> Lockscreen </a> </li>
			</ul>
		</li>
		<li class="">
			<a href="javascript:;"> <i class="material-icons">more_horiz</i> <span class="title">Menu Levels</span> <span class=" arrow"></span> </a>
			<ul class="sub-menu">
				<li> <a href="javascript:;"> Level 1 </a> </li>
				<li>
					<a href="javascript:;"> <span class="title">Level 2</span> <span class=" arrow"></span> </a>
					<ul class="sub-menu">
						<li> <a href="javascript:;"> Sub Menu </a> </li>
						<li> <a href="ujavascript:;"> Sub Menu </a> </li>
					</ul>
				</li>
			</ul>
		</li>
		<li class="hidden-lg hidden-md hidden-xs" id="more-widgets">
			<a href="javascript:;"> <i class="material-icons"></i></a>
			<ul class="sub-menu">
				<li class="side-bar-widgets">
					<p class="menu-title sm">FOLDER <span class="pull-right"><a href="#" class="create-folder"><i class="material-icons">add</i></a></span></p>
					<ul class="folders">
						<li>
							<a href="#">
								<div class="status-icon green"></div>
								My quick tasks </a>
						</li>
						<li>
							<a href="#">
								<div class="status-icon red"></div>
								To do list </a>
						</li>
						<li>
							<a href="#">
								<div class="status-icon blue"></div>
								Projects </a>
						</li>
						<li class="folder-input" style="display:none">
							<input type="text" placeholder="Name of folder" class="no-boarder folder-name" name="" id="folder-name">
						</li>
					</ul>
					<p class="menu-title">PROJECTS </p>
					<div class="status-widget">
						<div class="status-widget-wrapper">
							<div class="title">Freelancer<a href="#" class="remove-widget"><i class="material-icons">close</i></a></div>
							<p>Redesign home page</p>
						</div>
					</div>
					<div class="status-widget">
						<div class="status-widget-wrapper">
							<div class="title">envato<a href="#" class="remove-widget"><i class="material-icons">close</i></a></div>
							<p>Statistical report</p>
						</div>
					</div>
				</li>
			</ul>
		</li>--}}
	</ul>
	{{--<div class="side-bar-widgets">--}}
		{{--<p class="menu-title sm">FOLDER <span class="pull-right"><a href="#" class="create-folder"> <i class="material-icons">add</i></a></span></p>--}}
		{{--<ul class="folders">--}}
			{{--<li>--}}
				{{--<a href="#">--}}
					{{--<div class="status-icon green"></div>--}}
					{{--My quick tasks </a>--}}
			{{--</li>--}}
			{{--<li>--}}
				{{--<a href="#">--}}
					{{--<div class="status-icon red"></div>--}}
					{{--To do list </a>--}}
			{{--</li>--}}
			{{--<li>--}}
				{{--<a href="#">--}}
					{{--<div class="status-icon blue"></div>--}}
					{{--Projects </a>--}}
			{{--</li>--}}
			{{--<li class="folder-input" style="display:none">--}}
				{{--<input type="text" placeholder="Name of folder" class="no-boarder folder-name" name="">--}}
			{{--</li>--}}
		{{--</ul>--}}
		{{--<p class="menu-title">PROJECTS </p>--}}
		{{--<div class="status-widget">--}}
			{{--<div class="status-widget-wrapper">--}}
				{{--<div class="title">Freelancer<a href="#" class="remove-widget"><i class="material-icons">close</i></a></div>--}}
				{{--<p>Redesign home page</p>--}}
			{{--</div>--}}
		{{--</div>--}}
		{{--<div class="status-widget">--}}
			{{--<div class="status-widget-wrapper">--}}
				{{--<div class="title">envato<a href="#" class="remove-widget"><i class="material-icons">close</i></a></div>--}}
				{{--<p>Statistical report</p>--}}
			{{--</div>--}}
		{{--</div>--}}
	{{--</div>--}}
	<div class="clearfix"></div>
	<!-- END SIDEBAR MENU -->
</div>
