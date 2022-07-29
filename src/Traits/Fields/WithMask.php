<?php

namespace Leeto\MoonShine\Traits\Fields;

trait WithMask
{
    protected string $mask = '';

    public function getMask(): string
    {
        return $this->mask;
    }

    public function mask(string $mask): static
    {
        $this->mask = $mask;

        return $this->setAttribute('x-mask', $mask);
    }
}
