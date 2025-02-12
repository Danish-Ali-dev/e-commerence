<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class CategoryController extends Controller
{
    public function index(Request $request){

        $categories = Category::latest();
        if(!empty($request->get('keyword'))){
         $categories = $categories->where('name', 'like', '%'.$request->get('keyword').'%');   
        }
        $categories = $categories->paginate(10);
        //dd($categories);
        //$data['categories'] = $categories;
        return view('admin.category.list', compact('categories'));
    }

    public function create(){
        return view('admin.category.create');
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);

        if($validator->passes()){
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();

            // Image save here
            if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $category->id. '.'. $ext;
                $sPath = public_path(). '/temp/'. $tempImage->name;
                $dPath = public_path(). '/uploads/category/'. $newImageName;
                File::copy($sPath,$dPath);
                
                // Generate Image Thumbnail 
                $manager = new ImageManager(new Driver());
                $thumbDPath = public_path(). '/uploads/category/thumb/'. $newImageName;
                $img = $manager->read($sPath);
                //$img = $img->resize(450, 600);
                $img = $img->cover(450, 600);
                $img->save($thumbDPath);

                $category->image = $newImageName;
                $category->save();
            }

            session()->flash('success', 'Category Added Successfully');

            return response()->json([
                'status' => true,
                'error' => 'Category Added Successfully',
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'error' => $validator->errors(),
            ]);
        }
    }

    public function edit($categoryId, Request $request){
        $category = Category::find($categoryId);
        if(empty($category)){
            return redirect()->route('categories.index');
        }
        return view('admin.category.edit', compact('category'));
    }

    public function update($categoryId, Request $request){
        $category = Category::find($categoryId);
        if(empty($category)){
            session()->flash('success', 'Category Not Found');
            return response()->json([
                'success' => false,
                'notFound' => true,
                'message' => 'Category Not Found',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$category->id.',id',
        ]);

        if($validator->passes()){
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();

            // Image save here
            if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $oldImage = $category->image;

                $newImageName = $category->id.'-'.time().'.'. $ext;
                $sPath = public_path(). '/temp/'. $tempImage->name;
                $dPath = public_path(). '/uploads/category/'. $newImageName;
                File::copy($sPath,$dPath);
                
                // Generate Image Thumbnail 
                $manager = new ImageManager(new Driver());
                $thumbDPath = public_path(). '/uploads/category/thumb/'. $newImageName;
                $img = $manager->read($sPath);
                //$img = $img->resize(450, 600); 
                $img = $img->cover(450, 600); 
                $img->save($thumbDPath);

                $category->image = $newImageName;
                $category->save();

                File::delete(public_path().'/uploads/category/'.$oldImage);
                File::delete(public_path().'/uploads/category/thumb/'.$oldImage);
            }

            session()->flash('success', 'Category Updated Successfully');

            return response()->json([
                'status' => true,
                'error' => 'Category Updated Successfully',
            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'error' => $validator->errors(),
            ]);
        }
    }

    public function destroy($categoryId, Request $request){
        $category = Category::find($categoryId);
        if(empty($category)){
        session()->flash('error', 'Category Not Found');

        return response()->json([
            'status' => true,
            'message' => 'Category Not Found',
        ]);
        }

        File::delete(public_path().'/uploads/category/'.$category->image);
        File::delete(public_path().'/uploads/category/thumb/'.$category->image);
        $category->delete();

        session()->flash('success', 'Category Deleted Successfully');

        return response()->json([
            'status' => true,
            'message' => 'Category Deleted Successfully',
        ]);

    }
}
