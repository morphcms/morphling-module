<?php

namespace Modules\Morphling\Contracts;

/**
 * @method whereOwnedBy(string|int $id)
 * @method whereNullOrOwnedBy(string|int $id)
 */
interface CanBeOwned
{

    function ownerColumnName(): string;
    function isOwnedBy(CanOwnModels $owner);

}
