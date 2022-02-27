<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Function_;

class BrandsController extends Controller
{
     public function index(){

            $brand =Brand::orderBy('id','DESC')-> paginate(PAGINATION_COUNT);

        return view('dashboard.brands.index' , compact('brand'));

     }

     public function create(){

        return view('dashboard.brands.create');

     }
     public function edit($id)
     {

        //  نتاكد مثلا عل الايدي موجود الذي تمرر ام لا
        $brand = Brand::orderBy('id','DESC')->find($id);
        if (!$brand) {
            return redirect()->route('admin.brands')->with(['error' => 'الماركة غير موجود  ']);
        } else
            return view('dashboard.brands.edit', compact('brand'));

     }
     public function store(BrandRequest $reques){
        try {

            DB::beginTransaction(); //33
        //valdaite
        if(!$reques->has('is_active'))
             $reques->request->add(['is_active => 0 ']);
        else
             $reques->request->add(['is_active => 1 ']);

        $fileName='';
        if($reques->has('photo')){
            //  ميثود في الهلبر uploadphoto
            //     موجوده في الكونفق ملف الفايل سستم brands
            $fileName = uploadImage('brands', $reques->photo);  // 33
        }

        $brands= Brand::create($reques->except('_token','photo')); //   من الخطاء تسييف الصوره في قاعدة البيانات  بناخذ فقط مسارها ونخزنها

        //sava translation
        $brands->name=$reques->name;
        $brands -> photo = $fileName ;
        $brands->save();
        //return
        DB::commit();
        return redirect()->route('admin.brands')->with(['success' => 'تم الاضافة بنجاح']); // 29
    } catch (\Exception $ex) {

        DB::rollBack();
        return redirect()->route('admin.brands')->with(['error' => 'هناك خطاء ما']);

     }
    }
     public function delet(){

     }
     public function update($id,BrandRequest $reques){

        try {
            //validate
            //update DB
            DB::beginTransaction();
            if (!$reques->has('is_active'))
                $reques->request->add(['is_active' => 0]);
            else
                $reques->request->add(['is_active' => 1]);

            $brand = Brand::orderBy('id', 'DESC')->find($id);
            if (!$brand)
                return redirect()->route('admin.brands')->with(['errors' => 'هذا  غير موجود']);
            if($reques->has('photo')){
                $fileName = uploadImage('brands',$reques->photo);
                Brand::where('id',$id)
                ->update([
                    'photo' => $fileName
                ]);
            }
            $brand->update($reques->except('_token','id','photo'));

            // save translation
            $brand->name = $reques->name;
            $brand->save();
            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => 'تم التحدث بنجاح']); // 27
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.brands')->with(['errors' => 'هناك خطاء ما ']);
        }

     }

     public Function destroy($id){

        try {

            // gert
            $brand = Brand::find($id);
            if (!$brand)
                return redirect()->route('admin.brands')->with(['errors' => 'هذا القسم غير موجود']);
            $brand->delete();
            return redirect()->route('admin.brands')->with(['success' => 'تم الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.brands')->with(['error' => 'هناك خطاء ما']);
        }
     }


}
