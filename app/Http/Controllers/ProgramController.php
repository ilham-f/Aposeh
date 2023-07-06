<?php

namespace App\Http\Controllers;

<<<<<<< Updated upstream:app/Http/Controllers/ProgramController.php
use App\Models\Program;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
=======
use App\Models\TemplateChat;
use App\Http\Requests\StoreTemplateChatRequest;
use App\Http\Requests\UpdateTemplateChatRequest;
use Illuminate\Http\Request;
>>>>>>> Stashed changes:app/Http/Controllers/TemplateChatController.php

class ProgramController extends Controller
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
     * @param  \App\Http\Requests\StoreProgramRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
<<<<<<< Updated upstream:app/Http/Controllers/ProgramController.php
    public function edit(Program $program)
=======
    public function edit($id)
>>>>>>> Stashed changes:app/Http/Controllers/TemplateChatController.php
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProgramRequest  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
<<<<<<< Updated upstream:app/Http/Controllers/ProgramController.php
    public function update(UpdateProgramRequest $request, Program $program)
=======
    public function update(Request $request, $id)
>>>>>>> Stashed changes:app/Http/Controllers/TemplateChatController.php
    {
        $data = [
            'chat'=>$request->chat
        ];

        TemplateChat::where('id', $id)->update($data);
        return redirect()->to('templatepesan')->with('succes', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
<<<<<<< Updated upstream:app/Http/Controllers/ProgramController.php
    public function destroy(Program $program)
=======
    public function destroy($id)
>>>>>>> Stashed changes:app/Http/Controllers/TemplateChatController.php
    {
        TemplateChat::findorfail($id)->delete(); 
        return back();
    }
}
