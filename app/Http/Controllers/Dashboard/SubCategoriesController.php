<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoriesController extends Controller
{
    //   (DESC) ترتيب تنازي  (asc)   ترتيب تصاعدي
    public function index()
    {
        // اسكوب موجود في المودل  child()

        //$category = Category::where('parent_id',null)->get();
        //    $category = Category::whereNull('parent_id',null)->select('id','slug')->get();
        //    $category = Category::whereNull('parent_id',null)->get();
        $categories = Category::child()->orderBy('id','DESC')->paginate(PAGINATION_COUNT); //PAGINATION_COUNT  FIND IN HELPER FILE

        return view('dashboard.subcategories.index', compact('categories'));
    }
    public function create()
    {
        $categories =Category::parent()->orderBy('id','DESC')->get();
        return view('dashboard.subcategories.create',compact('categories'));
    }
    public function store(SubCategoryRequest $request)
    {
        // return $request;
        try {

            DB::beginTransaction();
            //validation

            //store
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


                //dd($request->except('_token'));
            $category=Category::create($request->except('_token'));
            $category->name = $request->name;
            $category->save();
            //return
            DB::commit();
            return redirect()->route('admin.subcategory')->with(['success' => 'تم الاضافة بنجاح']); // 29
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.subcategory')->with(['error' => 'هناك خطاء ما']);
        }
    }
    public function edit($id)
    {
        //  نتاكد مثلا عل الايدي موجود الذي تمرر ام لا
        $category = Category::orderBy('id','DESC')->find($id);
        if (!$category)
            return redirect()->route('admin.subcategory')->with(['error' => 'الاسم غير موجود ']);
        $categories =Category::parent()->orderBy('id','DESC')->get();
            return view('dashboard.subcategories.edit', compact('category','categories'));
    }
    public function update($id, SubCategoryRequest $request)  // 27
    {
        try {
            //validate
            //update DB
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);
            $category = Category::orderBy('id', 'DESC')->find($id);
            if (!$category)
                return redirect()->route('admin.subcategory')->with(['errors' => 'هذا القسم غير موجود']);
            $category->update($request->all());
            $category->name = $request->name;
            $category->save();

            return redirect()->route('admin.subcategory')->with(['success' => 'تم التحدث بنجاح']); // 27
        } catch (\Exception $ex) {
            return redirect()->route('admin.subcategory')->with(['errors' => 'هناك خطاء ما ']);
        }
    }
    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.subcategory')->with(['errors' => 'هذا القسم غير موجود']);
            $category->delete();
            return redirect()->route('admin.subcategory')->with(['success' => 'تم الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.subcategory')->with(['error' => 'هناك خطاء ما']);
        }
    }
    public function changeStatus()
    {
    }
}
