<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        $projects = [
            ['id' => 1, 'title' => 'Core Architecture', 'tags' => ['System', 'Active'], 'lastModified' => '2m ago'],
            ['id' => 2, 'title' => 'Network Traffic', 'tags' => ['Inbound', 'Encrypted'], 'lastModified' => '1h ago'],
            ['id' => 3, 'title' => 'Security Audit', 'tags' => ['Alert', 'Critical'], 'lastModified' => '45s ago'],
            ['id' => 4, 'title' => 'User Telemetry', 'tags' => ['Session', 'Events'], 'lastModified' => '12h ago'],
        ];

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
        $projects = [
            1 => ['title' => 'Core Architecture', 'subtitle' => 'System logs, event tracking, and state mutations.'],
            2 => ['title' => 'Network Traffic', 'subtitle' => 'Inbound and outbound packet analysis.'],
            3 => ['title' => 'Security Audit', 'subtitle' => 'Access control and intrusion detection events.'],
            4 => ['title' => 'User Telemetry', 'subtitle' => 'Session analytics and behavioral tracking.'],
        ];

        return view("projects", [
            'id' => $id,
            'project' => $projects[$id] ?? ['title' => 'Unknown Project', 'subtitle' => ''],
            'entries' => $this->sampleEntries(),
        ]);
    }

    public function showLog($id) {
        $entries = $this->sampleEntries();
        $entry = collect($entries)->firstWhere('id', (int) $id) ?? $entries[0];

        return view("log", ['entry' => $entry]);
    }

    public function createLog() {
        return view("createLog");
    }

    public function createProject() {
        return view("createProject");
    }

    public function storeProject(Request $request) {
        $validated = $request->validate([
            'title'    => ['required', 'string', 'max:50'],
            'subtitle' => ['nullable', 'string', 'max:50'],
            'tags'     => ['array'],
            'tags.*'   => ['string', 'max:50'],
        ]);

        $project = Project::create([
            'name'    => $validated['title'],
            'summary' => $validated['subtitle'] ?? null,
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
        $entries = $this->sampleEntries();
        $entry = collect($entries)->firstWhere('id', (int) $id) ?? $entries[0];

        return view("modify", ['entry' => $entry]);
    }

    public function updateLog($id) {
        return redirect()->route('logs.show', $id);
    }

    public function deleteLog($id) {
        return redirect()->back();
    }

    private function sampleEntries(): array {
        return [
            [
                'id' => 1,
                'title' => 'Distributed Locking System',
                'timestamp' => '2024-10-24 14:32:01.005 UTC',
                'summary' => 'Initialized distributed locking mechanism via Redis cluster. Fallback circuit breaker armed.',
                'description' => "The initialization sequence for the distributed locking mechanism commenced at T-0 with the successful discovery of the primary Redis cluster configuration. We implemented a Redlock-based algorithm to handle mutual exclusion in our distributed environment, providing strong guarantees against split-brain scenarios.\n\nFollowing the initial bootstrap, the fallback circuit breaker was successfully armed, configured to trip if mean lock acquisition latency exceeds 50ms over a 10-second window. All 5 participating nodes synchronized effectively, yielding a mean latency of 12ms.\n\nThe continuous heartbeat monitoring subsystem renews lock TTLs on an active background thread. Should a process crash unexpectedly, the absence of the heartbeat allows the lock to naturally expire, preventing indefinite orphan states.",
                'tags' => ['system', 'active', 'redis'],
            ],
            [
                'id' => 2,
                'title' => 'Database Sharding Alert',
                'timestamp' => '2024-10-24 14:15:43.912 UTC',
                'summary' => 'Detected latency spike in primary database shard. Re-routing read traffic to secondary replicas.',
                'description' => "Monitoring detected a sustained latency spike on the primary database shard, exceeding the 200ms p95 threshold for three consecutive polling intervals. Read traffic was automatically re-routed to secondary replicas to preserve overall query performance.\n\nInitial diagnostics point to an uneven key distribution following the last rebalancing pass. A follow-up rebalancing job has been scheduled during the next low-traffic window to redistribute hot partitions across the shard set.",
                'tags' => ['database', 'warning'],
            ],
            [
                'id' => 3,
                'title' => 'Security Protocol Update',
                'timestamp' => '2024-10-24 13:00:00.000 UTC',
                'summary' => 'Scheduled TLS certificate rotation completed successfully. New keys propagated to edge nodes.',
                'description' => "The scheduled quarterly TLS certificate rotation completed without incident. New certificates were generated, validated against the certificate authority chain, and propagated to all edge nodes ahead of the previous certificates' expiry window.\n\nNo service interruption was observed during the rollover, and all downstream health checks reported nominal status throughout the rotation.",
                'tags' => ['security', 'system', 'routine'],
            ],
            [
                'id' => 4,
                'title' => 'Infrastructure Resource Management',
                'timestamp' => '2024-10-24 11:42:18.455 UTC',
                'summary' => 'Kubernetes pod eviction triggered on node-04 due to memory pressure. Workloads rescheduled.',
                'description' => "Node-04 crossed its configured memory pressure threshold, triggering the kubelet's eviction manager. Lower-priority workloads were evicted first, in line with the cluster's quality-of-service ordering.\n\nAll evicted workloads were automatically rescheduled onto nodes with available capacity within the same availability zone, and service-level objectives were maintained throughout the event.",
                'tags' => ['infrastructure', 'k8s'],
            ],
        ];
    }
}
