<?php

namespace MoonShine\Traits\Request;

use MoonShine\Contracts\Resources\ResourceContract;

trait HasResourceRequest
{
    public function getResource(): ?ResourceContract
    {
        if(is_null($this->getResourceUri())) {
            return null;
        }

        return memoize(fn (): ?ResourceContract => moonshine()->getResources()->findByUri(
            $this->getResourceUri()
        )?->boot());
    }

    public function hasResource(): bool
    {
        return ! is_null($this->getResource());
    }

    public function getResourceUri(): ?string
    {
        return $this->route('resourceUri');
    }
}