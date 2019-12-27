<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
class AuthController extends Controller
{
    public function index(Request $request){
        $validate = $this->validate($request ,[
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::check()) {
            $data['msg'] = "User already logged in!";
        }
        else{
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $data['user'] = Auth::user();
                $data['msg'] = "Successfully Logged In!";
            }
            else{
                $data['msg'] = "Invalid Email or Password";
            }
        }
        
        return response($data);
    }

    public function store(Request $request){
        $validate = $this->validate($request ,[
            'name' => 'required|max:55',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
       ]);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user'=> $user, 'access_token'=> $accessToken]);
        
    }
    
    public function get_users(){
        $users = User::all();
        return response(["Users => "=>$users]);
    }

    public function single_user($id){
        $single = User::find($id);
        return response($single);
    }

    public function delete_user($id){
        $delete = User::where('id', $id)->delete();
        if($delete){
            $msg = "User deleted Sucessfully";
        }
        else{
            $msg = "Sorry! User not deleted. Try Again!";
        }
        return response($msg);
    }

    public function update_user(Request $request){
        $validate = $this->validate($request ,[
            'name' => 'required|max:55',
            'email' => 'required',
            'password' => 'required'
        ]);

        $update = User::where('id', $request->id)->update(['name'=>$request->name,'email'=>$request->email,'password'=>bcrypt($request->password)]);
        if($update){
            $msg = "User Updated Successfully";
        }
        else{
            $msg = "Sorry! User not Updated. Try Again";
        }
        return response($msg);
    }

}
