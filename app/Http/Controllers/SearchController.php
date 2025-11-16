<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchForm()
    {
        return view("search");
    }

    public function getSearchedUser(Request $req)
    {
        $username = $req->input("search");

        $user = User::where("username", $username)
            ->first();

        if ($user) {
            $user = $user->makeHidden(["password", "remember_token"]);
        }

        return view("search", [
            "searchedUser" => $user,
        ]);
    }
}
