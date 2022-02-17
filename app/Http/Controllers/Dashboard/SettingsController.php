<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequst;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function editshippings($type){

        //free, inner , outer for shipping methoad
        if($type ==='free')
           $shippingMethoad=Setting::where('key' , 'free_shipping_label')->first();

        elseif($type === 'inner')
            $shippingMethoad=Setting::where('key' , 'local_label')->first();

        elseif($type === 'outer')
          $shippingMethoad=Setting::where('key' , 'outer_label')->first();

        else
          $shippingMethoad=Setting::where('key' , 'free_shipping_label')->first();

          return view('dashboard.setting.shippings.edit',compact('shippingMethoad'));

    }

    public function updateshippings(ShippingRequst $request , $id){

        //  اي ركوست ضرووري نعمل له فالديشن قبل كل شي
        // validation //  قد عملنا فالديشن في الركوست
        try{
            $shipping_method=Setting::find($id);
         DB::beginTransaction();
         $shipping_method->update(['plain_value'=>$request->plain_value]);

         //save translaition
         $shipping_method->value=$request->value;
         $shipping_method ->save();

         DB::commit();
         return redirect()->back()->with(['success'=>'تم الادخال بنجاح ']);
        }catch(\Exception $ex){
            return redirect()->back()->with(['errors'=>'هناك خطاء ما  ']);
            DB::rollback();
        }



    }
}
