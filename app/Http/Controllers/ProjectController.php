<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::query()
            ->with('tags')
            ->withMax('entries as last_entry_at', 'created_at')
            ->latest()
            ->get();

        return view("index", ['projects' => $projects]);
    }
//

    public function create() {
        return view("index");
    }

    public function modify() {
        return view("modify");
    }

    public function delete() {
        return view("delete");
    }

    public function show($id) {
        $project = Project::query()
            ->with(['tags', 'entries' => fn ($query) => $query->with('tags')->latest('date')])
            ->find($id);

        if (! $project) {
            return view("projects.missing", ['title' => 'Project not found']);
        }

        return view("projects", ['project' => $project, 'title' => $project->name]);
    }

    public function showLog($id) {
        $entry = Entry::query()->with('tags')->find($id);

        if (! $entry) {
            return view("logs.missing", ['title' => 'Entry not found']);
        }

        return view("log", ['entry' => $entry, 'title' => $entry->title]);
    }

    public function createLog(Project $project) {
        $this->authorize('createEntry', $project);

        return view("createLog", ['project' => $project, 'title' => 'New log']);
    }

    public function storeLog(Request $request, Project $project) {
        $this->authorize('createEntry', $project);

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:25'],
            'summary'     => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1024'],
            'tags'        => ['required', 'array', 'min:1'],
            'tags.*'      => ['string', 'max:50'],
        ], [
            'tags.required' => 'Add at least one tag.',
            'tags.min'      => 'Add at least one tag.',
        ], ['tags.*' => 'tag']);

        $entry = $project->entries()->create([
            'date'        => now(),
            'user_id'     => $request->user()->id,
            'title'       => $validated['title'],
            'summary'     => $validated['summary'] ?? null,
            'description' => $validated['description'] ?? null,
        ]);

        $tagIds = collect($validated['tags'] ?? [])
            ->map(fn ($name) => trim($name))
            ->filter()
            ->unique()
            ->map(fn ($name) => Tag::firstOrCreate(['name' => $name])->id)
            ->all();

        $entry->tags()->sync($tagIds);

        return redirect()
            ->route('projects.show', $entry->project_id)
            ->with('status', 'Log created.');
    }

    public function createProject() {
        return view("createProject", ['title' => 'New project']);
    }

    public function storeProject(Request $request) {
        $validated = $request->validate([
            'title'    => ['required', 'string', 'max:25'],
            'subtitle' => ['required', 'string', 'max:50'],
            'tags'     => ['required', 'array', 'min:1'],
            'tags.*'   => ['string', 'max:50'],
        ], [
            'tags.required' => 'Add at least one tag.',
            'tags.min'      => 'Add at least one tag.',
        ], ['tags.*' => 'tag']);

        $project = Project::create([
            'name'    => $validated['title'],
            'summary' => $validated['subtitle'],
            'user_id' => $request->user()->id,
        ]);

        $tagIds = collect($validated['tags'] ?? [])
            ->map(fn ($name) => trim($name))
            ->filter()
            ->unique()
            ->map(fn ($name) => Tag::firstOrCreate(['name' => $name])->id)
            ->all();

        $project->tags()->sync($tagIds);

        return redirect('/')->with('status', 'Project created.');
    }

    public function editLog($id) {
        $entry = Entry::query()->with('tags')->find($id);

        if (! $entry) {
            return view("logs.missing", ['title' => 'Entry not found']);
        }

        $this->authorize('update', $entry);

        return view("modify", ['entry' => $entry, 'title' => 'Edit log']);
    }

    public function updateLog(Request $request, $id) {
        $entry = Entry::query()->find($id);

        if (! $entry) {
            return view("logs.missing", ['title' => 'Entry not found']);
        }

        $this->authorize('update', $entry);

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:25'],
            'summary'     => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1024'],
            'tags'        => ['required', 'array', 'min:1'],
            'tags.*'      => ['string', 'max:50'],
        ], [
            'tags.required' => 'Add at least one tag.',
            'tags.min'      => 'Add at least one tag.',
        ], ['tags.*' => 'tag']);

        $entry->update([
            'title'       => $validated['title'],
            'summary'     => $validated['summary'] ?? null,
            'description' => $validated['description'] ?? null,
        ]);

        $tagIds = collect($validated['tags'] ?? [])
            ->map(fn ($name) => trim($name))
            ->filter()
            ->unique()
            ->map(fn ($name) => Tag::firstOrCreate(['name' => $name])->id)
            ->all();

        $entry->tags()->sync($tagIds);

        return redirect()
            ->route('logs.show', $entry->id)
            ->with('status', 'Log updated.');
    }

    public function deleteLog($id) {
        $entry = Entry::query()->find($id);

        if (! $entry) {
            return view("logs.missing", ['title' => 'Entry not found']);
        }

        $this->authorize('delete', $entry);

        $projectId = $entry->project_id;

        $entry->tags()->detach();
        $entry->delete();

        return redirect()
            ->route('projects.show', $projectId)
            ->with('status', 'Log deleted.');
    }
}
