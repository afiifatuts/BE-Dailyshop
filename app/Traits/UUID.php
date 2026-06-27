<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Attributes\Boot;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait UUID
{
    protected static function bootUUID(): void
    {
        static::creating(function (Model $model): void {
            $keyName = $model->getKeyName();

            if (empty($model->getAttribute($keyName))) {
                $model->setAttribute($keyName, (string) Str::uuid());
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}