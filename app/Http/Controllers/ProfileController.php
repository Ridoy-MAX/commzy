<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Award;
use App\Models\LanguageList;
use Carbon\Carbon;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    
    public function getId(Request $request)
    {
        $selectedCityId = $request->input('selectedCityId'); // Get the selected city ID from the request
        $user = Auth::user();
        $cities = City::where('country_id', $request->country_id)->select('id', 'name')->get();
        $str = '<option value=""> -- Select City name -- </option>';
        foreach ($cities as $city) {
            $isSelected = ($user->city == $city->id || $city->id == $selectedCityId) ? 'selected' : ''; // Compare user's city ID with the current city ID or the selected city ID
            $str .= '<option value="' . $city->id . '" ' . $isSelected . '>' . $city->name . '</option>';
        }
    
        return $str;
    }
    
    
    
    

    // <option value="{{ $country->id }}" {{ $user->country == $country->id ? 'selected' : '' }}>
    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        $user = Auth::user();
     
        $experiences = Experience::where('user_id', Auth::id())->get();
       
    
        return view('profile.edit',  compact('user','experiences'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|regex:/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]+$/',
          
            'gender' => 'nullable|string',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
        
      
            'introduce_yourself' => 'nullable|string',
        ]);
    
        $user = User::find($id);

    
        // Update the user's other fields.
        $user->name = $request->input('name');
        $user->display_name = $request->input('display_name');
        $user->username = $request->input('username');
        // $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        // $user->country = $request->input('country');
        // $user->city = $request->input('city');
        $user->introduce_yourself = $request->input('introduce_yourself');
    
        // Save the user.
        $user->save();
    
        return back()->with('status', 'Profile updated  successfull');
    }
    public function seller_update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|regex:/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]+$/',
            'gender' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'introduce_yourself' => 'required|string',
        ]);
    
        $user = User::find($id);
    
        // Update the user's other fields.
        $user->name = $request->input('name');
        $user->display_name = $request->input('display_name');
        $user->username = $request->input('username');
        $user->gender = $request->input('gender');
        $user->country = $request->input('country');
        $user->city = $request->input('city');
        $user->introduce_yourself = $request->input('introduce_yourself');
    
        // Save the user.
        $user->save();
    
        // Check if all required fields are filled
        if ($user->name && $user->display_name && $user->username && $user->gender && $user->country && $user->city && $user->introduce_yourself) {
            // Redirect to extra.information route
            return redirect()->route('extra.information')->with('status', 'Seller information updated successfully');
        } else {
            // Return back with error message
            return back()->with('error', 'Please fill out all required information.');
        }
    }
    
    
    public function country_city(Request $request){
 
        $id = Auth::user()->id;
        $user = User::find($id);
    
        // Update the user's other fields.
   
        $user->country = $request->input('country');
        $user->city = $request->input('city');

    
        // Save the user.
        $user->save();
    
        return back()->with('country', 'Country & City updated  successfull');
    }

    public function language_insert(Request $request)
    {
       
        // dd($request->all()); // Debugging statement

    // $validatedData = $request->validate([
    //     'languages' => 'required',
    //     'language_level' => 'required',
    // ]);
        // // Check validation errors
        // if ($request->errors()) {
        //     dd($request->errors());
        // }
    
        // // Insertion logic
        LanguageList::insert([
            'user_id' => Auth::id(),
            'languages' => $request->languages,
            'languages_level' => $request->languages_level,
            'created_at' => now(),
        ]);
    
        return back()->with('languages', 'Languages record created successfully!');
    }
    
    public function language_delete($id)
    {
        LanguageList::destroy($id);
        return back()->with('language_delete', 'Languages record deleted successfully!');
    }
    
    
    
    

    function profile_photo(Request $request){

        if(Auth::user()->profile_pic){
            $delete_from = public_path(Auth::user()->profile_pic);
            unlink($delete_from);
        }
        $user = Auth::user();
        $imageName = time().'.'.$request->profile_pic->extension();

        $path = $request->profile_pic->move('uploads/users/', $imageName);
        // Image::make($path)->fit(400, 400)->save($path);
        $user->profile_pic = $path;
        $user->save();
        return back()->with('profile_pic', "Your profile picture was successfully uploaded.");
    }


 


    public function profile_delete($id)
    {
        $user = Auth::user();
    
        if ($user->profile_pic) {
            $deletePath = public_path($user->profile_pic);
            unlink($deletePath);
            if (File::exists($deletePath)) {
                File::delete($deletePath);
            }
    
            $user->profile_pic = null;
            $user->save();
    
            return redirect()->back()->with('success', 'Profile picture deleted successfully.');
        }
    
        return redirect()->back()->with('error', 'No profile picture to delete.');
    }

   
    


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


// profile education qualification==============================================================

    public function education_store(Request $request)
    {
        $validatedData = $request->validate([
            'degree' => 'required|string',
            'university_name' => 'required|string',
            'description' => 'required|string',
            'start_year' => 'required|integer|min:1900|max:' . date('Y'), // Validate the start year range
            'end_year' => 'required|integer|min:1900|max:' . date('Y') // Validate the end year range
        ]);

        Education::insert([
            'user_id'=>Auth::id(),
            'degree'=> $request->degree,
            'university_name'=> $request->university_name,
            'description'=> $request->description,
            'start_year'=> $request->start_year,
            'end_year'=> $request->end_year,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('success', 'Education record created successfully!');
    }
    
    public function education_destroy($id)
    {
        Education::destroy($id);
        return back()->with('success', 'Education record deleted successfully!');
    }
    
    public function education_update(Request $request, $id){
        // Retrieve the specific education record by ID
        $education = Education::find($id);
    
        // Check if the education record belongs to the authenticated user
        if ($education->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action!');
        }
    
        // Update the education record with the form data
        $education->update([
            'degree' => $request->degree,
            'university_name' => $request->university_name,
            'description' => $request->description,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
        ]);
        
        return back()->with('success', 'Education record updated successfully!');
    }
    
// profile experience ==============================================================
    public function experience_store(Request $request)
    {
        $validatedData = $request->validate([
            'position' => 'required|string',
            'company_name' => 'required|string',
            'description' => 'required|string',
            'start_year' => 'required|integer|min:1900|max:' . date('Y'), // Validate the start year range
            'end_year' => 'required|integer|min:1900|max:' . date('Y') // Validate the end year range
        ]);

        Experience::insert([
            'user_id'=>Auth::id(),
            'position'=> $request->position,
            'company_name'=> $request->company_name,
            'description'=> $request->description,
            'start_year'=> $request->start_year,
            'end_year'=> $request->end_year,
       
        ]);

        // dd($request);

        return back()->with('experience', 'Experience record created successfully!');
    }

    public function experience_destroy($id)
    {
        Experience::destroy($id);
        return back()->with('experience', 'Education record deleted successfully!');
    }

public function experience_update(Request $request, $id){
    // Retrieve the specific education record by ID
    $experience = Experience::find($id);

    // Check if the education record belongs to the authenticated user
    if ($experience->user_id !== Auth::id()) {
        return back()->with('error', 'Unauthorized action!');
    }

    // Update the education record with the form data
    $experience->update([
        'position' => $request->position,
        'company_name' => $request->company_name,
        'description' => $request->description,
        'start_year' => $request->start_year,
        'end_year' => $request->end_year,
    ]);
    
    return back()->with('experience', 'Education record updated successfully!');
}


// profile Awards ==============================================================
    public function award_store(Request $request)
    {
        $validatedData = $request->validate([
            'award' => 'required|string',
            'institute' => 'required|string',
            'description' => 'required|string',
            'start_year' => 'required|integer|min:1900|max:' . date('Y'), // Validate the start year range
            'end_year' => 'required|integer|min:1900|max:' . date('Y') // Validate the end year range
        ]);

        Award::insert([
            'user_id'=>Auth::id(),
            'award'=> $request->award,
            'institute'=> $request->institute,
            'description'=> $request->description,
            'start_year'=> $request->start_year,
            'end_year'=> $request->end_year,
       
        ]);

        return back()->with('Awards', 'Awards record created successfully!');
    }

public function award_destroy($id)
{
    Award::destroy($id);
    return back()->with('Awards', 'Awards record deleted successfully!');
}


public function award_update(Request $request, $id){
 
    $awards = Award::find($id);


    if ($awards->user_id !== Auth::id()) {
        return back()->with('error', 'Unauthorized action!');
    }

    // Update the education record with the form data
    $awards->update([
        'award' => $request->award,
        'institute' => $request->institute,
        'description' => $request->description,
        'start_year' => $request->start_year,
        'end_year' => $request->end_year,
    ]);
    
    return back()->with('Awards', 'award record updated successfully!');
}

}
