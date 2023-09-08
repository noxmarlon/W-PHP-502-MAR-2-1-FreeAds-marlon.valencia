<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdStore;
use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdController extends Controller
{
    use RegistersUsers;
    public function create()
    {
        return view('create');
    }

    public function index()
    {
        $ads = DB::table('ads')->orderBy('created_at', 'desc')->paginate(6);
        return view('ads', compact('ads'));
    }

    public function store(AdStore $request)
    {
      
        $validated = $request->validated();


        if(!Auth::check())
        {
           $request->validate([
                'name' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ]);
            
           $user= User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            $this->guard()->login($user);
        }
         if($request->hasfile('imageFile'))
         {

            foreach($request->file('imageFile') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/images/', $name);  
                $data[] = $name;  
                
            }
         }

        // if($request->hasfile('imageFile'))
        // {
        //     $data = [];
        //     foreach($request->file('imageFile') as $image)
        //     {
        //         $image_name= md5(rand(1000,10000));
        //         $ext=strtolower($image->getClientOriginalExtension());
        //         $image_full_name=$image_name.'.'.$ext;
        //         $upload_path='public/images/';
        //         $image_url=$upload_path.$image_full_name;
        //         $image->move($upload_path,$image_full_name);
        //         $data[] = $image_url;
        //         $datas = implode('|', $data);
        //     }
        // }
         
        $ad = new Ad();
        $ad->title = $validated['title'];
        $ad->description = $validated['description'];
        $ad->price = $validated['price'];
        $ad->localisation = $validated['localisation'];
        $ad->imageFile = json_encode($data);
        $ad->user_id = auth()->user()->id;
        $ad->save();
        return redirect()->route('welcome')->with('success', 'Votre annonce a été créée avec succès');


    }

    public function search(Request $request)
    {
      $words = $request->words;  
      $ads = DB::table('ads')

      ->where('title', 'like', '%'.$words.'%')
      ->orWhere('description', 'like', '%'.$words.'%')
      ->orderBy('created_at', 'desc')
      ->get();
      
      return response()->json(['success' => true , 'ads' => $ads]);
    }
}
