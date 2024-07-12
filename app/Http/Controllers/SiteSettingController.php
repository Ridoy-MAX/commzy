<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Privacy;
use App\Models\Term;
use App\Models\Refund;
use App\Models\About;
use App\Models\General;
use App\Models\Banner;
use App\Models\Trust;
use App\Models\AwardWinner;
use App\Models\Footer;
use App\Models\Commission;
use App\Http\Controllers\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Image;
class SiteSettingController extends Controller
{
    //privacy setting==================================================================================
    public function privacy(Request $request): View
    {
        $user = Auth::user();
        $privacySetting = Privacy::first();
    
        if (!$privacySetting) {
            $privacySetting = new Privacy();
        }
    
        return view('site_settings.privacy', compact('privacySetting'));
    }

  
    
  
    public function privacy_update(Request $request)
    {
        $user_id = $request->input('user_id');
        $description = $request->input('description');
    
        // Find the privacy setting record for the current user
        $privacySetting = Privacy::first();
    
        // If the record doesn't exist, create a new one
        if (!$privacySetting) {
            $privacySetting = new Privacy();
            $privacySetting->user_id = $user_id;
        }
    
        // Update the description
        $privacySetting->description = $description;
        $privacySetting->save();
    
        return back()->with('success', 'Privacy settings updated successfully!');
    }

    public function commission_update(Request $request)
    {
        $commission = $request->input('commission');
        $pending_clearance = $request->input('pending_clearance');
        
        // Find the first created commission setting record
        $commissionSetting = Commission::orderBy('id', 'asc')->first();
        
        // If the record doesn't exist, create a new one
        if (!$commissionSetting) {
            $commissionSetting = new Commission();
        }
        
        // Update the commission value
        $commissionSetting->commission = $commission;
        $commissionSetting->pending_clearance = $pending_clearance;
        $commissionSetting->save();
        
        return back()->with('commission', 'Commission setting and pending clearance days updated successfully!');
    }
    
    


    //Terms of Service==================================================================================
    public function term(Request $request): View
    {
        $termSetting = Term::first();
        if (!$termSetting) {
            $termSetting = new Term();
        }
        return view('site_settings.term', compact('termSetting'));
    }
    
    
  
    public function term_update(Request $request)
    {
        $user_id = $request->input('user_id');
        $description = $request->input('description');
    
        // Find the privacy setting record for the current user
        $termSetting = Term::first();
    
        // If the record doesn't exist, create a new one
        if (!$termSetting) {
            $termSetting = new Term();
            $termSetting->user_id = $user_id;
        }
    
        // Update the description
        $termSetting->description = $description;
        $termSetting->save();
    
        return back()->with('term', 'Terms of Service updated successfully!');
    }


    //Refund Policy==================================================================================
    public function refund(Request $request): View
    {
        $user = Auth::user();
        $refundSetting = Refund::first();
    
        if (!$refundSetting) {
            $refundSetting = new Refund();
            $refundSetting->user_id = $user->id;
            $refundSetting->description = ''; // Set default description if needed
        }
    
        return view('site_settings.refund', compact('refundSetting'));
    }
    
  
    public function refund_update(Request $request)
    {
        $user_id = $request->input('user_id');
        $description = $request->input('description');
    
        // Find the privacy setting record for the current user
        $refundSetting = Refund::first();
    
        // If the record doesn't exist, create a new one
        if (!$refundSetting) {
            $refundSetting = new Refund();
            $refundSetting->user_id = $user_id;
        }
    
        // Update the description
        $refundSetting->description = $description;
        $refundSetting->save();
    
        return back()->with('refund', 'Refund Policy updated successfully!');
    }

    //About Us==================================================================================
    public function about(Request $request): View
    {
        $user = Auth::user();
        $aboutSetting = About::first();
    
        if (!$aboutSetting) {
            $aboutSetting = new About();
            $aboutSetting->user_id = $user->id;
            $aboutSetting->description = ''; // Set default description if needed
        }
    
        return view('site_settings.about', compact('aboutSetting'));
    }
    
  
    public function about_update(Request $request)
    {
        $user_id = $request->input('user_id');
        $description = $request->input('description');
    
        // Find the privacy setting record for the current user
        $aboutSetting = About::first();
    
        // If the record doesn't exist, create a new one
        if (!$aboutSetting) {
            $aboutSetting = new About();
            $aboutSetting->user_id = $user_id;
        }
    
        // Update the description
        $aboutSetting->description = $description;
        $aboutSetting->save();
    
        return back()->with('about', 'About Us updated successfully!');
    }




    //General Setting==================================================================================

    public function general(Request $request): View
    {
      
        $commissionSetting = Commission::first();
    
        if (!$commissionSetting) {
            $commissionSetting = new Commission();

            $commissionSetting->commission = ''; // Set default description if needed
        }
      
        $generalSetting = General::first();
    
        if (!$generalSetting) {
            $generalSetting = new General();

            $generalSetting->description = ''; // Set default description if needed
        }
    
        return view('site_settings.general', compact('generalSetting','commissionSetting'));
    }

    public function general_update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'site_title' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'site_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'fav_icon' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Get the authenticated user's ID
        $user_id = Auth::user()->id;
    
        // Find the general settings record for the current user or create a new one
        $generalSettings = General::firstOrNew();
    
        // Update text fields
        $generalSettings->site_title = $request->input('site_title');
        $generalSettings->meta_title = $request->input('meta_title');
        $generalSettings->meta_description = $request->input('meta_description');
    
        // Handle site logo upload
        if ($request->hasFile('site_logo')) {
            $siteLogo = $request->file('site_logo');
            $siteLogoPath = $siteLogo->store('general/site_logo', 'public');
    
            // Delete existing logo if it exists
            if ($generalSettings->site_logo) {
                Storage::disk('public')->delete($generalSettings->site_logo);
            }
    
            // Update the site logo path
            $generalSettings->site_logo = $siteLogoPath;
        }
    
        // Handle fav icon upload
        if ($request->hasFile('fav_icon')) {
            $favIcon = $request->file('fav_icon');
            $favIconPath = $favIcon->store('general/fav_icon', 'public');
    
            // Delete existing fav icon if it exists
            if ($generalSettings->fav_icon) {
                Storage::disk('public')->delete($generalSettings->fav_icon);
            }
    
            // Update the fav icon path
            $generalSettings->fav_icon = $favIconPath;
        }
    
        // Save the changes to the database
        $generalSettings->save();
    
        return back()->with('general', 'General Setting updated successfully!');
    }
    
    
    
    

    // public function site_logo_destroy($id){
    //     $generaldestroy = General::findOrFail($id);

    //     // Delete the image file from the public directory
    //     $delete_from =public_path($generaldestroy->site_logo);
    //     unlink($delete_from);

    //     // File::delete(public_path('trust/' . $trust->image_one));

    //     // Delete the record from the database
    //     $generaldestroy->delete();

    //     return back()->with('delete', ' image deleted successfully!');
    // }


    
    //Banner Setting==================================================================================

    public function banner(Request $request): View
    {
        $user = Auth::user();
        $bannerSetting = Banner::first();
        $trusts = Trust::all();
        $awardSetting = AwardWinner::first();
        $footerSetting = Footer::first();
        if (!$bannerSetting) {
            $bannerSetting = new Banner();
        }
    
        return view('site_settings.banner', compact('bannerSetting','trusts','awardSetting','footerSetting'));
    }


    
 



    public function banner_update(Request $request)
    {
        // Validate the form data
        $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_description' => 'required|string|max:255',
            'image_one' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'image_two' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'iconbox_one_title' => 'required|string|max:255',
            'iconbox_one_detail' => 'required|string|max:255',
            'iconbox_two_title' => 'required|string|max:255',
            'iconbox_two_detail' => 'required|string|max:255',
        ]);
    
        // Get the current user's ID
        $user_id = Auth::user()->id;
    
        // Find the existing banner record for the user
        $banner = Banner::first();
    
        // Handle file uploads if images are provided
        if ($request->hasFile('image_one')) {
            // Delete existing image if it exists
            if ($banner && $banner->image_one) {
                Storage::delete($banner->image_one);
            }
    
            // Store the new image with the user's ID as the filename
            $imageOnePath = $request->file('image_one')->move('banners/one', $user_id . '.' . $request->file('image_one')->getClientOriginalExtension(), 'public');
        }
    
        if ($request->hasFile('image_two')) {
            // Delete existing image if it exists
            if ($banner && $banner->image_two) {
                Storage::delete($banner->image_two);
            }
    
            // Store the new image with the user's ID as the filename
            $imageTwoPath = $request->file('image_two')->move('banners/two', $user_id . '.' . $request->file('image_two')->getClientOriginalExtension(), 'public');
        }
    
        // Save form data to the database
        if (!$banner) {
            $banner = new Banner();
            $banner->user_id = $user_id;
        }
    
        $banner->banner_title = $request->input('banner_title');
        $banner->banner_description = $request->input('banner_description');
        $banner->iconbox_one_title = $request->input('iconbox_one_title');
        $banner->iconbox_one_detail = $request->input('iconbox_one_detail');
        $banner->iconbox_two_title = $request->input('iconbox_two_title');
        $banner->iconbox_two_detail = $request->input('iconbox_two_detail');
        if (isset($imageOnePath)) {
            $banner->image_one = $imageOnePath;
        }
        if (isset($imageTwoPath)) {
            $banner->image_two = $imageTwoPath;
        }
    
        $banner->save();
    
        return back()->with('banner', 'Banner updated successfully!');
    }
    
    private function uploadImage($image)
    {
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->move('banners/', $imageName);
        return $imageName;
    }
    
    
    //Banner Setting  Trusted==================================================================================
 
    public function trusted_create(Request $request)
    {
       
        // Validate the form data
        $request->validate([
            'image_one' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image_one')) {
            $image = $request->file('image_one');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the file in the public/trust directory
            $image->move(public_path('trust'), $imageName);

            // Save the image filename to the database
            $user_id = Auth::user()->id;
            Trust::create([
                'user_id' => $user_id,
                'image_one' => $imageName, // Store the filename, not the image object
                // ... other fields
            ]);

            // Redirect back with success message
            return back()->with('trust', 'Image uploaded successfully!');
        }

        // If no file was uploaded, redirect back with an error message
        return back()->withErrors(['image_one' => 'Please choose a valid image file.']);
    }




    public function trusted_destroy($id)
    {
        $trust = Trust::findOrFail($id);

        // Delete the image file from the public directory
        $delete_from =public_path('trust/'.$trust->image_one);
        unlink($delete_from);

        // File::delete(public_path('trust/' . $trust->image_one));

        // Delete the record from the database
        $trust->delete();

        return back()->with('delete', 'Trust image deleted successfully!');
    }


        
    //Award winner Setting  ==================================================================================
    // public function award_winner_update()
    // {
    //     $awardSetting = AwardWinner::first(); // Assuming you want to edit the first record. Adjust the query as needed.
    //     return view('award.edit', compact('awardSetting'));
    // }

    public function award_winner_update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'professionals_number_one' => 'required|integer',
            'professionals_number_two' => 'required|integer',
            'devided_number' => 'required|integer',
            'professionals_details' => 'required|string',
            'satisfied_percentage' => 'required|integer',
            'satisfied_details' => 'required|string',
        ]);
    
        $user_id = Auth::user()->id;
        $awardSetting = AwardWinner::first();
    
        // If the record exists, update its fields with the validated data
        if ($awardSetting) {
            $awardSetting->update($request->all());
            return back()->with('success', 'Award Winners settings updated successfully!');
        } else {
            // If no record is found, create a new one with the user_id and validated data
            AwardWinner::create([
                'user_id' => $user_id,
                'title' => $request->title,
                'description' => $request->description,
                'professionals_number_one' => $request->professionals_number_one,
                'professionals_number_two' => $request->professionals_number_two,
                'devided_number' => $request->devided_number,
                'professionals_details' => $request->professionals_details,
                'satisfied_percentage' => $request->satisfied_percentage,
                'satisfied_details' => $request->satisfied_details,
            ]);
    
            return back()->with('success', 'Award Winners settings created successfully!');
        }
    }
    // footer====================================
    public function footer_update(Request $request)
    {
        $request->validate([
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
           
        ]);
    
        $user_id = Auth::user()->id;
        $footerSetting = Footer::first();
    
        // If the record exists, update its fields with the validated data
        if ($footerSetting) {
            $footerSetting->update($request->all());
            return back()->with('footer', 'social link add successfully!');
        } else {
            // If no record is found, create a new one with the user_id and validated data
            Footer::create([
                'user_id' => $user_id,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
              
            ]);
    
            return back()->with('footer', 'social link add successfully!');
        }
    }
    
}
