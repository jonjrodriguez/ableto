<?php

namespace AbleTo;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * Only allow the following fields to be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['text'];

    /**
     * Get the options for the question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
