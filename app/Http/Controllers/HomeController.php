<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\ServiceInformation;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\Privacy;
use App\Models\Term;
use App\Models\Refund;
use App\Models\About;
use App\Models\General;
use App\Models\Banner;
use App\Models\Trust;
use App\Models\AwardWinner;
use App\Models\Favourite;
use App\Models\Invoice;
use App\Models\Checkout;
use App\Models\Proposal;
use App\Models\Footer;
use App\Models\Review;
use App\Models\Order;
use App\Models\NewsLetter;
use App\Notifications\ActiveOrderNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    //
    public function home(){
        try {
            $category = Category::get();
            $categories = Category::get();
            $banner = Banner::first();
            $footer = Footer::first();
            $general = General::get();
            $trust = Trust::get();
            $awardwinner = AwardWinner::first();

            $reviews = Review::where('service_information_id')->get();

            // Fetch services where user_id is not the same as the authenticated user's ID
            $services = ServiceInformation::where('status', 'active')
                                          ->where('user_id', '!=', auth()->id())
                                          ->has('rel_to_gallery')
                                          ->has('rel_to_faq')
                                          ->with(['rel_to_gallery', 'rel_to_faq'])
                                          ->latest()->get();



            return view('welcome', compact('category', 'services', 'categories', 'banner', 'general', 'trust', 'awardwinner', 'footer'));
        } catch (\Exception $e) {
            // Log the exception or handle it as per your application's requirements
            // For example, you can log the error message:
            // \Log::error($e->getMessage());

            // Return an error view or redirect with an error message
            return view('error'); // Create an 'error.blade.php' view for displaying errors
        }
    }
    

    // public function payment_cancel(){
    //     return "Your order has been cancelled";
    // }

    public function payment_cancel(){

        return view('checkout.payment_cancel');
    }
    public function newsletter(){
        $newsLetter = NewsLetter::latest()->get();
        return view('newsletter.newsletter',compact('newsLetter'));
    }

    public function newsletter_store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:news_letters,email',
        ]);
    
        // Create a new NewsLetter instance and save the email
        NewsLetter::create([
            'email' => $request->input('email'),
        ]);
    
        // Retrieve the updated list of email addresses
        $newsLetter = NewsLetter::get();
    
        // Return the view with the updated list of email addresses
        return back()->with('success', 'Email added to newsletter successfully!');
    }


    public function terms(){
        $terms = Term::get();
        return view('policy.term',compact('terms'));
    }
    public function privacy(){
        $privacy = Privacy::get();
        return view('policy.privacy',compact('privacy'));
    }
    public function refund(){
        $refund = Refund::get();
        return view('policy.refund',compact('refund'));
    }
    public function about(){
        $about = About::get();
        return view('policy.about',compact('about'));
    }

    public function all_category(){
        $category = Category::get();
        $categories = Category::get();
        $banner = Banner::first();
        $footer = Footer::first();
        $general = General::get();
        $trust = Trust::get();
        $awardwinner = AwardWinner::first();

        $reviews = Review::where('service_information_id')->get();
    

        return view('all_category.all_category', compact('category', 'categories', 'banner', 'general', 'trust', 'awardwinner', 'footer'));
    }
    

    public function favourite()
    {
        $userId = Auth::id();
        $footer = Footer::first();
        $existingFavorites = Favourite::where('user_id', $userId)
                                    ->with('rel_to_user')
                                    ->with('rel_to_service')
                                    ->get();

        return view('favouritre_service.favourite', compact('footer', 'existingFavorites'));
    }



    public function favourite_save(Request $request)
    {
        $serviceInformationId = $request->input('service_information_id');
        $userId = Auth::id();

        // Check if the service is already in favorites for this user
        $existingFavorite = Favourite::where('user_id', $userId)
                                    ->where('service_information_id', $serviceInformationId)
                                    ->first();

        if (!$existingFavorite) {
            // If the service is not already in favorites, create a new favorite record
            Favourite::create([
                'user_id' => $userId,
                'service_information_id' => $serviceInformationId,
            ]);

            return redirect()->route('favourite')->with('success', 'Service added to favorites successfully');

            // return back()->with('success', 'Service added to favorites successfully!');
        } else {
            // If the service is already in favorites, display an error message or handle it accordingly
            return redirect()->route('favourite')->with('error', 'Service is already in your favorites!');
            // return back()->with('error', 'Service is already in your favorites!');
        }
    }


    public function favourite_delete($id)
    {
        // Find the favorite item by ID
        $favorite = Favourite::find($id);

        // Check if the favorite item exists
        if (!$favorite) {
            // Handle the case where the favorite item is not found
            return back()->with('error', 'Favorite item not found');
        }

        // Perform the deletion
        $favorite->delete();

        return back()->with('success', 'Favorite item deleted successfully');
    }



    public function category_service(Request $request)
    {
        //  dd($request->all());
        // Use Eloquent to build the base query
        $query = ServiceInformation::where('status', 'active')
        ->where('user_id', '!=', auth()->id())
        ->has('rel_to_gallery')
        ->has('rel_to_faq')
        ->with(['rel_to_gallery', 'rel_to_faq']);

        $request->flash();
        // dd($request->all());
        // Apply filters based on request data
        if ($request->has('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $searchTerm = $request->input('search');
        if (!empty($searchTerm)) {
            $query->where('service_title', 'like', '%' . $searchTerm . '%');
        }
       // Price filter
        // if ($request->has('min_price') && $request->has('max_price')) {
        //     $query->whereBetween('price', [$request->input('min_price'), $request->input('max_price')]);
        // } elseif ($request->has('min_price')) {
        //     $query->where('price', '>=', $request->input('min_price'));
        // } elseif ($request->has('max_price')) {
        //     $query->where('price', '<=', $request->input('max_price'));
        // }
        // Price filter

        $minPrice = $request->input('minprice');
        $maxPrice = $request->input('price');
        $languages = $request->input('languages');
        $country = $request->input('country');
    
        if (!empty($minPrice)) {
            $query->where('price', '>=', $minPrice);
        }
    
        if (!empty($maxPrice)) {
            $query->where('price', '<=', $maxPrice);
        }
    

        // if ($request->has('minprice')) {
        //     $query->where('price','>=', $request->input('minprice'));
        // }

        if ($request->has('delivery_time')) {
            $query->where('delivery_time', $request->input('delivery_time'));
        }

        if (!empty($languages)) {
            $query->where('languages', $request->input('languages'));
        }

        if (!empty($country)) {
            $query->where('country', $request->input('country'));
        }

        // Get the filtered services
        $services = $query->get();
        // dd($services);
        // Load necessary data like $footer and $categories
        $footer = Footer::first();
        $categories = Category::get();
       

        // Pass the data to the view
        return view('category_service.category_service', compact('footer', 'services', 'categories'));
    }







    // public function filterServices(Request $request)
    // {
    //     $footer = Footer::first();
    //     $category = Category::get();

    //     $query = DB::table('service_information');

    //     if ($request->has('category')) {
    //         $query->where('category', $request->input('category'));
    //     }

    //     if ($request->has('min_price')) {
    //         $query->where('price', '>=', $request->input('min_price'));
    //     }

    //     if ($request->has('max_price')) {
    //         $query->where('price', '<=', $request->input('max_price'));
    //     }

    //     if ($request->has('delivery_time')) {
    //         // Extract the number of days from the input string and cast to integer
    //         $days = (int) filter_var($request->input('delivery_time'), FILTER_SANITIZE_NUMBER_INT);
    //         // Compare the number of days
    //         $query->whereRaw('CAST(SUBSTRING_INDEX(delivery_time, " ", 1) AS UNSIGNED) <= ?', [$days]);
    //     }

    //     if ($request->has('country')) {
    //         $query->where('country_id', $request->input('country'));
    //     }

    //     if ($request->has('language')) {
    //         $query->where('language', $request->input('language'));
    //     }

    //     // Add more filter criteria as needed

    //     $service = $query->get();

    //     return view('category_service.category_service', compact('service','category','footer'));
    // }





        public function service_checkout($id){
            $footer = Footer::first();
            $categories = Category::get();

            // Retrieve the service information associated with the proposal ID
            $order = Order::findOrFail($id);

            // $service = $proposal->rel_to_service;

            return view('checkout.checkout', compact('footer', 'categories','order'));
        }


        public function confirm_order($id){
            $footer = Footer::first();
            $categories = Category::get();
            $checkout = Checkout::findOrFail($id);

            return view('checkout.order_confirm', compact('footer', 'categories','checkout'));
        }


        public function checkout_store(Request $request, $id)
        {
            // Validate the form data
            $request->validate([
                'name' => 'required|string|max:255',
                'additional' => 'nullable',
                'country' => 'required|exists:countries,id',
                'city' => ['required', Rule::exists('cities', 'id')->where(function ($query) use ($request) {
                    $query->where('country_id', $request->input('country'));
                })],
                'state' => 'required|string|max:255',
                'house' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'service_name' => 'required|string|max:255',
                'service_price' => 'required|numeric',
                'shipping_price' => 'required|numeric',
            ], [
                'country.exists' => 'Please select a valid country.',
                'city.exists' => 'Please select a valid city within the selected country.',
            ]);
            // Get user ID from the authenticated user
            $user_id = Auth::user()->id;


            // Create a new Checkout instance and populate the fields
            $checkout = new Checkout();
            $checkout->user_id = $user_id;
            $checkout->name = $request->input('name');

            $checkout->email = $request->input('email');
            $checkout->company = $request->input('company');
            $checkout->country = $request->input('country');
            $checkout->city = $request->input('city');
            $checkout->state = $request->input('state');
            $checkout->house = $request->input('house');
            $checkout->apartment = $request->input('apartment');
            $checkout->phone = $request->input('phone');
            $checkout->additional = $request->input('additional');
            $checkout->service_name = $request->input('service_name');
            $checkout->service_price = $request->input('service_price');
            $checkout->shipping_price = $request->input('shipping_price');

            // Save the checkout details to the database
            $checkout->save();

            // Get the ID of the inserted checkout record
            $checkout_id = $checkout->id;


            // Update the proposal status

            $order = Order::findOrFail($id);
            $order->update([
                'checkout_id' => $checkout_id,
            ]);

            $proposal_id = $request->input('proposal_id');

            if($request->payment_method == 'ccbill'){
                // dd("ccbill is not available now. Please wait until ccbill is available. You can use other payment methods.");

                // $order = Order::find($request->order_id);
                $order->update([
                    'status' => 'in process',
                ]);
    
                $orderId = $order->id;
                $seller = User::find($order->seller_id);
                $seller->notify(new ActiveOrderNotification($orderId,$seller));
    
                $invoice = Invoice::where('proposal_id', $order->proposal_id)->first();

                if ($invoice) {
                    // Update the invoice status to 'Completed'
                    $invoice->update([
                        'status' => 'Completed',
                    ]);
                }
    

            }elseif($request->payment_method == 'crypto'){
                dd("crypto is not available now. Please wait until ccbill is available. You can use other payment methods.");
            }elseif($request->payment_method == 'paypal'){
                return redirect()->route('make.payment', ['order_id' => $id, 'proposal_id' => $proposal_id ]);      
            }

            // Redirect the user after the order is successfully processed
            return redirect()->route('confirm.order', ['id' => $order->id])->with('success', 'Your Order Is placed!');
        }





}
