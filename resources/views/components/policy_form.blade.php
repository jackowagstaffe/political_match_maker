<form action="{{ route('submit_page', ['page_id' => $page_id]) }}" method="POST">
@yield('form_content')

<button type="submit" class="btn btn-primary btn-lg">Next <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
</form>
