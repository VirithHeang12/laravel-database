<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TemplateDownloadController extends Controller
{
    public function download()
    {
        return Response::download(public_path('templates/staffs.xlsx'), 'staffs.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="template.docx"',
        ]);
    }
}
