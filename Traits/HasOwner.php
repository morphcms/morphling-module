<?php

namespace Modules\Morphling\Traits;

use App\Models\User;
use Modules\Morphling\Contracts\CanOwnModels;

trait HasOwner
{
    public function ownerColumnName(): string
    {
        return 'user_id';
    }

    public function isOwnedBy(CanOwnModels $owner): bool
    {
        return $owner->getKey() === $this[$this->ownerColumnName()];
    }

    public function scopeWhereOwnedBy($query, $ownerId)
    {
        return $query
            ->where($this->ownerColumnName(), $ownerId)
            ->whereNotNull($this->ownerColumnName());
    }

    public function scopeWhereNullOrOwnedBy($query, $ownerId)
    {
        return $query
            ->where($this->ownerColumnName(), $ownerId)
            ->orWhereNull($this->ownerColumnName());
    }
}
