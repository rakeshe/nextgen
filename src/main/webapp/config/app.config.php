<?php
/**
 * Register module
 */
return [
    'api' => [
        'className' => 'HC\Api\Module',
        'path' => '../apps/api/Module.php'
    ],
    'common' => [
        'className' => 'HC\Common\Module',
        'path' => '../apps/common/Module.php'
    ],
    'ti' => [
        'className' => 'HC\TI\Module',
        'path' => '../apps/ti/Module.php'
    ],
    'merch' => [
        'className' => 'HC\Merch\Module',
        'path' => '../apps/merch/Module.php'
    ],
    'hk-calendar' => [
        'className' => 'HC\HkCalendar\Module',
        'path' => '../apps/hk-calendar/Module.php'
    ],
    'mixandmatch' => [
        'className' => 'HC\MixAndMatch\Module',
        'path' => '../apps/mixandmatch/Module.php'
    ],
    'deals' => [
        'className' => 'HC\Deals\Module',
        'path' => '../apps/deals/Module.php'
    ],
];
