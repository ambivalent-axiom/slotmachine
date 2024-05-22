<?php
class Player {
    private int $bet;
    private int $betMultiplier;
    private string $name;
    private int $money;
    public function __construct(string $name, int $money)
    {
        $this->name = $name;
        $this->money = $money;
    }
    public function takeBet(): void
    {
        echo colorize("| 1X = 5c  | 4X = 20c | 7X = 35c |", 33) . "\n";
        echo colorize("| 2X = 10c | 5X = 25c | 8X = 40c |", 33) . "\n";
        echo colorize("| 3X = 15c | 6X = 30c | 9X = 45c |", 33) . "\n";

        while(true) {
            $multiply = readline("Set Your bet (1-9): ");
            if($multiply * 5 > $this->money) {
                echo "Sorry, you don't have enough credit for such bet.\n";
                continue;
            }
            if(is_numeric($multiply) && $multiply >= 1 && $multiply <= 9) {
                break;
            }
        echo "Input must be integer between 1 and 9\n";
        }
        $this->setBet(5 * $multiply);
        $this->setBetMultiplier($multiply);
    }
    private function setBet(int $bet): void
    {
        $this->bet = $bet;
    }
    public function getBet(): int
    {
        return $this->bet;
    }
    private function setBetMultiplier(int $multiply): void
    {
        $this->betMultiplier = $multiply;
    }
    public function getBetMultiplier(): int
    {
        return $this->betMultiplier;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getMoney(): int
    {
        return $this->money;
    }
    public function addMoney(int $money): void
    {
        $this->money += $money;
    }
    public function subtractMoney(int $money): void
    {
        $this->money -= $money;
    }
}
