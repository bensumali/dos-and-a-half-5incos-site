<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function store(Request $request) {
        $request_file = $request->file('image');
        $path = $request_file->store('files');
        if($path) {
            $file = new File();
            $file->original_name = $request_file->getClientOriginalName();
            $file->mime_type = $request_file->getClientMimeType();
            $file->size = $request_file->getSize();
            $file->path = $path;
            $file->save();
            return response($file, 200);
        }
    }
}
