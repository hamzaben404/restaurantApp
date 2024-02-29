<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\Rule;

class DateBetween implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        $pickupDate = Carbon::parse($value);
        $lastDate = Carbon::now()->addWeek();

        return $value >= now() && $value <= $lastDate;
    }

    public function message()
    {
        return 'Please choose a date between a week from now.';
    }
}
