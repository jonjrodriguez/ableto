<?php

namespace AbleTo;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * Only allow the following fields to be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['text'];

    /**
     * Get the question for the option.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
