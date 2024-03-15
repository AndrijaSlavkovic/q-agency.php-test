<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function formatDate($date, $format = 'F j, Y')
    {
        if ($date) {
            return Carbon::parse($date)->format($format);
        } else {
            return ''; // Handle null or empty date values (optional)
        }
    }
}
