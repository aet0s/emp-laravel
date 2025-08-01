<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{
    

     public function category()
    {

        $category  = Category::latest()->paginate(10);
        return view('admin.Category.category-list')->with('category', $category );
    }

           public function category_store(Request $request)
            {
                $request->validate([
                    'category_name' => 'required|string|max:255|unique:category,category_name',
                ]);

                Category::create(['category_name' => $request->category_name ?? '']);

                return back()->with('success', 'emp-laravel-employe-portal successfully uploaded.');
            }

             public function update_category(Request $request, $id)
            {
                $category = Category::findOrFail($id);
                $request->validate([
                    'category_name' => 'required|string|max:255|unique:category,category_name,' . $category->id,
                ]);
                $category->category_name = $request->category_name;
                $category->save();
                return redirect()->back()->with('success', 'Category updated successfully.');
            }




            public function destroyCategory(Request $request, $id)
            {
            

                $item = Category::findOrFail($id);
                //dd();
                $item->delete();

                return response()->json(['success' => true]);
            }



            public function update_category_status(Request $request, $id)
                {

                    $category = Category::findOrFail($id);

                    $request->validate([
                        'status' => 'required|in:1,0', // Adjust to match your status values
                    ]);

                    $category->status = $request->status;
                    $category->save();

                    return redirect()->back()->with('success', 'Category status updated successfully.');
                }

           



                public function search_category(Request $request)
                {
                    $validatedData = $request->validate([
                        'category_name' => 'required|string|min:2|max:255',
                    ]);

                    $category  = $validatedData['category_name'];

                    $category  = Category::where('category_name', 'LIKE', "%{$category }%")
                                // ->orWhere('category_name', 'LIKE', "%{$category }%")
                                ->paginate(10);

                    return view('admin.Category.category-list')->with('category', $category );
                }


}
