<?php

namespace App\Http\Controllers;

use App\Models\TemplateReply;
use Illuminate\Http\Request;

use App\Http\Requests\StoreTemplateReplyRequest;
use App\Http\Requests\UpdateTemplateReplyRequest;

class TemplateReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manajemen.create-keyword');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTemplateReplyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =[
            'reply_chat' => $request->reply_chat,
            'keyword' => $request->keyword,
        ];

        TemplateReply::create($data);
        return redirect('/history');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TemplateReply  $templateReply
     * @return \Illuminate\Http\Response
     */
    public function show(TemplateReply $templateReply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TemplateReply  $templateReply
     * @return \Illuminate\Http\Response
     */
    public function edit(TemplateReply $templateReply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTemplateReplyRequest  $request
     * @param  \App\Models\TemplateReply  $templateReply
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTemplateReplyRequest $request, TemplateReply $templateReply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TemplateReply  $templateReply
     * @return \Illuminate\Http\Response
     */
    public function destroy(TemplateReply $templateReply)
    {
        //
    }
}
