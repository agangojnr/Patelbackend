<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        abort_if(Gate::denies('subcategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subcategories = SubCategory::with('category:id,name')->get();

        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        abort_if(Gate::denies('subcategory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::where('status', 1)->get();

        return view('admin.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'bail|required|unique:sub_categories|max:255',

            'cat_id' => 'bail|required',
            'preparation_time' => 'bail|required|numeric',
            'description' => 'bail|required',
            'duration' => 'bail|required|numeric',

        ]);
        $reqData = $request->all();

        $reqData['is_best'] = $request->has('is_best') ? 1 : 0;
        $reqData['status'] = $request->has('status') ? 1 : 0;
        SubCategory::create($reqData);
        return redirect()->route('subcategories.index')->withStatus(__('Sub Category is added successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        abort_if(Gate::denies('subcategory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::where('status', 1)->get();
        $subCategory = SubCategory::findOrFail($id);

        return view('admin.subcategories.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'bail|required|max:255',

            'cat_id' => 'bail|required',
            'preparation_time' => 'bail|required|numeric',
            'description' => 'bail|required',
            'duration' => 'bail|required|numeric',

        ]);
        $reqData = $request->all();

        $reqData['is_best'] = $request->has('is_best') ? 1 : 0;
        $reqData['status'] = $request->has('status') ? 1 : 0;
        SubCategory::findOrFail($id)->update($reqData);
        return redirect()->route('subcategories.index')->withStatus(__('Sub Category is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        abort_if(Gate::denies('subcategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        SubCategory::findOrFail($id)->delete();

        return back()->withStatus(__('Sub Category is deleted successfully.'));
    }

    public function subCategoryByCategory(Request $request)
    {

        $cat = explode(',', $request->cat);
        $data = SubCategory::whereIn('cat_id', $cat)->where('status', 1)->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
    public function subCategoryByCategoryApi($id)
    {
        $data['best'] = SubCategory::where([['cat_id', $id], ['status', 1], ['is_best', 1]])->get();
        $data['all'] = SubCategory::where('cat_id', $id)->where('status', 1)->get();
        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }
}
