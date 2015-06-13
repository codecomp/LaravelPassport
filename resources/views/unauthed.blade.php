<!DOCTYPE html>
<html>
@include('partials._htmlheader')
<body>
	<div class="wrapper">

		<div class="content-wrapper">

			<section class="content">
				@yield('content')
			</section>

		</div>

	</div>

    @include('partials._scripts')

</body>
</html>