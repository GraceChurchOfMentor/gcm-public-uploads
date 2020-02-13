<?php

namespace App\Http\Controllers;

use App\Mail\FilesUploaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotifyController extends Controller
{
    public function email(Request $request) {
        $data = [
            'userName' => $request->input('userName'),
            'userEmail' => $request->input('userEmail'),
            'folderName' => $request->input('folderName'),
            'fileCount' => $request->input('fileCount'),
        ];

        Mail::to(explode(',', env('UPLOAD_NOTIFY_EMAILS')))->send(new FilesUploaded($data));
    }
}
