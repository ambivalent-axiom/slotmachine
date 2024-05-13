<?php
class Player {
    public $bet;
    function __construct(string $name, int $money)
    {
        $this->name = $name;
        $this->money = $money;
    }
    function takeBet(): void
    {
        while(true) {
            $money = readline("Place Your bet (1-$this->money): ");
            if(is_numeric($money) && $money >= 1 && $money <= $this->money) {
                break;
        }
        echo "Input must be integer between 1 and $this->money\n";
    }
        $this->bet = $money;
    }
}
