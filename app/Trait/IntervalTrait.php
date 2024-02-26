<?php

namespace App\Traits;

use App\Models\Squad;

trait IntervalTrait
{
    public function generateInterval($pattern, $length, $current_interval_length = 0)
    {
        $pattern_length = count($pattern);

        # Determine the start position in the pattern
        $start_position = $current_interval_length % $pattern_length;

        $result_pattern = [];

        for ($i = 0; $i < $length; $i++) {
            array_push($result_pattern, $pattern[($start_position + $i) % $pattern_length]);
        }

        return $result_pattern;
    }
}
