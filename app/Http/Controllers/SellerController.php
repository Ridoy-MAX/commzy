<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\AccountApproval; 
use App\Models\Footer;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SellerController extends Controller
{
    //
    public function seller(){
        $footer = Footer::first();
        return view('become_seller.become_seller',compact('footer'));
    }
    public function seller_information(){
        $user = Auth::user();
        $users = User::paginate(6);
        $footer = Footer::first();
        return view('become_seller.personal_information',compact('users','user','footer'));
    }
    public function extra_information(){
        $footer = Footer::first();
        return view('become_seller.extra_information',compact('footer'));
    }
    public function submit_information(){
        $footer = Footer::first();
        return view('become_seller.submit_information',compact('footer'));
    }

    public function thankyou()
    {
        $footer = Footer::first(); // Fetch the Footer model data

        return view('become_seller.submit_information', compact('footer'));
    }




public function handleFormSubmission(Request $request)
{
    // Assuming form validation has been done

    // Get the authenticated user's ID
    $userId = auth()->user()->id;

    // Check if the user already has an approval record
    $approvalRecord = AccountApproval::where('user_id', $userId)->first();

    if ($approvalRecord) {
        // If the approval record already exists, update its created_at timestamp
        $approvalRecord->touch(); // This will update the created_at and updated_at timestamps
    } else {
        // If the approval record doesn't exist, create a new one
        AccountApproval::create([
            'user_id' => $userId,
            'approval' => 'waiting',
        ]);
    }

    // Redirect to a thank you page or any other desired route
    return redirect()->route('thankyou');
}




    public function getId(Request $request)
    {
        $cities = City::where('country_id', $request->country_id)->select('id', 'name')->get();
        $str = '<option value=""> -- Select City name -- </option>';
        foreach ($cities as $city) {
            $str .= '<option value="' . $city->id . '">' . $city->name . '</option>';
        }
        return $str;
    }
}
