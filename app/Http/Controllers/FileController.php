<?php

namespace App\Http\Controllers;

use App\File;
use App\FilesPublic;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->id;
        $fileById = file::where("userId", "=", "$user")->get();
        return view('files.index')->with('files', $fileById);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'des' => 'required|min:5|max:60',
            'fileIn' => 'required|mimes:png,jpg,pdf'
        ]);

        $file = new File();
        $file->title = $request->title;
        $file->des = $request->des;
        $file_data = $request->file('fileIn');
        $file_name = $file_data->getClientOriginalName();
        $file_data->move(public_path() . '/files/', $file_name);
        $file->file = $file_name;
        $file->userId = $request->userId;

        $file->save();

        return redirect()->back()->with('done', 'Insert done');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = File::find($id);
        return view('files.show')->with('file', $file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = File::find($id);
        return view('files.edit')->with('files',$file);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'des' => 'required|min:5|max:60',
            'fileIn' => 'required|mimes:png,jpg'
        ]);

        $file = File::find($id);
        $file->title = $request->title;
        $file->des = $request->des;
        $file_data = $request->file('fileIn');
        $file_name = $file_data->getClientOriginalName();
        $file_data->move(public_path() . '/files/', $file_name);
        $file->file = $file_name;
        $file->save();

        return redirect('files/list')->with('done', 'Updata done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::find($id);
        unlink(public_path('files/' . $file->file));
        $file->delete();
        return redirect()->back()->with('done', 'Delete done');
    }

    public function download($id)
    {
        $data = File::where('id', '=', $id)->firstOrFail();
        $pathFile = public_path('files/' . $data->file);
        return response()->download($pathFile);
    }

    public function public()
    {
        return view('files.public')->with('files', FilesPublic::all());
    }

    public function share($id)
    {
        $file = File::find($id);
        $newfile = new FilesPublic();
        $newfile->file = $file->file;
        $newfile->title = $file->title;
        $newfile->des = $file->des;

        $newfile->save();

        return redirect('files/list')->with('done', 'Share done');
    }

    public function showPublic($id){
        $file = FilesPublic::find($id);
        return view('files.showPublic')->with('file', $file);
    }

    public function downloadPublic($id)
    {
        $data = FilesPublic::where('id', '=', $id)->firstOrFail();
        $pathFile = public_path('files/' . $data->file);
        return response()->download($pathFile);
    }
}
