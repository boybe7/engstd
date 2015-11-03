<?php

function getWeekdayDifference(\DateTime $startDate, \DateTime $endDate)
{
    $isWeekday = function (\DateTime $date) {
        return $date->format('N') < 6;
    };

    $days = $isWeekday($endDate) ? 1 : 0;

    while($startDate->diff($endDate)->days > 0) {
        $days += $isWeekday($startDate) ? 1 : 0;
        $startDate = $startDate->add(new \DateInterval("P1D"));
    }

    return $days;
}


$datetime1 = new DateTime('2015-10-01');
$datetime2 = new DateTime('2015-10-11');

echo getWeekdayDifference($datetime1,$datetime2);


?>