<?php

namespace Tests\Unit;

// В файле ExperienceTest.php

use App\Models\Experience;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExperienceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider experienceDataProvider
     */
    public function testTotalExperience($experiences, $expectedTotalMonths)
    {
        foreach ($experiences as $experienceData) {
            Experience::create($experienceData);
        }

        $totalMonths = Experience::getTotalExperienceInMonths();

        echo "Calculated Total Months: " . $totalMonths . "\n";

        $this->assertEquals($expectedTotalMonths, $totalMonths);
    }


    public function experienceDataProvider()
    {
        return [
            [
                [
                    [
                        'start_date' => '2000-01-01',
                        'end_date' => '2004-12-31',
                        'organization' => "ООО 'Разработка'",
                        'position' => 'Junior Developer',
                    ],
                    [
                        'start_date' => '2003-06-01',
                        'end_date' => '2007-05-31',
                        'organization' => "ЗАО 'Системы'",
                        'position' => 'Middle Developer',
                    ],
                    [
                        'start_date' => '2007-06-01',
                        'end_date' => '2010-05-31',
                        'organization' => "ООО 'Веб-сервисы'",
                        'position' => 'Senior Developer',
                    ],
                    [
                        'start_date' => '2008-01-01',
                        'end_date' => '2012-12-31',
                        'organization' => "ООО 'Мобильные приложения'",
                        'position' => 'Team Lead',
                    ],
                    [
                        'start_date' => '2012-01-01',
                        'end_date' => '2016-12-31',
                        'organization' => "ПАО 'Большие данные'",
                        'position' => 'Architect',
                    ],
                ],
                153,
            ],
        ];
    }
}
