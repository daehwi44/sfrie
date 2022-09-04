<?php

namespace App\Http\Controllers;

use App\Models\Boshujoho;
use App\Models\Community;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $boshujohos = Boshujoho::orderBy('created_at', 'desc')->simplePaginate(5);
        $communities = Community::orderBy('created_at', 'desc')->simplePaginate(5);
        return view('welcome', compact('boshujohos','communities'));
    }

    public function dashboard()
    {
        $boshujohos = boshujoho::orderBy('created_at', 'desc')->simplePaginate(5);
        $communities = Community::orderBy('created_at', 'desc')->simplePaginate(5);
        $user = auth()->user();
        return view('dashboard', compact('boshujohos','user', 'communities'));
    }

}
