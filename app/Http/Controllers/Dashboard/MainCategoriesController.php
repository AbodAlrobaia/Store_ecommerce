<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\CategoryType;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainCategoriesController extends Controller
{
    //   (DESC) ترتيب تنازي  (asc)   ترتيب تصاعدي
    public function index()
    {

        //$category = Category::where('parent_id',null)->get();
        //    $category = Category::whereNull('parent_id',null)->select('id','slug')->get();
        //    $category = Category::whereNull('parent_id',null)->get();

        $categories = Category::with('parents')->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT); //PAGINATION_COUNT  FIND IN HELPER FILE
        return view('dashboard.categories.index', compact('categories'));

    }

    public function create()

    {
        $categories=Category::select('id','parent_id')->get();
        return view('dashboard.categories.create',compact('categories'));
    }

    public function store(MainCategoryRequest $request)
    {
        // return $request
        try {

            DB::beginTransaction();
            //validation

            //store
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);
            //if user choose main category then we must remove parent id  from the request

            if($request->type ==CategoryType::mainCategory) //main category
            {
                // $request->except('parent_id');
                $request->request->add(['parent_id' => null]);
            }

            //if he choose child category we must add parent_id

            //dd($request->except('_token'));
            $category = Category::create($request->except('_token'));
            $category->name = $request->name;
            $category->save();
            //return
            DB::commit();
            return redirect()->route('admin.maincategory')->with(['success' => 'تم الاضافة بنجاح']); // 29
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.maincategory')->with(['error' => 'هناك خطاء ما']);
        }
    }

    public function edit($id)
    {
        //  نتاكد مثلا عل الايدي موجود الذي تمرر ام لا
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.maincategory')->with(['error' => 'الاسم غير موجود ']);
        } else
            return view('dashboard.categories.edit', compact('category'));
    }

    public function update($id, MainCategoryRequest $request)  // 27
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
                return redirect()->route('admin.maincategory')->with(['errors' => 'هذا القسم غير موجود']);
            $category->update($request->all());
            $category->name = $request->name;
            $category->save();

            return redirect()->route('admin.maincategory')->with(['success' => 'تم التحدث بنجاح']); // 27
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategory')->with(['errors' => 'هناك خطاء ما ']);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            if (!$category)
                return redirect()->route('admin.maincategory')->with(['errors' => 'هذا القسم غير موجود']);
            $category->delete();
            return redirect()->route('admin.maincategory')->with(['error' => 'تم الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategory')->with(['error' => 'هناك خطاء ما']);
        }
    }

    public function changeStatus()
    {
    }
}
