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
            return view("projects.missing");
        }

        return view("projects", ['project' => $project]);
    }

    public function showLog($id) {
        $entry = Entry::query()->with('tags')->find($id);

        if (! $entry) {
            return view("logs.missing");
        }

        return view("log", ['entry' => $entry]);
    }

    public function createLog(Project $project) {
        return view("createLog", ['project' => $project]);
    }

    public function storeLog(Request $request, Project $project) {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:25'],
            'summary'     => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1024'],
            'tags'        => ['array'],
            'tags.*'      => ['string', 'max:50'],
        ]);

        $entry = $project->entries()->create([
            'date'        => now(),
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
        return view("createProject");
    }

    public function storeProject(Request $request) {
        $validated = $request->validate([
            'title'    => ['required', 'string', 'max:25'],
            'subtitle' => ['required', 'string', 'max:50'],
            'tags'     => ['array'],
            'tags.*'   => ['string', 'max:50'],
        ]);

        $project = Project::create([
            'name'    => $validated['title'],
            'summary' => $validated['subtitle'],
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
            return view("logs.missing");
        }

        return view("modify", ['entry' => $entry]);
    }

    public function updateLog(Request $request, $id) {
        $entry = Entry::query()->find($id);

        if (! $entry) {
            return view("logs.missing");
        }

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:25'],
            'summary'     => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1024'],
            'tags'        => ['array'],
            'tags.*'      => ['string', 'max:50'],
        ]);

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
        return redirect()->back();
    }
}
