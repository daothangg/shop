<?php
namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;

use App\Traits\ApiResponce;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Validator;
use Hash;
use Auth;

class authController extends Controller
{
    use ApiResponce;    
    function loginUser(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string'
        ]);
        if ($validation->fails()) {
            return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
        } else {
            $cred = array('email' => $request->email, 'password' => $request->password);
            if (Auth::attempt($cred, false)) {
                if (Auth::User()->hasRole('admin')) {
                   
                    return response()->json(['status' => 200, 'message' => 'Admin User', 'url' => 'admin/dashboard']);
                } else {
                    $user = User::where('id', Auth::User()->id)->first();
                    $user['token'] = $user->createToken('API Token')->plainTextToken;
                    // return response()->json(['status' => 200, 'message' => 'Successfull login']);
                    return $this->success(
                        ['user' => $user],
                        'successfull login'
                    );
                }
            } else {
                return response()->json(['status' => 404, 'message' => 'Wrong Cred']);
            }
        }
    }
    public function UpdateUser(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        } else {
            Auth::User()->update(

                ['name' => $request->name]
            );

            return $this->success(['user' => $request->user()], 'Successfully updated');
        }
    }

    // public function CreateCustomer(){
    //     $user =new User();
    //         $user->name='Admin';
    //         $user->email='Admin1@gmail.com';
    //         $user->password=Hash::make('1234');
    //         $user->phone='12345';
    //         $user->address='12345';
    //         $user->twitter_link='12345';
    //         $user->fb_link='12345';
    //         $user->instagram_link='12345';
    //         $user->avatar='12345';
    //         $user->save();
    //         $admin =Role::where('slug','customer')->first();
    //         $user->roles()->attach($admin);


    // }
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);
        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        }
        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email,

        ]);
        $customer = Role::where('slug', 'customer')->first();
        $user->roles()->attach($customer);
        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }
}
