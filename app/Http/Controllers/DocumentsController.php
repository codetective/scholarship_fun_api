<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function getDocs(Request $request)
    {
        $id = $request->query('id');

        $docs = Documents::select([
            'scholarship_application_id',
            'certificate_of_origin',
            'birth_certificate_declaration',
            'fee_schedule',
            'fee_receipt',
            'attestation_letter',
            'applicant_picture',
            'admission_letter'
        ])->where('scholarship_application_id', $id)->first();

        return response()->json(['docs' => $docs], 201);
    }
}
