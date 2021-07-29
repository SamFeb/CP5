<?php
//Liste des membres de léquipe
$girls=array(
    array(
        'fname'=>'Shirley',
        'female'=> true,
        'dob' => '1996-09-19',
        'size'=> 1.68
    ),

    array(
        'fname'=>'Nathalie',
        'female'=> true,
        'dob' => '2000-05-05',
        'size'=> 1.80
    ),

    array(
        'fname'=>'Sara',
        'female'=> true,
        'dob' => '2000-08-10',
        'size'=> 1.78
    ),

    array(
        'fname'=>'Sandrina',
        'female'=> true,
        'dob' => '2000-02-08',
        'size'=> 1.82
    ),

    array(
        'fname'=>'Fatoumata',
        'female'=> true,
        'dob' => '2000-11-20',
        'size'=> 1.72
    ),

    array(
        'fname'=>'Odile',
        'female'=> true,
        'dob' => '2000-12-16',
        'size'=> 1.92
    )
);
//var_dump($girls);
echo "<br>";

$boys=[
    [
        'fname'=>'Vincent',
        'female'=> false,
        'dob'=> '1985-05-05',
        'size'=>1.84
    ],

    [
        'fname'=>'Jérôme',
        'female'=> false,
        'dob'=> '1991-04-22',
        'size'=>1.78
    ],

    [
        'fname'=>'Jean-Christophe',
        'female'=> false,
        'dob'=> '1995-06-06',
        'size'=>1.76
    ],

    [
        'fname'=>'Romain',
        'female'=> false,
        'dob'=> '1994-07-11',
        'size'=>1.71
    ],

    [
        'fname'=>'Samuel',
        'female'=> false,
        'dob'=> '2000-02-02',
        'size'=>1.81
    ],

    [
        'fname'=>'Thomas',
        'female'=> false,
        'dob'=> '2000-12-09',
        'size'=>1.76
    ],

    [
        'fname'=>'Alban',
        'female'=> false,
        'dob'=> '1985-12-16',
        'size'=>1.84
    ],

    [
        'fname'=>'Ali',
        'female'=> false,
        'dob'=> '2000-08-20',
        'size'=>1.70
    ]
];

echo "<br>";
///var_dump($boys);
echo "<br>";

//Autre façon d'ajouter elmt à un tableau
//Tableau de base qui contient 1 membres
$trainers[]=array(
    'fname'=> 'Nadjet',
    'female'=> true,
    'dob'=> '2000-08-09',
    'size' => 1.71
);

//Ajout un autre memebre au tableau trainers avec array_push
//dans lequel je mets un gtableau associatif
array_push($trainers,
    array(
        'fname'=> 'Saman',
        'female'=> false,
        'dob'=> '1992-02-16',
        'size'=>1.75
    ),
    array(
        'fname'=> 'Lesly',
        'female'=> false,
        'dob'=> '1980-01-01',
        'size'=>1.76
    )
);

echo "<br>";
//var_dump($trainers);
echo "<br>";
$team = array_merge($trainers, $girls, $boys);
echo "<br>";
//var_dump($team);
?>