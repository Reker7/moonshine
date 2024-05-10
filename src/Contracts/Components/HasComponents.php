<?php

declare(strict_types=1);

namespace MoonShine\Contracts\Components;

use MoonShine\Collections\MoonShineRenderElements;

interface HasComponents
{
    public function setComponents(iterable $components): static;

    public function hasComponents(): bool;

    public function getComponents(): MoonShineRenderElements;
}