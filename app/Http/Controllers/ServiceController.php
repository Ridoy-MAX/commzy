<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\ServiceInformation;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\Review;
use App\Models\Footer;
// use App\Models\Category;
use App\Models\LanguageList;
use App\Rules\MaxPhotos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    // add service basic information==============================================
    public function service()
    {
        $userId = Auth::id();
        $services = ServiceInformation::where('user_id', $userId)
                                      ->where('status', 'active')
                                      ->has('rel_to_gallery') // Filters services with associated galleries
                                      ->has('rel_to_faq') // Filters services with associated FAQs
                                      ->with(['rel_to_gallery', 'rel_to_faq'])
                                      ->latest()->get();
        $deactiveservices = ServiceInformation::where('user_id', $userId)
                                      ->where('status', 'deactive')
                                      ->has('rel_to_gallery') // Filters services with associated galleries
                                      ->has('rel_to_faq') // Filters services with associated FAQs
                                      ->with(['rel_to_gallery', 'rel_to_faq'])
                                      ->latest()->get();
        $incompleteservices = ServiceInformation::where('user_id', $userId)
                                      ->where('status', 'active')
                                      ->where(function($query) {
                                          $query->doesntHave('rel_to_gallery')
                                                ->orWhereDoesntHave('rel_to_faq');
                                      })
                                      ->with(['rel_to_gallery', 'rel_to_faq'])
                                      ->latest()->get();
                                  
                                     
    
                                      return view('service.service', [
                                        'services' => $services,
                                        'deactiveservices' => $deactiveservices,
                                        'incompleteservices' => $incompleteservices
                                    ]);
                                    
    }

    public function blockService($id)
    {
        // Find the service information by ID
        $service = ServiceInformation::findOrFail($id);

        // Update the status to "deactive"
        $service->update([
            'status' => 'deactive',
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Service Deactive successfully!');
    }
    public function activeService($id)
    {
        // Find the service information by ID
        $service = ServiceInformation::findOrFail($id);

        // Update the status to "deactive"
        $service->update([
            'status' => 'active',
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Service active successfully!');
    }

    public function deleteService($id) {
        $service = ServiceInformation::withTrashed()->findOrFail($id);
        $service->delete();
    
        // Optionally, you can add a message to indicate successful deletion
        return back()->with('success', 'Service deleted successfully.');
    }
    
    
 

  
    
    public function service_create(){
        $category = Category::get();
        return view('service.service_create', [ 'category' => $category ]);
    }

    public function service_information_store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'service_title' => 'required|string',
            'price' => 'required|string',
            'category_id' => 'required|string',
            'delivery_time' => 'required|string',
            'skill' => 'required|array',
            'country' => 'required',
            'languages' => 'required|array',
            'tag' => 'array',
            'service_detail' => 'required|string',
            'meta_title' => 'required|string',
            'meta_description' => 'required|string',
        ]);
    
        $user_id = Auth::user()->id;
        $baseSlug = Str::slug($validatedData['service_title']);
        $slug = $baseSlug;
        $count = 1;
    
        // Check if the generated slug already exists in the database
        while (ServiceInformation::where('slug', $slug)->exists()) {
            // If it exists, append a unique identifier to the slug and check again
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        // Create a new ServiceInformation instance and save the data
        $serviceInformation = ServiceInformation::create([
            'user_id' => $user_id,
            'slug' => $slug, 
            'service_title' => $validatedData['service_title'],
            'price' => $validatedData['price'],
            'category_id' => $validatedData['category_id'],
            'delivery_time' => $validatedData['delivery_time'],
            'skill' => implode(',', $validatedData['skill']),
            'tag' => implode(',', $validatedData['tag']),

            'languages' => implode(',', $validatedData['languages']),
            'country' => $validatedData['country'],
            
            'service_detail' => $validatedData['service_detail'],
            'meta_title' => $validatedData['meta_title'],
            'meta_description' => $validatedData['meta_description'],
            'status' => 'active',
        ]);
    
        // Pass the newly created ServiceInformation ID to the faq_store method
        return redirect()->route('service.faq', ['serviceInformationId' => $serviceInformation->id])
        ->with('service', 'Service information uploaded successfully!');

    }


    public function service_information_update($id)
    {
        $category = Category::get();
        $serviceInformation = ServiceInformation::where('id', $id)->firstOrFail();
     
    
        if (!$serviceInformation) {
            // Handle the case when the service information with the given ID is not found, for example, redirect to an error page or display an error message.
            abort(404);
        }
    
        return view('service.service_information_update', ['serviceInformation' => $serviceInformation, 'category' => $category]);
    }


    public function information_update(Request $request)
    {
       
        $validatedData = $request->validate([
            'service_title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|string|max:255',
            'delivery_time' => 'required|string|max:255',
            'service_detail' => 'required|string',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'skill' => 'nullable|array',
            'tag' => 'nullable|array',
        ]);
    
        $serviceInformationId = $request->input('service_information_id');
        $user_id = Auth::user()->id;
    
        $serviceInformation = ServiceInformation::findOrFail($serviceInformationId);

        $baseSlug = Str::slug($validatedData['service_title']);
        $slug = $baseSlug;
        $count = 1;

        // Check if the generated slug already exists in the database
        while (ServiceInformation::where('slug', $slug)->where('id', '!=', $serviceInformationId)->exists()) {
            // If it exists, append a unique identifier to the slug and check again
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        
      
        $serviceInformation->update([
            'user_id' => $user_id,
            'service_title' => $validatedData['service_title'],
            'slug' => $slug, 
            'price' => $validatedData['price'],
            'category_id' => $validatedData['category_id'],
            'delivery_time' => $validatedData['delivery_time'],
            'skill' => implode(',', $validatedData['skill']),
            'tag' => implode(',', $validatedData['tag']),
            'service_detail' => $validatedData['service_detail'],
            'meta_title' => $validatedData['meta_title'],
            'meta_description' => $validatedData['meta_description'],
            'status' => 'active',
        ]);
        
        return redirect()->back()->with('success', 'Service information updated successfully!');
    }
    




    // add service Add Frequently Asked Questions==============================================
    public function service_faq($serviceInformationId)
    {
        $faq = Faq::where('service_information_id', $serviceInformationId)->get();
        return view('service.faq', ['faq' => $faq, 'serviceInformationId' => $serviceInformationId]);
    }
    
    public function faq_store(Request $request, $serviceInformationId)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);
    
        // Save the frequently asked question with service_information_id
        Faq::create([
            'service_information_id' => $serviceInformationId,
            'question' => $validatedData['question'],
            'answer' => $validatedData['answer'],
        ]);
    
        // Redirect back or perform any other actions
        return redirect()->back()->with('success', 'Frequently Asked Question saved successfully.');
    }
    public function faq_update_store(Request $request, $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);
    
        // Save the frequently asked question with service_information_id
        Faq::create([
            'service_information_id' => $id,
            'question' => $validatedData['question'],
            'answer' => $validatedData['answer'],
        ]);
    
        // Redirect back or perform any other actions
        return redirect()->back()->with('success', 'Frequently Asked Question saved successfully.');
    }


    public function service_faq_update($id){
        $faqs = Faq::where('service_information_Id', $id)->get();
        return view('service.faq_update', ['faqs' => $faqs, 'id' => $id]);
    }



    public function faq_update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update($validatedData);

        return redirect()->back()->with('success', 'Frequently Asked Question updated successfully.');
    }

    public function softDelete($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete(); // Soft delete
        return redirect()->back()->with('success', 'Frequently Asked Question  deleted successfully.');
    }


    // add service gallery==============================================

    public function service_gallery($serviceInformationId)
    {
        $gallery = Gallery::where('service_information_id', $serviceInformationId)->get();
        return view('service.gallery', ['gallery' => $gallery, 'serviceInformationId' => $serviceInformationId]);
    }
    
    public function service_gallery_update($id)
    {
        $gallery = Gallery::where('service_information_id', $id)->get();
        return view('service.gallery_update', ['gallery' => $gallery, 'id' => $id]);
    }
        
    
    public function save_gallery(Request $request, $serviceInformationId)
    {
        // Validate the form data
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Check if there are already three images uploaded for the service information ID
        $existingImagesCount = Gallery::where('service_information_id', $serviceInformationId)->count();
    
        if ($existingImagesCount >= 3) {
            // If there are already three images, return with an error message
            return back()->withErrors(['image' => 'You can upload a maximum of three images.']);
        }
    
        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            // Store the file in the public/trust directory
            $image->move(public_path('service/gallery'), $imageName);
    
            // Save the image filename to the database
            Gallery::create([
                'service_information_id' => $serviceInformationId,
                'image' => $imageName, // Store the filename, not the image object
                // ... other fields
            ]);
    
            // Redirect back with success message
            return back()->with('success', 'Image uploaded successfully!');
        }
    
        // If no file was uploaded, redirect back with an error message
        return back()->withErrors(['image' => 'Please choose a valid image file.']);
    }
    

    public function update_save_gallery(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Check if there are already three images uploaded for the service information ID
        $existingImagesCount = Gallery::where('service_information_id', $id)->count();
    
        if ($existingImagesCount >= 3) {
            // If there are already three images, return with an error message
            return back()->withErrors(['image' => 'You can upload a maximum of three images.']);
        }
    
        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            // Store the file in the public/trust directory
            $image->move(public_path('service/gallery'), $imageName);
    
            // Save the image filename to the database
            Gallery::create([
                'service_information_id' => $id,
                'image' => $imageName, // Store the filename, not the image object
                // ... other fields
            ]);
    
            // Redirect back with success message
            return back()->with('success', 'Image uploaded successfully!');
        }
    
        // If no file was uploaded, redirect back with an error message
        return back()->withErrors(['image' => 'Please choose a valid image file.']);
    }
    
    

    public function gallery_delete($id)
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            abort(404); // Or handle not found in your way
        }

        $gallery->delete();

        // Redirect back or to any other page after deletion
        return redirect()->back()->with('success', 'Gallery deleted successfully');
    }



    // public function service_review(){

    // }


    // public function service_details($id){
    //     $footer = Footer::first();
    //     $categories = Category::get();
    //     $review = Review::where('service_information_id', $id)->get();
    //     $totalReviews = $review->count();
    //     $service = ServiceInformation::findOrFail($id);

    //     return view('service_details.service_details', compact('footer', 'categories','service','review','totalReviews'));
    // }

  
    public function service_details($slug){
        $footer = Footer::first();
        $categories = Category::get();
        $service = ServiceInformation::where('slug', $slug)->firstOrFail();
        $reviews = Review::where('service_information_id', $service->id)->get();
        $totalReviews = $reviews->count();
        
        // Calculate average rating
        $sumRatings = 0;
        foreach ($reviews as $review) {
            $sumRatings += $review->rating;
        }
        $averageRating = $totalReviews > 0 ? $sumRatings / $totalReviews : 0;
        
        return view('service_details.service_details', compact('footer', 'categories', 'service', 'reviews', 'totalReviews', 'averageRating'));
    }
    
  
    public function user_details($id){
        $footer = Footer::first();
        $categories = Category::get();
    
        // Get the user based on the provided ID
        $user = User::findOrFail($id);
    
        // Fetch services related to the user with associated galleries and FAQs
        $services = ServiceInformation::where('user_id',$id)
        ->where('status', 'active')
        ->has('rel_to_gallery') // Filters services with associated galleries
        ->has('rel_to_faq') // Filters services with associated FAQs
        ->get();



    
        return view('user_service.user_service', compact('footer', 'categories', 'services', 'user'));
    }
    
    
    
}
