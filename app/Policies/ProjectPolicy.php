<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    /**
     * Only the owner may update the project.
     */
    public function update(User $user, Project $project): bool
    {
        return $this->owns($user, $project);
    }

    /**
     * Only the owner may delete the project.
     */
    public function delete(User $user, Project $project): bool
    {
        return $this->owns($user, $project);
    }

    /**
     * Only the owner may add entries to the project.
     */
    public function createEntry(User $user, Project $project): bool
    {
        return $this->owns($user, $project);
    }

    private function owns(User $user, Project $project): bool
    {
        return $project->user_id !== null && $user->id === $project->user_id;
    }
}
