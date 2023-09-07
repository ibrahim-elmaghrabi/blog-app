<?php

namespace App\Http\Controllers\Web;

use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Models\Report\Report;
use App\Models\PostReport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportRequest;


class ReportController extends Controller
{

    public function create($post)
    {

        $reports = Report::with('translation')->simplePaginate(10);

        return view('reports.create', compact('reports', 'post'));
    }

    public function store($post, Request $request)
    {
        PostReport::create([
            'post_id' => $post,
            'user_id' => auth()->id(),
            'report_id' => $request->report_id
        ]);


        return redirect()->route('posts.show', $post)->with('message', 'created successfully');
    }

}
