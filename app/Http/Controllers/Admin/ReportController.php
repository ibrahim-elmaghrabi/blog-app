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
        //->paginate();

        return view('admins.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        $report->with('translation');
        
        return view('admins.posts.show', compact('report'));
    }

    public function create()
    {
        return view('admins.reports.create');
    }

    public function store(ReportRequest $request)
    {
        Report::create($request->validated() + ['added_by_id' => auth()->id()]);

        return redirect()->route('admin_reports.index')->with('message', 'created successfully');
    }

    public function edit($report)
    {
        $reported = Report::with('translation')->findOrFail($report);

        return view('admins.reports.edit', ['report' => $reported]);
    }

    public function update($report, ReportRequest $request)
    {
        $reported = Report::findOrFail($report);

        $reported->update($request->validated());

        return redirect()->route('admin_reports.index')->with('message', 'Updated Successfully');
    }

    public function destroy($report)
    {
        $reported = Report::findOrFail($report);
        $reported->delete();

        return back();
    }

}
