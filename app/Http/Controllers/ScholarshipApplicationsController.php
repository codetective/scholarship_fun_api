<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScholarshipApplicationsRequest;
use App\Models\Documents;
use App\Models\Images;
use App\Models\ScholarshipApplication;
use Illuminate\Http\Request;

class ScholarshipApplicationsController extends Controller
{
    public function create(StoreScholarshipApplicationsRequest $request)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $length = 4;

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        $randomNumber = mt_rand(100000, 999999);

        $applicationCode = 'AKEF' . $randomString . $randomNumber;

        $app = ScholarshipApplication::create([
            'name' => $request->firstname . ' ' . $request->lastname,
            'email' => $request->email,
            'gender' => $request->gender,
            'lga' => $request->lga,
            'dob' => $request->dob,
            'disability' => $request->form_of_disability,
            'programme_of_study' => $request->programme_of_study,
            'course_of_study' => $request->course_of_study,
            'application_code' => $applicationCode,
        ]);
        Documents::create(['scholarship_application_id' => $app->id]);

        return response()->json($app, 201);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'scholarship_application_id' => 'required|exists:documents,scholarship_application_id',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_for' => 'required|string'
        ]);

        $file = $request->file('file');
        $filePath = $file->store('images', 'public'); // Make sure to store the image in the public disk
        $image = new Images([
            'scholarship_application_id' => $request->input('scholarship_application_id'),
            'url' => $filePath,
            'image_for' => $request->image_for
        ]);
        $image->save();
        $url = asset($filePath);
        Documents::where('scholarship_application_id', $request->scholarship_application_id)->update([$request->image_for => $url]);


        // Return a response
        return response()->json(['message' => 'Image stored successfully', 'url' => $url], 201);
    }




    public function fetchDashboard()
    {
        $all = ScholarshipApplication::count();
        $reviewed = ScholarshipApplication::where('review_status', 'reviewed')->count();
        $first_unreviewed = ScholarshipApplication::select('id', 'name', 'dob', 'email', 'gender', 'programme_of_study', 'lga', 'course_of_study')->where('review_status', 'unreviewed')->limit(30)->get();

        return response()->json(['registered_count' => $all, 'reviewed_count' => $reviewed, 'first_unreviewed' => $first_unreviewed], 201);
    }

    public function fetchAllRevieved()
    {
        $reviewed = ScholarshipApplication::where('review_status', 'reviewed')->count()->get();
        return response()->json(['reviewed' => $reviewed], 201);
    }

    public function fetchAllUnReviewed()
    {
        $unreviewed = ScholarshipApplication::where('review_status', 'unreviewed')->count()->get();
        return response()->json(['unreviewed' => $unreviewed], 201);
    }
}
