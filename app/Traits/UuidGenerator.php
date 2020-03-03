<?php


namespace App\Traits;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

trait UuidGenerator
{
    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

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
        return $this->incrementing;
    }

    public function getKeyType()
    {
        return $this->keyType;
    }
}
