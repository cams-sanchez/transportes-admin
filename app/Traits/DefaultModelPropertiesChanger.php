<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidGenerator;

trait DefaultModelPropertiesChanger
{
    use UuidGenerator;

    /** @var $dateFormat string  */
    protected $dateFormat = 'Y-m-d H:i:s';

    /** @var $primaryKey string  */
    protected $primaryKey = 'uuid';

    /** @var $keyType string  */
    protected $keyType = 'string';

    /** @var $incrementing bool  */
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Model $model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} =  $this->getUuid();
            }
        });
    }

    /**
     * @return bool
     */
    public function getIncrementing()
    {
        return $this->incrementing;
    }

    /**
     * @return string
     */
    public function getKeyType()
    {
        return $this->keyType;
    }

    /**
     * @return string
     */
    public function getDateFormat()
    {
        return $this->dateFormat;
    }

    /**
     * @return string
     */
    public function getKeyName(): string
    {
        return $this->primaryKey;
    }
}
