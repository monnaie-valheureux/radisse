<?php

namespace App;

/**
 * Allows to associate one or more phone numbers with a model.
 */
trait HasPhones
{
    /**
     * Get all of the model’s phones.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function phones()
    {
        return $this->morphMany(Phone::class, 'contactable')
            ->where('type', 'phone');
    }

    /**
     * Retrieve the first phone associated with a given label.
     *
     * @param  string  $label
     *
     * @return \App\Phone
     */
    protected function findPhoneByLabel($label)
    {
        return $this->phones->first(function ($phone) use ($label) {
            return $phone->label === $label;
        });
    }

    /**
     * Retrieve the first phone having a given number.
     *
     * @param  string  $number
     *
     * @return \App\Phone
     */
    // protected function findPhoneByNumber($number)
    // {
    //     // Format the provided number in order to be able to compare it.
    //     $number = Phone::fromNumber($number)->toE164Format();

    //     return $this->phones->first(function ($phone) use ($number) {
    //         return $phone->toE164Format() === $number;
    //     });
    // }
}
