<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        if($request->ajax()){
            //validations
            $this->validate($request,[
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'required|string' 
            ]);
            //save fileds
            $user = new User();
            $user->name= $request->name;
            $user->email= $request->email;
            $user->password= bcrypt($request->password);
            $user->email_verified_at = now();
            $user->save();
            
            return response()->json([
                'message' => 'Ok',
                'user' => $user
            ]);
        }
    }
    public function update(Request $request, User $user)
    {
        if($request->ajax()){
            //validations
            $this->validate($request,[
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'required|string' 
            ]);
            //save fileds
            $user->name= $request->name;
            $user->email= $request->email;
            $user->password= bcrypt($request->password);
            $user->save();
            
            return response()->json([
                'message' => 'Ok',
                'user' => $user
            ]);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'Ok',
            'user' => $user
        ]);
    }
    
}
