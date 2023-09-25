<?php

declare(strict_types=1);

namespace MoonShine\Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MoonShine\Tests\Fixtures\Factories\ItemFactory;
use MoonShine\Tests\Fixtures\Models\Traits\MorphRelationTrait;
use MoonShine\Tests\Fixtures\Models\Traits\UserHasOneTrait;

class Item extends Model
{
    use UserHasOneTrait;

    use MorphRelationTrait;

    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'category_id',
        'start_point',
        'end_point',
        'start_date',
        'end_date',
        'file',
        'files',
        'moonshine_user_id',
        'public_at',
        'data',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'data' => 'collection',
        'files' => 'collection',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)
            ->withPivot(['pivot_1', 'pivot_2']);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'item_id');
    }

    protected static function newFactory()
    {
        return new ItemFactory();
    }
}
