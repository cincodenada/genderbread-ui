<?php
$preset_default = array(
    'top' => 0.5,
    'bottom' => 0.5,
    'rand' => 0.2,
);

$sliders = array(
    'gender_identity' => array(
        'color' => '#63a8d9',
        'labels' => array(
            'title' => 'Gender Identity',
            'zero' => 'Nongendered',
            'top' => 'Woman-ness',
            'bottom' => 'Man-ness',
        ),
        'presets' => array(
            'woman' => array(0.5,0.0),
            'man' => array(0.0,0.5),
            'two-spirit' => array(0.5,0.5),
            'genderqueer' => array(0.4,0.6,1.0),
            'genderless' => array(0.0,0.0,0.1),
        ),
    ),
    'gender_expression' => array(
        'color' => '#e2ba37',
        'labels' => array(
            'title' => 'Gender Expression',
            'zero' => 'Agender',
            'top' => 'Masculine',
            'bottom' => 'Feminine',
        ),
        'presets' => array(
            'butch' => array(0.5,0),
            'femme' => array(0,0.5),
            'androgynous' => array(0.5,0.5,0.05),
            'gender neutral' => array(0,0,0.1),
            'hyper-masculine' => array(1,0,0.05),
        ),
    ),
    'biological_sex' => array(
        'color' => '#b162a6',
        'labels' => array(
            'title' => 'Biological Sex',
            'zero' => 'Asex',
            'top' => 'Female-ness',
            'bottom' => 'Male-ness',
        ),
        'presets' => array(
            'male' => array(0,1,0.5),
            'female' => array(1,0,0.5),
            'intersex' => array(0.5,0.5),
            'female self ID' => array(0.6,0.4,0.1),
            'male self ID' => array(0.4,0.6,0.1),
        ),
    ),
    'attracted_to' => array(
        'color' => '#f26438',
        'labels' => array(
            'title' => 'Attracted to',
            'zero' => 'Nobody',
            'top' => '(Men/Males/Masculinity)',
            'bottom' => '(Women/Females/Femininity)',
        ),
        'presets' => array(
            'straight' => array(1,0),
            'gay' => array(1,0),
            'pansexual' => array(1,1),
            'asexual' => array(0,0,0.1),
            'bisexual' => array(0.5,0.5,0.25),
        ),
    ),
);
?>
