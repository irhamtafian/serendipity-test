<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function register()
    {
        return view('backend.auth.register');
    }

    public function store_register(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'username' => 'required|max:255',
        'email' => 'required|max:255',
        'password' => 'required|max:255'
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);
    
    $user = User::create($validatedData);

    $token = $user->createToken('token')->plainTextToken;

    return redirect('/admin/login')->with('success', 'Registration successful! Please login.');
}

    
    public function login()
    {
        return view('backend.auth.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/articles');
        }

        return back()->with('loginError', 'Incorrect username or password.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/login')->with('message', 'Logged out successfully');
    }

    public function index()
    {
        $users = User::all(); 
        return view('backend.modules.users.index', compact('users')); 
    }

    public function create()
    {
        return view('backend.modules.users.create'); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:1'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); 
        return view('backend.modules.users.edit', compact('user')); 
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); 

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:1'
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); 
        $user->delete(); 

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

}