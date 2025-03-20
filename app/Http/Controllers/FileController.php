<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\File;
use Storage;

class FileController extends Controller {
    public function index() {
        $files = File::all();
        return view('files.index', compact('files'));
    }

    public function store(Request $request) {
        $file = $request->file('file');
        $filename = time().'_'.$file->getClientOriginalName();
        
        if ($request->has('use_cloud')) {
            $filepath = Storage::disk('cloud')->put($filename, file_get_contents($file));
        } else {
            $filepath = Storage::disk('local')->put($filename, file_get_contents($file));
        }
        
        File::create([
            'filename' => $filename,
            'filepath' => $filepath,
            'filetype' => $file->getClientMimeType(),
        ]);

        return back()->with('success', 'File Uploaded Successfully');
    }

    public function destroy($id) {
        $file = File::findOrFail($id);
        Storage::disk('cloud')->delete($file->filepath);
        $file->delete();
        
        return back()->with('success', 'File Deleted Successfully');
    }
}
