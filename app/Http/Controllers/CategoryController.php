<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Category;
// use App\Http\Controllers\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function category(){
        $category = Category::get();
    
        return view('category.category', [ 'category' => $category ]);
    }
    public function category_create(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'title' => 'required',
            'descripton' => 'required',
        ]);
    
        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = $request->input('name');
            $title = $request->input('title');
            $descripton = $request->input('descripton');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            // Store the file in the public/category directory
            $image->move(public_path('category'), $imageName);
    
            // Save the image filename to the database
            $user_id = Auth::user()->id;
            $category = Category::create([
                'user_id' => $user_id,
                'name' => $name,
                'title' => $title,
                'descripton' => $descripton,
                'image' => 'category/' . $imageName, // Store the file path relative to the public directory
                // ... other fields
            ]);
    
            // Redirect back with success message
            return back()->with('category', 'Category image uploaded successfully!');
        }
    
        // If no file was uploaded, redirect back with an error message
        return back()->withErrors(['image' => 'Please choose a valid image file.']);
    }
    
    

    public function category_update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'title' => 'required',
            'descripton' => 'required',
        ]);
    
        $category = Category::find($id);
    
        // Store the old image path
        $oldImagePath = $category->image;
    
        // Handle file upload if a new image is provided
        if ($request->hasFile('image')) {
            $newImage = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('category'), $imageName);
    
            // Update category with the new image path
            $category->image = 'category/' . $imageName;
    
            // Delete the old image file
            if (File::exists(public_path($oldImagePath))) {
                File::delete(public_path($oldImagePath));
            }
        }
    
        $category->name = $request->input('name');
        $category->title = $request->input('title');
        $category->descripton = $request->input('descripton');
        $category->save();
    
        // Redirect back with success message
        return back()->with('category', 'Category updated successfully!');
    }

    public function category_destroy(Request $request, $id)
    {
        // Find the category by its ID
        $category = Category::find($id);
    
        // Store the image path for deletion
        $imagePath = public_path($category->image);
    
        // Delete the category from the database
        $category->delete();
    
        // Delete the associated image file
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    
        // Redirect back with success message
        return back()->with('delete', 'Category deleted successfully!');
    }

}
