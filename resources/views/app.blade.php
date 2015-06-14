<!DOCTYPE html>
<html>
@include('partials._htmlheader')
<body class="has-sidebar">
	<div class="wrapper">

		@include('partials._mainheader')

		@include('partials._sidebar')

		<div class="content-wrapper">

            <section class="content-header">
                @include('partials._contentheader')
            </section>

			<section class="content">
				@yield('content')
			</section>

		</div>

	</div>

    @include('partials._scripts')

</body>
</html>