<?php
function cls(): void {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        system('cls');
    } else {
        system('clear');
    }
}
function register(): Player {
    while(true) {
        $name = readline("Please choose Your name or alias 0-10 chars: ");
        if(strlen($name) <= 10) {
            break;
        }
        echo "Input must be no longer then 10 chars!\n";
    }
    while(true) {
        $money = (int) readline("How much money would you like to spend in Euros (1-100): ");
        if($money >= 1 && $money <= 100) {
            break;
        }
        echo "Input must be integer between 1 and 1000\n";
    }
    return new Player($name, $money*100);
}
function playAgain(): string
{
    $userInput = strtolower(readline("[(E)xit] [(B)et] or Spin: "));
    if($userInput[0] === "e" || $userInput === "exit"){
        return 'exit';
    }
    if($userInput[0] === "b" || $userInput === "bet"){
        return 'bet';
    }
    return 'spin';
}
function newValue(string $name, int $multiplier, int $weight): stdClass {
    $value = new stdClass();
    $value->name = $name;
    $value->multiplier = $multiplier;
    $value->weight = $weight;
    return $value;
}
function weightedRandom(array $values) {
    // Calculate the total weight
    $weights = [];
    foreach ($values as $value) {
        $weights[] = $value->weight;
    }
    $totalWeight = array_sum($weights);

    // Generate a random number between 1 and the total weight
    $randomNumber = mt_rand(1, $totalWeight);


    // Iterate through the values and their weights
    foreach ($values as $value) {
        // Subtract the weight of the current value from the random number
        $randomNumber -= $value->weight;

        // If the random number is less than or equal to 0, return the current value
        if ($randomNumber <= 0) {
            return $value;
        }
    }
    return null;
}
function colorize(string $string, int $color): string {
    return "[{$color}m{$string}[0m";
}
function chooseMachine(&$values, &$lines3, &$lines5) {
    while(true) {
        echo "Which machine would You like to play?\n";
        echo "1: (3X3)\n";
        echo "2: (5X3)\n";
        $input = readline("Choice: ");
        if(is_numeric($input) && $input >= 1 && $input<= 2) {
            break;
        }
        echo "Input must be integer between 1 and 2\n";
    }
    switch ($input) {
        case 1:
            return new Board([3, 3], $values, $lines3);
        case 2:
            return new Board([5, 3], $values, $lines5);
    }
    return null;
}