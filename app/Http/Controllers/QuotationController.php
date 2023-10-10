<?php

namespace App\Http\Controllers;

use App\Jobs\QuotationJobSend;
use App\Models\Image;
use App\Models\Prescription;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class QuotationController extends Controller
{
    //Admin
    public function quotation($id)
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id','=',Session::get('loginId'))->first();
            // Retrieve the prescription with the given ID and perform the necessary action

            $prescription = Prescription::findOrFail($id);
            //update status of quotation create
            $prescription->update([
                'quotation_create' => 1
            ]);
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
            $quotations = Quotation::where('pres_id',$id)->paginate(4);
            $total = Quotation::where('pres_id',$id)->sum('total_amount');
            // Return the view with prescription data
            return view('pages.admin.quotation.quotation', compact('data', 'prescription','quotations','total'));

        }
    }

    public function addQuotation(Request $request){
        $request->validate([
            'drug' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'pres_id' => 'nullable',
        ]);
        Log::debug($request);

        $quotation['drug'] = $request['drug'];
        $quotation['price'] = $request['price'];
        $quotation['quantity'] = $request['quantity'];
        $quotation['pres_id'] = $request['pres_id'];
        $quotation['total_amount'] = $quotation['price'] * $quotation['quantity'];

        $prescription = Prescription::findOrFail($quotation['pres_id'] );
        $quotation['user_id'] = $prescription->user_id;

        // Create the quotation
        Quotation::create($quotation);

        return back()->with('success','You have successfully added quotation.');


    }

    //send mail to customer
    public function quotationEmail(int $id)
    {
        try {
            $prescription = Prescription::findOrFail($id);
            //update status of send mail
            $prescription->update([
                'quotation_mail' => 1
            ]);
            QuotationJobSend::dispatch ($id);
            return back()->with('success','You have successfully send quotation.');


        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Email send failed'
            ], 422);
        }

    }

    public function adminQuotationList()
    {
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
            $quotations = Prescription::where('quotation_mail',1)->paginate(10);
            return view("pages.admin.quotation.quotation_list",compact('data','quotations'));
        }

    }

    //User
    public function quotation_list()
    {
        $data = array();
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
            $quotations = Prescription::where('user_id','=',Session::get('loginId'))->where('quotation_mail',1)->paginate(10);
            return view("pages.user.quotation.quotation_list",compact('data','quotations'));
        }

    }

    public function quotationView($id)
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id','=',Session::get('loginId'))->first();
            // Retrieve the prescription with the given ID and perform the necessary action

            $quotations = Quotation::where('pres_id',$id)->get();
            $total = Quotation::where('pres_id',$id)->sum('total_amount');
            $prescription = Prescription::findOrFail($id);


            // Return the view with prescription data
            return view('pages.user.quotation.quotation', compact('data', 'quotations','total','prescription'));

        }
    }

    public function quotationAccept(int $id)
    {
        try {
            $prescription = Prescription::findOrFail($id);

             //update status of accept status of quotation
             $prescription->update([
                'quotation_accept' => 1
            ]);
            return back()->with('success','You have successfully accept quotation.');


        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Email send failed'
            ], 422);
        }

    }

    public function quotationReject(int $id)
    {
        try {
            $prescription = Prescription::findOrFail($id);
            //update status of accept status of quotation
            $prescription->update([
                'quotation_accept' => 2
            ]);
            return back()->with('success','You have successfully reject quotation.');


        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Reject send failed'
            ], 422);
        }

    }


}
