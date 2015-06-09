<!DOCTYPE html>
<html>
@include('partials.htmlheader')
<body>
	<div class="wrapper">

		<div class="content-wrapper">

			<section class="content">
				@yield('content')
			</section>

		</div>

	</div>

    @include('partials.scripts')

</body>
</html>