<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportRequest;
use App\Models\Report\Report;

class PostReportController extends Controller
{
    public function index($post)
    {
        $reports = Report::whereId($post)->get();

        return view('reports.index', compact('reports'));
    }

    public function create($post)
    {
        return view('reports.create', compact($post));
    }

    public function store($post, ReportRequest $request)
    {
        return redirect()->route('reports.index')->with('message', 'created successfully');
    }

    public function edit(Report $report)
    {
        return view('reports.edit', compact('report'));
    }

    public function update(Report $report, ReportRequest $request)
    {
        $report->update($request->validated());

        return back()->with('message', 'Updated Successfully');
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return back()->with('message', 'Deleted Successfully');
    }

    public function adminCreateReport()
    {
        //
    }
    public function adminStoreReport()
    {
        //
    }
}
