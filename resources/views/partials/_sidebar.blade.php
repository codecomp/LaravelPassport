<aside class="main-sidebar">

	<section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <a href="{!! route('users.edit', [Auth::user()->id]) !!}">
                    <img src="{{ Auth::user()->gravatar  }}" class="img-circle" alt="User Image" />
                </a>
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <p class="status"><span class="glyphicon glyphicon-signal"></span> Online</p>
                <a href="{!! route('users.edit', [Auth::user()->id]) !!}"><span class="glyphicon glyphicon-edit"></span> Edit profile</a>
                <a href="/auth/logout"><span class=" glyphicon glyphicon-log-out"></span> Logout</a>
            </div>
        </div>

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
			<li class="{{ set_active('dashboard') }}">
                <a href="{{ url('/') }}"><span class="glyphicon glyphicon-home"></span> Dashboard</a>
            </li>
            @if( Auth::user()->can(['add_clients', 'view_clients']) )
                <li class="{{ section_active(['clients.create','clients.index','clients.show','clients.edit','clients.websites.create','clients.websites.edit'], 'open active') }}">
                    <a href="#"><span class="glyphicon glyphicon-list-alt"></span> Clients</a>
                    <ul class="sub-nav">
                        @if( Auth::user()->can('add_clients') )
                            <li class="{{ set_active('clients.create') }}">
                                {!! link_to_route('clients.create', 'Add Client') !!}
                            </li>
                        @endif
                        @if( Auth::user()->can('view_clients') )
                            <li class="{{ set_active('clients.index') }}">
                                {!! link_to_route('clients.index', 'View Clients')  !!}
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if( Auth::user()->can(['add_tickets', 'view_tickets']) )
                <li class="{{ section_active(['tickets.create', 'tickets.index', 'tickets.show'], 'open active') }}">
                    <a href="#"><span class="glyphicon glyphicon-tasks"></span> Tickets</a>
                    <ul class="sub-nav">
                        @if( Auth::user()->can('add_tickets') )
                            <li class="{{ set_active('tickets.create') }}">
                                {!! link_to_route('tickets.create', 'Add Ticket') !!}
                            </li>
                        @endif
                        @if( Auth::user()->can('view_tickets') )
                            <li class="{{ set_active('tickets.index') }}">
                                {!! link_to_route('tickets.index', 'View Tickets')  !!}
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if( Auth::user()->can(['add_users', 'view_users']) )
                <li class="{{ section_active(['users.create', 'users.index', 'users.edit'], 'open active') }}">
                    <a href="#"><span class="glyphicon glyphicon-user"></span> Users</a>
                    <ul class="sub-nav">
                        @if( Auth::user()->can('add_users') )
                            <li class="{{ set_active('users.create') }}">
                                {!! link_to_route('users.create', 'Add User') !!}
                            </li>
                        @endif
                        @if( Auth::user()->can('view_users') )
                            <li class="{{ set_active('users.index') }}">
                                {!! link_to_route('users.index', 'View Users')  !!}
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
		</ul>
        <!-- /.sidebar-menu -->

	</section>

</aside>