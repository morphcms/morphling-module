<?php

namespace Modules\Morphling\Traits;

use Illuminate\Http\Resources\Json\JsonResource;
use Orion\Http\Resources\Resource;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @mixin JsonResource|Resource|InteractsWithMedia
 */
trait HasMediaTransformer
{
    public function mediaSingleTransformer($collection = 'default')
    {
        return $this->whenLoaded('media', fn () => $this->getFirstMediaUrl($collection));
    }

    public function mediaTransformer($collection = 'default')
    {
        return $this->whenLoaded('media',
            fn () => $this->getMedia($collection)
            ->map(fn (Media $media) => $media->getFullUrl())
        );
    }
}
