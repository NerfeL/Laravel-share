<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FileNotFoundException;

class FilesController extends Controller
{

    public function uploadFile(FileRequest $request, User $user) {

        $path = $request->file->store('uploads', 'public');

        $file = new File([
            'link' => substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 10),
            'name' => $request->file->getClientOriginalName(),
            'path' => $path
        ]);

        $user->files()->save($file);

        return redirect()->route('home');

    }

    public function downloadFile($link) {

        try {
            $file = File::where('link', $link)->first();

            if(is_null($file)) {
                throw new \Exception("File not found", 404);
            }

            $fileResponse = response()->download('storage/'.$file->path, $file->name);

            $file->increment('downloads');
        }
        catch (FileNotFoundException | \Exception $e) {
            \Log::info($e);
            abort(404, $e->getMessage());
        }

        return $fileResponse;
    }

}
