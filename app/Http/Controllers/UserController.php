<?php

namespace App\Http\Controllers;

use App\User;
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
        $users = User::all();

        if ($users) {
            return response()->json([
                'status_code' => 200,
                'message' => 'accepted',
                'users' => $users
            ]);
        } else {
            return response()->json([
                'status_code' => 404,
                'message' => 'users not founded'
            ]);
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
     * @param  \App\UserController  $userController
     * @return \Illuminate\Http\Response
     */
    public function show(UserController $userController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserController  $userController
     * @return \Illuminate\Http\Response
     */
    public function edit(UserController $userController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserController  $userController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserController $userController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserController  $userController
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserController $userController)
    {
        //
    }
}
