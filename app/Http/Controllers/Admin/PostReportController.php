<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post\Post;

class ReportController extends Controller
{
    public function index($post)
    {
        $reports = Post::whereId($post)->reports()->get();

        return view('reports.index', compact('reports'));
    }

}
