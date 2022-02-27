<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\TagRequest;
use App\Models\Brand;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Function_;

class TagsController extends Controller
{
     public function index(){

            $tags =Tag::orderBy('id','DESC')-> paginate(PAGINATION_COUNT);

        return view('dashboard.tags.index' , compact('tags'));

     }

     public function create(){

        return view('dashboard.tags.create');

     }
     public function edit($id)
     {

        //37

        //  نتاكد مثلا عل الايدي موجود الذي تمرر ام لا
        $tags = Tag::orderBy('id','DESC')->find($id);

        // $tags ->makeVisible(['translation']); //    فعلنا الترانزليشن في حالة الهيدن  واردنا هنا ان نفعلها فزبل
        // return $tags;

        if (!$tags) {
            return redirect()->route('admin.tags')->with(['error' => 'الماركة غير موجود  ']);
        } else
            return view('dashboard.tags.edit', compact('tags'));

     }
     public function store(TagRequest $reques)
     {


        DB::beginTransaction();  //37
        //valdaite
        // if(!$reques->has('is_active'))
        //      $reques->request->add(['is_active => 0 ']);
        // else
        //      $reques->request->add(['is_active => 1 ']);

        // $tag= Tag::create(['slug' => $reques->slug]);
        $tag= Tag::create(['slug' => $reques->slug]);
        // $tag->setTranslation('name', app()->getLocale(), 'Updated name in English');
        //sava translation
        $tag->name=$reques->name;
        $tag->save();
        //return
        DB::commit();
        return redirect()->route('admin.tags')->with(['success' => 'تم الاضافة بنجاح']); // 37

    }
     public function delet(){

     }
     public function  update($id,TagRequest $reques){

        try {
            //validate
            //update DB
            DB::beginTransaction();
            // if (!$reques->has('is_active'))
            //     $reques->request->add(['is_active' => 0]);
            // else
            //     $reques->request->add(['is_active' => 1]);

            $tags = Tag::find($id);
            if (!$tags)
                return redirect()->route('admin.tags')->with(['errors' => 'هذا  غير موجود']);

            $tags->update(['slug' => $reques->slug]);//update only slug column
            // save translation
            $tags->name = $reques->name;
            $tags-> update();

            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => 'تم التحدث بنجاح']); // 27
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.tags')->with(['errors' => 'هناك خطاء ما ']);
        }

     }

     public Function destroy($id){

        try {

            // gert
            $TAGS = Tag::find($id);
            if (!$TAGS)
                return redirect()->route('admin.tags')->with(['errors' => 'هذا القسم غير موجود']);
            $TAGS->delete();
            return redirect()->route('admin.tags')->with(['success' => 'تم الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.tags')->with(['error' => 'هناك خطاء ما']);
        }
     }


}
