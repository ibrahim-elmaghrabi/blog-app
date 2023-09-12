<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ReportRequest;
use App\Models\Report\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = Report::with('translation')->get();


        return view('admin.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.reports.create');
    }

    public function store(ReportRequest $request)
    {
        Report::create($request->validated() + ['added_by_id' => 1]);
        //auth()->id()]);

        return redirect()->route('admin_reports.index')->with('message', 'created successfully');
    }

    public function edit(Report $admin_report)
    {
        $admin_report->with('translation');

        return view('admin.reports.edit', ['report' => $admin_report]);
    }

    public function update(Report $admin_report, ReportRequest $request)
    {
        $admin_report->update($request->validated());

        return redirect()->route('admin_reports.index')->with('message', 'Updated Successfully');
    }

    public function destroy(Report $admin_report)
    {

        $admin_report->delete();

        return back();
    }

}
