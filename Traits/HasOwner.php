<?php

namespace Modules\Morphling\Traits;

use Modules\Morphling\Contracts\CanOwnModels;

trait HasOwner
{
    public function ownerColumnName(): string
    {
        return 'user_id';
    }

    public function ownerId()
    {
        return $this[$this->ownerColumnName()];
    }

    public function isOwnedBy(CanOwnModels $owner): bool
    {
        return $owner->getKey() === $this->ownerId();
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
