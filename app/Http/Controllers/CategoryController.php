<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories=Category::with('children')
            ->whereNull('parent_category_id')
            ->get();
        // $categories=Category::with('child')->find(1);
        // return response()->json($categories);
        return view('categories.index',compact('categories'));
    }
    public function create()
    {
        $parentcategories=Category::with('parent')
            ->whereNull('parent_category_id')
            ->get();
        $subcategories=Category::with('child')
            ->whereNull('parent_category_id')
            ->get();
        // return $subcategories;
        return view('categories.create',compact('parentcategories','subcategories'));
    }
    public function edit($id){
        $category=Category::with('parents')->find($id);
        $parentcategories=Category::with('parent')
            ->whereNull('parent_category_id')
            ->get();
        $subcategories=Category::with('child')
            ->whereNull('parent_category_id')
            ->get();
        // return $category; 
        // echo($category);   
        return view('categories.edit',compact('category','parentcategories','subcategories'));
    }
    public function catStore(Request $request)
    {
        $parentCat=Category::create([
            'name'=>$request->category
        ]);
        if($parentCat){
            return back();
        }   
    }
    public function subCatStore(Request $request)
    {
        $subCat=Category::create([
            'parent_category_id'=>$request->parentCategory,
            'name'=>$request->subCategory
        ]);
        if($subCat){
            return back();
        } 
    }public function childCatStore(Request $request)
    {
        if($request->subCategory == 0){
            return back()->with(['error'=>'Plz add Sub category']);
        }
        $childCat=Category::create([
            'parent_category_id'=>$request->subCategory,
            'name'=>$request->childCategory
        ]);
        if($childCat){
            return back();
        }       
    }
    public function catupdate(Request $request,$id)
    {
        // dd($request->all());
        $category=Category::with('parents')->find($id);
        $category->name=$request->category;
        if(!$category->parents==Null){

            switch ($category->parents) {
                case($category->parents->parent_category_id==Null);
                    $category->parent_category_id=$request->parentCategory;
                    break;
                
                default:
                    $pcat=Category::find($request->subCategory);
                    $pcat->parent_category_id=$request->parentCategory;
                    $pcat->save();
                    $category->parent_category_id=$request->subCategory;
                    break;
            }
        }
        if($category->save()){
            return redirect('/');
        }
    }
    public function destroy($id)
    {
        $category=Category::with('children')->find($id);
        $catsDelete=[$category->id];
        foreach($category->children as $subcategory){
            $catsDelete[]=$subcategory->id;
                foreach ($subcategory->children as $childcategory) {
                    $catsDelete[]=$childcategory->id;
                };
        };
        if(Category::destroy($catsDelete)){
            return back();
        }
    }
}
