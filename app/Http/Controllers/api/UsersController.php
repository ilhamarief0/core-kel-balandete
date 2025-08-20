<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
     public function index()
    {
      $users = User::get();
      return new UserResource(true, 'List Data Users', $users);
    }
}
