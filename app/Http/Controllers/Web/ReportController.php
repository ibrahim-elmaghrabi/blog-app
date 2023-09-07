<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportRequest;
use App\Models\Post\Post;
use App\Models\Report\Report;


class ReportController extends Controller
{

    public function create($post)
    {
        $reports = Report::with('translations')->get();

        return view('reports.create', compact('reports', 'post'));
    }

    public function store($post, ReportRequest $request)
    {

        dd($request->all());
        $post = Post::whereId($post)->first();


        $post->report()->create($request->validated());

        return redirect()->route('reports.index')->with('message', 'created successfully');
    }

}
