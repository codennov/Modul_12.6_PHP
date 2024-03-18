
<?php
header('Content-type: text/plain');
?>
<?php
$persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];


//var_dump($persons_array);
//var_dump($persons_array[0]['fullname'])



echo "\nРазбиение и объединение ФИО.\n";

echo "\nРазбиение имени\nна составляющие.\n\n";

function getPartsFromFullname ($fullname){
    $part = explode(" ", $fullname);
     
     $newpart = ["surname", "name", "patronomyc",];
    return array_combine($newpart, $part);
    
}

//print_r(getPartsFromFullname("Иванов Иван Иванович"))

for($i=0; $i < sizeof($persons_array); $i++) {
print_r(getPartsFromFullname($persons_array[$i]["fullname"]));
//var_dump($rew1);
}

echo "\nОбъединение имени в строку.\n\n";

function getFullnameFromParts($surname, $name, $patronomyc){
    return trim($surname . ' ' .$name . ' ' .$patronomyc);
   // trim использовала, потому что откуда то после отчества появляются 2 лишних знака перд кавычкаи
    
}
//var_dump(getFullnameFromParts ("Иванов", "Иван", "Иванович"));

for($i=0; $i < sizeof($persons_array); $i++) {
    var_dump(getFullnameFromParts($persons_array[$i]['fullname'], $surname, $name, $patronomyc));
}


echo "\nСокращение ФИО.\n\n";

function getShortName($fullname){    
$part = getPartsFromFullname($fullname);
//print_r($part["name"]);
return $part["name"] . " " . mb_substr($part["surname"], 0, 1) . ".";
}
 
for($i=0; $i < sizeof($persons_array); ++$i){ 
var_dump(getShortName($persons_array[$i]["fullname"])) . PHP_EOL;


}
 
echo "\nФункция опредgеления пола по ФИО.\n\n";

function getGenderFromName($fullname) {
    $arr = getPartsFromFullname($fullname);
    $surname = $arr['surname'];
    $name = $arr['name'];
    $patronomyc = $arr['patronomyc'];
    $genderSum = 0;

    if (mb_substr($surname, -1, 1) === 'в') {
        $genderSum++;
    } elseif (mb_substr($surname, -2, 2) === 'ва') {
        $genderSum--;
    }

    if ((mb_substr($name, -1, 1) == 'й') || (mb_substr($name, -1, 1) == 'н')) {
        $genderSum++;
    } elseif (mb_substr($name, -1, 1) === 'а') {
        $genderSum--;
    }

    if (mb_substr($patronomyc, -2, 2) === 'ич') {
        $genderSum++;
    } elseif (mb_substr($patronomyc, -3, 3) === 'вна') {
       $genderSum--;
    }

    

    return ($genderSum <=> 0);
}

foreach ($persons_array as $value) {
    $fullname = $value['fullname'];
    //echo getGenderFromName($fullname) . PHP_EOL;
    if (getGenderFromName($fullname) === 1) {
        echo ($fullname) . ' мужской' . PHP_EOL;
    } elseif (getGenderFromName($fullname) === -1) {
        echo ($fullname) .' женский' .  PHP_EOL;
    } else {
        echo  ($fullname) . ' неопределённый' .PHP_EOL;
    }
}
echo PHP_EOL;

echo "\nОпределение возрастно-полового состава.\n\n";

function getGenderDescription($array){
    $men = array_filter($array, function($array){  
        $fullname = $array["fullname"];
        $genderMen = getGenderFromName($fullname);
        if ($genderMen > 0){
        return $genderMen;
    }
    });
    //print_r($men);
    $women = array_filter($array, function($array){  
        $fullname = $array["fullname"];
        $genderWomen = getGenderFromName($fullname);
        if ($genderWomen < 0){
            return $genderWomen;
        }
        });
    $undefined = array_filter($array, function($array){  
        $fullname = $array["fullname"];
        $genderUndefined = getGenderFromName($fullname);
        if ($genderUndefined == 0){
            return $genderUndefined + 1;
        }
        });
    
    $allMen = count($men);
    //echo ($allMen);
    $allWomen = count($women);
    $allUndefined = count($undefined);
    $allPeople = count($array);

    $percentMen = round((100 / $allPeople * $allMen), 1);
    $percentWomen = round((100 / $allPeople * $allWomen), 1); 
    $percenUndefined = round((100 / $allPeople * $allUndefined), 1);

    return <<< TEXT
    Гендерный состав аудитории:
    ---------------------------
    Мужчины - $percentMen%
    Женщины - $percentWomen%
    Неудалось определить - $percenUndefined%
    TEXT;

}
echo getGenderDescription($persons_array);


echo PHP_EOL;
echo "\nИдеальный подбор пары.\n\n";

$surname = 'иванов';
$name = 'иван';
$patronomyc = 'иванович';

function getPerfectPartner($surname, $name, $patronomyc, $array){
   
    $surnameTarget = mb_convert_case($surname, MB_CASE_TITLE_SIMPLE);
    //echo $surnameTarget;
    $nameTarget = mb_convert_case($name, MB_CASE_TITLE_SIMPLE);
    //echo $nameTarget;
    $patronomycTarget = mb_convert_case($patronomyc, MB_CASE_TITLE_SIMPLE);
    //echo $patronomycTarget;

    $fullnameTarget = getFullnameFromParts($surnameTarget, $nameTarget, $patronomycTarget);
    $shortFullnameTarget = getShortName($fullnameTarget);
    $genderFullnameTarget = getGenderFromName($fullnameTarget);


//echo $genderFullnameTarget;

$allPeople = count($array);

do {
    $arrayNumRand = rand(0, $allPeople - 1); // номер случайного имени отсчет в массиве от 0 до 10 = 11, значит от 11-1 будут все значения от 0 до 10
    $arrayFullnameRand = $array[$arrayNumRand]['fullname'];         // полное имя случайного имени
    $arrayFullnameRandGender = getGenderFromName($arrayFullnameRand);  // пол случайного имени в виде: -1 0 1
} while (($genderFullnameTarget == $arrayFullnameRandGender) || ($arrayFullnameRandGender == 0));
//echo $arrayFullnameRandGender . PHP_EOL; // ПРОВЕРОЧНЫЙ КОД на противоположность кода

$arrayShortNameRand = getShortName($arrayFullnameRand);   // сокращенное имя случайного имени
$percentPerfect = rand(5000, 10000) / 100;                  // от 50% до 100% количество знаков после запятой
                                        // определяется подбором нужного значения и делением на определённое число
return <<< TEXT
$shortFullnameTarget + $arrayShortNameRand =
♡ Идеально на $percentPerfect% ♡
TEXT;
}
echo getPerfectPartner($surname, $name, $patronomyc, $persons_array);
?>








