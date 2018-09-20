<?php

namespace App\Http\Controllers;

use App\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalController extends Controller
{

    public function index()
    {
        return Proposal::all();
    }

    public function show(Request $request, $id)
    {
        $proposal = Proposal::find($id);
        if (!$proposal) {
            abort(400, trans('messages.proposal.id.notFound'));
        }
        return $proposal;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'project_id' => 'required|exists:project,id',
            'name'       => 'required|unique:proposal',
            'content'    => 'required|min:10',
        ]);

        $data = array_merge(
            ["user_id" => Auth::id()],
            array_only($request->all(), ["project_id", "name", "content"])
        );

        $proposal = new Proposal($data);
        $proposal->save();

        return $proposal;
    }

    public function update(Request $request, $id)
    {

        $proposal = Proposal::find($id);
        if (!$proposal) {
            abort(400, trans('messages.proposal.id.notFound'));
        }

        $this->validate($request, [
            'project_id' => 'required|exists:project',
            'name'       => 'required|unique:proposal',
            'content'    => 'required|min:100',
        ]);

        $proposal->project_id = $request->project_id;
        $proposal->name       = $request->name;
        $proposal->content    = $request->get('content');
        $proposal->save();

        return $proposal;
    }

    public function delete(Request $request, $id)
    {
        $proposal = Proposal::find($id);
        if (!$proposal) {
            abort(400, trans('messages.proposal.id.notFound'));
        }
        $proposal->delete();

        return response("", 200);
    }

}
