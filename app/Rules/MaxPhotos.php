<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxPhotos implements Rule
{
    private $maxPhotos;

    public function __construct($maxPhotos)
    {
        $this->maxPhotos = $maxPhotos;
    }

    public function passes($attribute, $value)
    {
        return count($value) <= $this->maxPhotos;
    }

    public function message()
    {
        return "You can upload a maximum of {$this->maxPhotos} photos.";
    }
}
