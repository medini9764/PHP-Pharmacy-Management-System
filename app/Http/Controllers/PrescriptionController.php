<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function prescription()
    {
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
            return view("pages.user.prescription.prescription",compact('data'));
        }

    }

    public function prescription_list()
    {
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
            $prescriptions = Prescription::where('user_id','=',Session::get('loginId'))->paginate(10);
            return view("pages.user.prescription.prescription_list",compact('data','prescriptions'));
        }

    }

    public function addPrescription(Request $request){
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,',
            'image2' => 'nullable',
            'image3' => 'nullable',
            'image4' => 'nullable',
            'image5' => 'nullable',
            'delivery_address' => 'required',
            'delivery_time' => 'required',
        ]);
        Log::debug($request);


        $prescription['delivery_address'] = $request['delivery_address'];
        $prescription['delivery_time'] = $request['delivery_time'];
        $prescription['note'] = $request['note'];

        $recode = Prescription::where('user_id','=',Session::get('loginId'))->count();

        // if($recode >0){

        //     $data['name'] = $request->file('image')->store('image', 'public');

        //      $new_image = Image::create($data);
        //      $prescription['user_id'] = Session::get('loginId');
        //      $prescription['image_1'] = $new_image->id;

        //     if( isset($request['image2'])){

        //         $data2['name'] = $request->file('image2')->store('image', 'public');
        //         $new_image2 = Image::create($data2);
        //         Log::debug($new_image2);
        //         $prescription['image_2'] = $new_image2->id;
        //     }
        //     if($request['image3']){
        //         $data3['name'] = $request->file('image3')->store('image', 'public');
        //         $new_image3 = Image::create($data3);
        //         $prescription['image_3'] = $new_image3->id;
        //     }
        //     if($request['image4']){
        //         $data4['name'] = $request->file('image4')->store('image', 'public');
        //         $new_image4 = Image::create($data4);
        //         $prescription['image_4'] = $new_image4->id;
        //     }
        //     if($request['image5']){
        //         $data5['name'] = $request->file('image5')->store('image', 'public');
        //         $new_image5= Image::create($data5);
        //         $prescription['image_5'] = $new_image5->id;
        //     }


        //     Prescription::where('user_id','=',Session::get('loginId'))->update($prescription);

        //     return back()->with('success','You have successfully added prescription.');

        // }else{
            //image upload to public folder
            $data['name'] = $request->file('image')->store('image', 'public');
            //image path save in image table
            $new_image = Image::create($data);
            $prescription['image_1'] = $new_image->id;
            if( $request['image2']){
                Log::debug($request['image2']);
                $data2['name'] = $request->file('image2')->store('image', 'public');
                $new_image2 = Image::create($data2);
                $prescription['image_2'] = $new_image2->id;
            }
            if($request['image3']){
                $data3['name'] = $request->file('image3')->store('image', 'public');
                $new_image3 = Image::create($data3);
                $prescription['image_3'] = $new_image3->id;
            }
            if($request['image4']){
                $data4['name'] = $request->file('image4')->store('image', 'public');
                $new_image4 = Image::create($data4);
                $prescription['image_4'] = $new_image4->id;
            }
            if($request['image5']){
                $data5['name'] = $request->file('image5')->store('image', 'public');
                $new_image5= Image::create($data5);
                $prescription['image_5'] = $new_image5->id;
            }


            $prescription['user_id'] = Session::get('loginId');
            Prescription::create($prescription);

            return back()->with('success','You have successfully added prescription.');
        // }

    }

    //Admin
    public function userPrescriptionList()
    {
        $data = array();
        if (Session::has('loginId')) {
            $userId = Session::get('loginId');
            $data = User::find($userId);
            // Simplified query without conditions
            $prescriptions = Prescription::paginate(10);

            return view("pages.admin.prescription.prescription_list", compact('data','prescriptions'));
        }

    }
    public function prescriptionView($id)
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id','=',Session::get('loginId'))->first();
            // Retrieve the prescription with the given ID and perform the necessary action

            $prescription = Prescription::findOrFail($id);
            Log::debug($id);
            $image_1 = Image::findOrFail($prescription->image_1);
            $prescription['image_1'] = $image_1->name;
            Log::debug($prescription->image_2);
            // check other four images avalability
            if(isset($prescription->image_2)){
                Log::debug($prescription->image_2);
                $image_2 = Image::find($prescription->image_2);
                Log::debug($image_2);
                $prescription['image_2'] = $image_2->name;

            }
            if(isset($prescription->image_3)){
                $image_3 = Image::findOrFail($prescription->image_3);
                $prescription['image_3'] = $image_3->name;
            }
            if(isset($prescription->image_4)){
                $image_4 = Image::findOrFail($prescription->image_4);
                $prescription['image_4'] = $image_4->name;
            }
            if(isset($prescription->image_5)){
                $image_5 = Image::findOrFail($prescription->image_5);
                $prescription['image_5'] = $image_5->name;
            }

            // Return the view with prescription data
            return view('pages.admin.prescription.prescription_view', compact('data', 'prescription'));

        }
    }
}
