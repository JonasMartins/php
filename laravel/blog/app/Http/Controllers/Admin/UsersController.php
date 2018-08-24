<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = json_encode([
            ['title'=>'Home','url'=>route('home')],
            ['title'=>'Users','url'=>'']
        ]);

        $modelList = User::select('id','name','email')->paginate(2);

        return view('admin.users.index',compact('breadcrumbs','modelList'));
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
        //dd($request->all());
        $data = $request->all();
        $validation = \Validator::make($data,[
            'name'=>'required|string|max:255',
            'email'=>'required|string|max:255|unique:users',
            'password'=>'required|string|max:255|min:6',
        ]);
        if($validation->fails())
            return redirect()->back()->withErrors($validation)->withInput();
        $data['password'] = bcrypt($data['password']);

        User::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //dd($request->all());
        $data = $request->all();
        $validation = \Validator::make($data,[
            'name'=>'required|string|max:255',
            'email'=>'required|string|max:255|unique:users',
            'password'=>'required|string|max:255|min:6',
        ]);
        if($validation->fails())
            return redirect()->back()->withErrors($validation)->withInput();
        $data['password'] = bcrypt($data['password']);

        User::create($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id);
        return redirect()->back();
    }
}
