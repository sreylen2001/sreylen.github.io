<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request){
        // dd($users);
        $data['users'] = DB::table('users')->where('active', 1)->get();
        $users = User::paginate(6);
        return view('admins.admin_user.index', $data);
        
    }

    public function edit($id){
        $data['users'] = DB::table('users')->find($id);
        return view('admins.admin_user.edit', $data);
    }
    
    public function update(Request $request){

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
       
        $i = DB::table('users')->where('id', $request->id)->update($data);
        if($i){
            return redirect()->route('admin.admin_user');
        }else{
            echo'No Update File';
        }
    }

    public function delete($id){

        $affected = DB::table('users')
        ->where('id', $id)
        ->update([
            'active' => '0'
        ]);
        if($affected){
            return redirect()->route('admin.admin_user');
        }
    }


}
