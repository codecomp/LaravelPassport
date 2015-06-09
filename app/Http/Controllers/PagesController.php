<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {

	/**
	 * Display the dashboard page.
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		return view('pages.default')->with('content', 'Sample content');
	}

}
