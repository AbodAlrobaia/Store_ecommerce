<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller    // 25
{
    public function editprofile(){
         $id= auth('admin')->user()->id;
         $admin=Admin::find($id);

         return view('dashboard.Profile.edit',compact('admin'));

    }
    public function updateprofile(ProfileRequest $request ){

        //validate
        //db

        try{
            $admin=Admin::find(auth('admin')->user()->id); //   هنا بنجيب الايدي الذي بنعمل له تحديث
            // $admin->update($request->only(['name','email'])); //   بنقول له جيب لنا فقط من الركوست الذي راجع الاسم والايميل
            if($request->filled('password')){ //    الفلد بيقول مثلا   اذا الركوست في قيمه  في حق الباسورد
                  $request->merge(['password'=>bcrypt($request->password)]); // يعني اذا الباسورد في قيمه افعل له مرج  مع الاسم والايميل
            }
            unset($request['id']); // قمنا بحذف الايدي من الركوست بدالة الانست
            unset($request['password_confirmation']);
            $admin->update($request->all());
            return redirect()->back()->with(['success'=>'تم التحديث بنجاح ']);

        }catch(\Exception $ex)
        {
            return redirect()->back()->with(['errors'=>'هناك خطاء ما  ']);
        }

    }


}
