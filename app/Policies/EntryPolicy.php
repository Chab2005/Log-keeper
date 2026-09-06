<?php

namespace App\Policies;

use App\Models\Entry;
use App\Models\User;

class EntryPolicy
{
    /**
     * Only the user who created the entry may update it.
     */
    public function update(User $user, Entry $entry): bool
    {
        return $this->owns($user, $entry);
    }

    /**
     * Only the user who created the entry may delete it.
     */
    public function delete(User $user, Entry $entry): bool
    {
        return $this->owns($user, $entry);
    }

    private function owns(User $user, Entry $entry): bool
    {
        return $entry->user_id !== null && $user->id === $entry->user_id;
    }
}
