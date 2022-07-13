<?php

namespace Modules\Morphling\Traits;

use App\Models\User;

trait HasOwner
{
    protected function ownerColumnName(): string
    {
        return 'user_id';
    }

    public function isOwnedBy(User $user): bool
    {
        return $user->id === $this[$this->ownerColumnName()];
    }
}
