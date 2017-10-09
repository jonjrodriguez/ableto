<?php

namespace AbleTo;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * Only allow the following fields to be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['question_id', 'option_id'];

    /**
     * Gets the answers for the given user and includes the question and option.
     *
     * @param User $user
     * @return mixed
     */
    public static function forUser(User $user)
    {
        return static::where('user_id', $user->id)
            ->latest()
            ->with('question')
            ->with('option')
            ->get()
            ->groupBy(function ($answer) {
                return $answer->created_at->format('Y-m-d');
            });
    }

    /**
     * Gets the answers for the given user and given date.
     *
     * @param User $user
     * @param Carbon $date
     * @return mixed
     */
    public static function byDate(User $user, Carbon $date)
    {
        return static::where('user_id', $user->id)
            ->whereDate('created_at', $date->format('Y-m-d'))
            ->with('question')
            ->with('option')
            ->orderBy('question_id')
            ->get();
    }

    /**
     * Gets the question this answer is for.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Gets the option that was selected for the answer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
