<?php

namespace App\Http\Controllers;

use App\Client;
use App\Website;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class WebsitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return $this|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function create($id)
    {
        if ( !Auth::user()->can('add_websites') )
            return response('Unauthorised', 403);

        $client  = Client::FindorFail($id);

        return view('websites.create')->with('client', $client);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $client_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $client_id)
    {
        $website = new Website();
        $website->client_id     = $client_id;
        $website->url           = $request->input('url');
        $website->ip            = $request->input('ip');
        $website->ftp_host      = $request->input('ftp_host');
        $website->ftp_username  = $request->input('ftp_username');
        $website->ftp_password  = $request->input('ftp_password');
        $website->ssh_host      = $request->input('ssh_host');
        $website->ssh_username  = $request->input('ssh_username');
        $website->ssh_password  = $request->input('ssh_password');

        $website->save();

        Flash::success('Website created successfully');

        //Return to the client page
        return redirect()->route('clients.show', [$client_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $client_id
     * @param $website_id
     * @return $this|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function edit($client_id, $website_id)
    {
        if ( !Auth::user()->can('edit_websites') )
            return response('Unauthorised', 403);

        $client  = Client::FindorFail($client_id);
        $website  = Website::FindorFail($website_id);

        return view('websites.edit')->with(['client' => $client, 'website' => $website]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $client_id
     * @param $website_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $client_id, $website_id)
    {
        $website = Website::FindorFail($website_id);
        $website->url           = $request->input('url');
        $website->ip            = $request->input('ip');
        $website->ftp_host      = $request->input('ftp_host');
        $website->ftp_username  = $request->input('ftp_username');
        $website->ssh_host      = $request->input('ssh_host');
        $website->ssh_username  = $request->input('ssh_username');

        if($request->input('ftp_password'))
            $website->ftp_password  = $request->input('ftp_password');
        if($request->input('ssh_password'))
            $website->ssh_password  = $request->input('ssh_password');

        $website->save();

        Flash::success('Website Updated successfully');

        //Return to the client page
        return redirect()->route('clients.show', [$client_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $client_id
     * @param $website_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($client_id, $website_id)
    {
        if ( !Auth::user()->can('delete_websites') )
            return response('Unauthorised', 403);

        $client = Website::FindOrFail($website_id)->delete();

        Flash::success('Website deleted successfully');

        //Return to the client page
        return redirect()->route('clients.show', [$client_id]);
    }
}
