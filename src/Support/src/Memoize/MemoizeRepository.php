<?php

declare(strict_types=1);

namespace MoonShine\Support\Memoize;

use Countable;
use MoonShine\Contracts\Core\StatefulContract;
use WeakMap;

final class MemoizeRepository implements Countable, StatefulContract
{
    protected static self $cache;

    public WeakMap $values;

    protected bool $enabled = true;

    public static function getInstance(): static
    {
        return static::$cache ??= new self();
    }

    protected function __construct()
    {
        $this->values = new WeakMap();
    }

    public function has(object $object, string $backtraceHash): bool
    {
        if (! isset($this->values[$object])) {

            return false;
        }

        return \array_key_exists($backtraceHash, $this->values[$object]);
    }

    public function get($object, string $backtraceHash): mixed
    {
        return $this->values[$object][$backtraceHash];
    }

    public function set(object $object, string $backtraceHash, mixed $value): void
    {
        $cached = $this->values[$object] ?? [];

        $cached[$backtraceHash] = $value;

        $this->values[$object] = $cached;
    }

    public function forget(object $object): void
    {
        unset($this->values[$object]);
    }

    public function flushState(): void
    {
        $this->values = new WeakMap();
    }

    public function enable(): self
    {
        $this->enabled = true;

        return $this;
    }

    public function disable(): self
    {
        $this->enabled = false;

        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function count(): int
    {
        return \count($this->values);
    }
}
