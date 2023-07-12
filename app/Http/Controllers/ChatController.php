<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\TemplateChat;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Http\Requests\StoreTemplateChatRequest;
use App\Http\Requests\UpdateTemplateChatRequest;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TemplateChat::get();
        return view('pegawai.templatepesan',['datablade' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'chat'=> 'required|string',
        ]);
        TemplateChat::create($data);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $data = TemplateChat::where('id', $id)->first();
        return view('pegawai.edittemplate')->with('data', $data);
        // $data = $request->validate([
        //     'chat'=> 'required|string',
        //     'id'=>'required'
        // ]);
        // TemplateChat::findorfail($request['id']);
        // return back();
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
