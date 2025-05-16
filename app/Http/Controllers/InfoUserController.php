<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class InfoUserController extends Controller
{


    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function save(Request $request)
    {
        try {
            $attributes = request()->validate([
                'name' => ['required', 'max:50'],
                'email' => ['required', 'email', 'max:50', Rule::unique('users')],
                'password'     => ['min:8'],
                'phone'     => ['max:50'],
                'location' => ['max:70'],
                'about_me'    => ['max:150'],
                'photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            if ($request->hasFile('photo')) {
                $filename = Str::uuid() . '.' . $request->file('photo')->getClientOriginalExtension();
                $path = $request->file('photo')->storeAs('photos', $filename, 'public');
                $attributes['photo'] = $path;
            }

            if(isset($attributes['password']))
            {
                $attributes['password'] = bcrypt($attributes['password']);
            }

            $user = User::create($attributes);

            return redirect()->route('users')->with('success','Create user successfully');
        } catch (\Throwable $th) {
            return redirect()->route('users')->with('error','Create user failed');
        }
    }

    public function saveUpdate(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $attributes = request()->validate([
                'name' => ['required', 'max:50'],
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore($user->id)],
                'phone'     => ['max:50'],
                'location' => ['max:70'],
                'about_me'    => ['max:150'],
                'password'  => ['nullable', 'min:8'],
            ]);

            if ($request->hasFile('photo')) {
                $filename = Str::uuid() . '.' . $request->file('photo')->getClientOriginalExtension();
                $path = $request->file('photo')->storeAs('photos', $filename, 'public');
                $attributes['photo'] = $path;
            }

            if ($request->filled('password')) {
                $attributes['password'] = bcrypt($request->password);
            } else {
                $attributes['password'] = $user->password;
            }

            $user->update($attributes);

            return redirect()->route('users')->with('success','Profile updated successfully');
        } catch (\Throwable $th) {
            return redirect()->route('users')->with('error','Create user failed');
        }
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone'     => ['max:50'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
        ]);
        if($request->get('email') != Auth::user()->email)
        {
            if(env('IS_DEMO') && Auth::user()->id == 1)
            {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);

            }

        }
        else{
            $attribute = request()->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            ]);
        }


        User::where('id',Auth::user()->id)
        ->update([
            'name'    => $attributes['name'],
            'email' => $attribute['email'],
            'phone'     => $attributes['phone'],
            'location' => $attributes['location'],
            'about_me'    => $attributes["about_me"],
        ]);


        return redirect('/user-profile')->with('success','Profile updated successfully');
    }

    public function getUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $user
            ]);
        } catch (\Throwable $th) {
            \Log::error($th);

            return response()->json([
                'success' => false,
                'message' => 'Data user tidak ditemukan.'
            ], 404);
        }
    }

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users')->with('success', 'User deleted successfully');
        } catch (\Throwable $th) {
            \Log::error($th);

            return redirect()->route('users')->with('error', 'Failed to delete user');
        }
    }

}
