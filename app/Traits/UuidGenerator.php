<?php


namespace App\Traits;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

trait UuidGenerator
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function (Model $model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} =  Uuid::uuid4();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
