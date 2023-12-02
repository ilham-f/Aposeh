<?php

namespace App\Http\Controllers;

use App\Models\TemplateChat;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTemplateChatRequest;
use App\Http\Requests\UpdateTemplateChatRequest;

class TemplateChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TemplateChat::get();
        return view('manajemen.templatepesan',['datablade' => $data]);
    }

    public function create(Request $request)
    {
        //
        $data = $request->validate([
            'chat'=> 'required|string',
        ]);
        TemplateChat::create($data);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTemplateChatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTemplateChatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TemplateChat  $templateChat
     * @return \Illuminate\Http\Response
     */
    public function show(TemplateChat $templateChat)
    {
        //
    }

    public function edit($id)
    {
        $data = TemplateChat::where('id', $id)->first();
        return view('manajemen.edittemplate')->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'chat'=>$request->chat
        ];

        TemplateChat::where('id', $id)->update($data);
        return redirect()->to('templatepesan')->with('succes', 'Berhasil melakukan update data');
    }

    public function destroy($id)
    {
        TemplateChat::findorfail($id)->delete();
        return back();
    }
}
