<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePollRequest;
use App\Models\Poll;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PollController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Polls/Index', [
            'polls' => Poll::paginate(20)
        ]);
    }

    public function show(Poll $poll): Response
    {
        return Inertia::render('Admin/Polls/Show', [
            'poll' => $poll->load(['rounds.options'])
        ]);
    }

    public function destroy(Poll $poll): RedirectResponse
    {
        $poll->delete();

        return redirect()->back()->with([
            'message' => 'Poll deleted successfully.',
            'status' => 'success'
        ]);
    }

    public function update(UpdatePollRequest $request, Poll $poll): RedirectResponse
    {
        if($poll->isActive()) {
            return redirect()->back()->with([
                'message' => 'Active polls cannot be edited.',
                'status' => 'error'
            ]);
        }

        $poll->update($request->validated());

        return redirect()->route('admin.polls.index')->with([
            'message' => 'Poll updated successfully.',
            'status' => 'success'
        ]);
    }
}
