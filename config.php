<?php
$preset_default = array(
    'top' => 0.5,
    'bottom' => 0.5,
    'rand' => 0.25,
);

$sliders = array(
    'gender_identity' => array(
        'labels' => array(
            'title' => 'Gender Identity',
            'zero' => 'Nongendered',
            'top' => 'Woman-ness',
            'bottom' => 'Man-ness',
        ),
        'presets' => array(
            'woman' => array(
                'top' => 0.5,
                'bottom' => 0.0,
            ),
            'man' => array(
                'top' => 0.0,
                'bottom' => 0.5,
            ),
            'two-spirit' => array(
                'top' => 0.5,
                'bottom' => 0.5,
            ),
            'genderqueer' => array(
                'top' => 0.4,
                'bottom' => 0.6,
                'rand' => 1.0,
            ),
            'genderless' => array(
                'top' => 0.0,
                'bottom' => 0.0,
                'rand' => 0.1,
            ),
        ),
    ),
    'gender_expression' => array(
        'labels' => array(
            'title' => 'Gender Expression',
            'zero' => 'Agender',
            'top' => 'Masculine',
            'bottom' => 'Feminine',
        ),
        'presets' => array(
        ),
    ),
    'biological_sex' => array(
        'labels' => array(
            'title' => 'Biological Sex',
            'zero' => 'Asex',
            'top' => 'Female-ness',
            'bottom' => 'Male-ness',
        ),
        'presets' => array(
        ),
    ),
    'attracted_to' => array(
        'labels' => array(
            'title' => 'Attracted to',
            'zero' => 'Nobody',
            'top' => '(Men/Males/Masculinity)',
            'bottom' => '(Women/Females/Femininity)',
        ),
        'presets' => array(
        ),
    ),
);
?>
