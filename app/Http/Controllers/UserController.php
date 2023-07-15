<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar User';
        $data = User::all();

        return view('pages.user.index', ['title' => $title, 'data' => $data]);
    }
    public function changePassword()
    {
        $title = 'Form Ubah Password';

        return view('pages.user.password', ['title' => $title]);
    }

    public function changedPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required'
        ]);
        $id =  auth()->user()->id;

        $user = User::where('id', $id)->first();

        $user->password = bcrypt($request->password);
        $user->update();

        return back()->with('success', 'Password User berhasil diupdate...!');
    }

    public function resetPassword(User $user)
    {
        $user->password = bcrypt($user->username);

        return back()->with('success', 'Password user berhasil di reset menjadi' . ' ' . $user->username . ' ' . 'Silahkan Relogin..!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Form User';

        return view('pages.user.tambah', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username'      => 'required',
            'password'      => 'required',
            'akses_user'    => 'required'
        ]);

        try {
            $user  = new User();
            $user->username     = $request->username;
            $user->password     = bcrypt($request->password);
            $user->akses_user   = $request->akses_user;
            $user->save();

            return redirect('daftar-users')->with('success', 'User berhasil ditambahkan...!');
        } catch (\Exception $e) {
            return redirect('daftar-users')->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $title = 'Form Edit User';

        // $user = User::where('id', $id)->first();

        return view('pages.user.edit', ['title' => $title, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'username'      => 'required',
            'akses_user'    => 'required',
        ]);
        try {
            $user->username     = $request->username;
            $user->akses_user   = $request->akses_user;
            $user->update();

            return redirect('daftar-users')->with('success', 'User Berhasil diupdate...!');
        } catch (\Exception $e) {
            return redirect('daftar-users')->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'User berhasil dihapus...!');
    }
}
