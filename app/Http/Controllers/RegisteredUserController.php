<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name'              => ['required', 'string', 'max:50'],
            'last_name'               => ['required', 'string', 'max:50'],
            'date_of_birth'           => ['required', 'date'],
            'gender'                  => ['required', 'in:M,F'],
            'email'                   => ['required', 'string', 'email', 'max:100', 'unique:'.User::class.',email'],
            'telephone'               => ['required', 'string', 'max:15'],
            'address'                 => ['required', 'string', 'max:150'],
            'password'                => ['required', 'confirmed', Rules\Password::defaults()],
            'preferred_property_type' => ['required', 'string', 'max:50'],
            'max_monthly_rent'        => ['required', 'numeric', 'min:0'],
            'comments'                => ['nullable', 'string'],
        ]);

        // 1. Create Laravel auth user
        $user = User::create([
            'name'     => $request->first_name . ' ' . $request->last_name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'client',
        ]);

        // 2. Insert into client table
        $clientId = DB::table('client')->insertGetId([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender'        => $request->gender,
            'email'         => $request->email,
            'telephone'     => $request->telephone,
            'address'       => $request->address,
            'date_created'  => now(),
        ]);

        // 3. Insert into client_preference table
        DB::table('client_preference')->insert([
            'client_id'               => $clientId,
            'preferred_property_type' => $request->preferred_property_type,
            'max_monthly_rent'        => $request->max_monthly_rent,
            'comments'                => $request->comments,
        ]);

        // 4. Insert into client_registration table (branch 1 as default)
        DB::table('client_registration')->insert([
            'client_id'         => $clientId,
            'branch_id'         => 1,
            'registration_date' => now()->toDateString(),
            'status'            => 'active',
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('client.home');
    }
}