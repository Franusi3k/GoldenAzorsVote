<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Poll\PollStatus;
use App\Http\Controllers\Controller;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

    public function update(Request $request, Poll $poll): RedirectResponse
    {
        // zmienić później na FormRequest
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'opens_at' => 'nullable|date',
            'closes_at' => 'nullable|date|after:opens_at',
            'status' => ['required', Rule::in(PollStatus::all())],
        ]);

        $poll->update($data);

        return redirect()->route('admin.polls.index')->with([
            'message' => 'Poll updated successfully.',
            'status' => 'success'
        ]);
    }
}
