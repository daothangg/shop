<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponce;

class profileController extends Controller
{
    use ApiResponce;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin/profile');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . Auth::User()->id, // Correct email validation
            // 'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:255',
            'avatar' => 'mimes:jpeg,png,jpg,gif|max:5120',
            'address' => 'required|string|max:255',
            'fb_link' => 'required|string|max:255',
            'instagram_link' => 'required|string|max:255',
            'twitter_link' => 'required|string|max:255',
        ]);

        // Handle validation failure
        if ($validation->fails()) {
            return $this->error($validation->errors()->first(),400,[]);
            // return response()->json(['status' => 400, 'message' => $validation->errors()->first()]);
        } else {
            // Check if avatar is uploaded
            $avatar_path = Auth::User()->avatar; // Default to the current avatar

            if ($request->hasFile('avatar')) {
                $avatar_name = 'images/' . $request->name . time() . '.' . $request->avatar->extension();
                $request->avatar->move(public_path('images/'), $avatar_name);
                $avatar_path = $avatar_name; // Update with the new avatar path
            }else{
                $avatar_name=Auth::User()->avatar;
            }

            // Update or create user
            $user = User::updateOrCreate(
                ['id' => Auth::User()->id],
                [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'avatar' => $avatar_path, // Save avatar path (old or new)
                    'address' => $request->address,
                    'fb_link' => $request->fb_link,
                    'instagram_link' => $request->instagram_link,
                    'twitter_link' => $request->twitter_link
                ]
            );

            // return response()->json(['status' => 200, 'message' => 'Profile updated successfully']);
            return $this->success([],'successfully updated ');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
