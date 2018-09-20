<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function index()
    {
        return Project::all();
    }

    public function show(Request $request, $id)
    {
        $project = Project::find($id);
        if (!$project) {
            abort(400, trans('messages.project.id.notFound'));
        }
        return $project;
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name'    => 'required|unique:project',
            'content' => 'required|min:10',
        ]);

        $data = array_merge(["user_id" => Auth::id()], array_only($request->all(), ["name", "content"]));

        $project = new Project($data);
        $project->save();

        return $project;
    }

    public function update(Request $request, $id)
    {

        $project = Project::find($id);
        if (!$project) {
            abort(400, trans('messages.project.id.notFound'));
        }

        $this->validate($request, [
            'name'    => 'required|unique:project',
            'content' => 'required|min:100',
        ]);

        $project->name    = $request->name;
        $project->content = $request->get('content');
        $project->save();

        return $project;
    }

    public function delete(Request $request, $id)
    {
        $project = Project::find($id);
        if (!$project) {
            abort(400, trans('messages.project.id.notFound'));
        }
        $project->delete();

        return response("", 200);
    }

}
