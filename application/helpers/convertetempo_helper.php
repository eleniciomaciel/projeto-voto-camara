<?php
function converteHoras($time)
{
    $hours = substr($time, 0, -6);
    $minutes = substr($time, -5, 2);
    $seconds = substr($time, -2);
    return $hours * 3600 + $minutes * 60 + $seconds;
}