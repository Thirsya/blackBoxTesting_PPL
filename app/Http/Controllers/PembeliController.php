<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->user()->hasRole('admin')) {
            $users = User::all();
            $paginate = User::orderBy('id', 'asc')->paginate(3);
            $role = Role::all();
           return view('admin.pembeli', ['users' => $users ,'paginate'=>$paginate, 'role' => $role]);
        } else {
            return redirect('/');
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::all()->where('id', $id)->first();
        return view('admin.detailP',['users'=>$users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all()->where('id', $id)->first();
        return view('admin.editP',['users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listUserRole($id)
    {

        $user_query = Role_User::with('role')->where('role_id', $id);
        $paginate = $user_query->paginate(3);
        $role_user = $user_query->get();
        $role = Role::all();

        return view('admin.barang', ['role_users' => $role_users, 'paginate' => $paginate, 'role' => $role]);
    }

    public function getUserFilter(Request $request, $role)
    {
        $data = Role_Users::where('role_id', $role)->get();
        $roleNih = $role;

        return view('admin.pembeli', compact('data', 'roleNih'));
    }

    public function searchUser(Request $request)
    {
        $keyword = $request->searchUser;
        $paginate = User::where('username', 'like', '%' . request('searchUser') . '%')->paginate(3);
        return view('admin.pembeli', ['paginate'=>$paginate]);
    }
}
