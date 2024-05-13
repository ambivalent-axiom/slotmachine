<?php
class Player {
    public $bet;
    public $betMuliplier;
    function __construct(string $name, int $money)
    {
        $this->name = $name;
        $this->money = $money;
    }
    function takeBet(): void
    {
        echo colorize("| 1X = 5c  | 4X = 20c | 7X = 35c |", 33) . "\n";
        echo colorize("| 2X = 10c | 5X = 25c | 8X = 40c |", 33) . "\n";
        echo colorize("| 3X = 15c | 6X = 30c | 9X = 45c |", 33) . "\n";

        while(true) {
            $multiply = readline("Place Your bet (1-9): ");
            if($multiply * 5 > $this->money) {
                echo "Sorry, you don't have enough credit for such bet.\n";
                continue;
            }
            if(is_numeric($multiply) && $multiply >= 1 && $multiply <= 9) {
                break;
            }
        echo "Input must be integer between 1 and 9\n";
        }
        $this->bet = 5 * $multiply;
        $this->betMuliplier = $multiply;
    }
}
