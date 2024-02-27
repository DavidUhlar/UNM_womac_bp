<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show form for creating user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user
     *
     * @param User $user
     * @param StoreUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request)
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $user->create(array_merge($request->validated(), [
            'password' => 'test'
        ]));

        return redirect()->route('users.index')
            ->withSuccess(__('Používateľ bol vytvorený úspešne'));
    }

    /**
     * Show user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     *
     * @param User $user
     * @param UpdateUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request)
    {
//        dd($request->all());
        $user->update($request->validated());

//        $user->syncRoles($request->get('role'));

        $role = Role::where('id', $request->get('role'))->first();
        $user->syncRoles($role->name);

        return redirect()->route('users.index')
            ->withSuccess(__('Používateľ bol upravený úspešne'));
    }

    /**
     * Delete user data
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('Používateľ bol vymazaný úspešne'));
    }


    public function passwordChange(Request $request)
    {


        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|min:8',
        ]);

        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');
        $newPasswordConfirmation = $request->input('new_password_confirmation');


        $user = auth()->user();

        if (!Hash::check($oldPassword, $user->password)) {

            return redirect()->route('passwordChange.show')->with('error', 'Nesprávne pôvodné heslo.');
        } else {
            if ($newPassword == $newPasswordConfirmation) {
                auth()->user()->update([
                    'password' => $newPassword,
                ]);
//                auth()->user()->setPasswordAttribute($newPassword);

            } else {
                return redirect()->route('passwordChange.show')->with('error', 'Nesprávne zopakované nové heslo.');
            }
        }

        return redirect()->route('passwordChange.show')->with('success', 'Heslo úspešne zmenené.');
    }

    public function passwordChangeShow()
    {

        return view('auth.passwordChange');

    }

}
