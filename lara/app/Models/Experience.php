<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['start_date', 'end_date', 'organization', 'position'];

    public static function getTotalExperienceInMonths()
    {
        $experiences = self::orderBy('start_date')->get();
        $totalMonths = 0;
        $previousEndDate = null;

        foreach ($experiences as $experience) {
            $startDate = new \DateTime($experience->start_date);
            $endDate = new \DateTime($experience->end_date);

            if ($previousEndDate !== null && $startDate <= $previousEndDate) {
                continue;
            }

            $interval = $startDate->diff($endDate);
            $totalMonths += $interval->y * 12 + $interval->m;

            $previousEndDate = $endDate;
        }

        return $totalMonths;
    }

}
