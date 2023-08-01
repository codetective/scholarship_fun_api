<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function getDocs(Request $request)
    {
        $id = $request->query('id');

        $docs = Documents::where('scholarship_application_id', $id)->first();

        return response()->json(['docs' => $docs], 201);
    }
}
