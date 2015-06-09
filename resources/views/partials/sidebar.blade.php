<aside class="main-sidebar">

	<section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=grvitar&w=160&h=160" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <p class="status"><span class="glyphicon glyphicon-signal"></span> Online</p>
            </div>
        </div>

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
			<li class="{{ set_active('dashboard') }}">
                <a href="{{ url('/') }}"><span class="glyphicon glyphicon-home"></span> Dashboard</a>
            </li>
            <li class="{{ section_active(['tickets.create', 'tickets.index'], 'open active') }}">
                <a href="#"><span class="glyphicon glyphicon-tasks"></span> Tickets</a>
                <ul class="sub-nav">
                    <li class="{{ set_active('tickets.create') }}">
                        {!! link_to_route('tickets.create', 'Add Tickets') !!}
                    </li>
                    <li class="{{ set_active('tickets.index') }}">
                        {!! link_to_route('tickets.index', 'View Tickets')  !!}
                    </li>
                </ul>
            </li>
            <li class="{{ section_active(['users.create', 'users.index'], 'open active') }}">
                <a href="#"><span class="glyphicon glyphicon-user"></span> Users</a>
                <ul class="sub-nav">
                    <li class="{{ set_active('users.create') }}">
                        {!! link_to_route('users.create', 'Add Users') !!}
                    </li>
                    <li class="{{ set_active('users.index') }}">
                        {!! link_to_route('users.index', 'View Users')  !!}
                    </li>
                </ul>
            </li>
		</ul>
        <!-- /.sidebar-menu -->

	</section>

</aside>