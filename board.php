<?php
class Board {
    public function __construct(array $size, array $values, array $winLines)
    {
        $this->size = $size;
        $this->winLines = $winLines;
        $this->values = $values;
    }
    public function createBoard(): array
    {
        $boardFull = [];
        for ($i = 0; $i < $this->size[1]; $i++) {
            $boardLine = [];
            for ($j = 0; $j < $this->size[0]; $j++) {
                $boardChar = weightedRandom($this->values);
                array_push($boardLine, $boardChar->name);
            }
            array_push($boardFull, $boardLine);
        }
        return $boardFull;
    }
    public function printBoard(array $board): void
    {

        echo str_repeat("+---+", $this->size[0]) . "\n";
        for($i = 0; $i < $this->size[1]; $i++) {
            for($j = 0; $j < $this->size[0]; $j++) {
                echo "| " . $board[$i][$j] . " |";
            }
            echo "\n";
            echo str_repeat("+---+", $this->size[0]) . "\n";
        }
    }
    public function checkWin(array $dumpBoard): int //returns bet multiplier
    {
        $winSum = 0;
        //this collects the line value as sequence in string
        foreach ($this->winLines as $line) {
            $string = '';
            foreach ($line as $element) {
                $x = $element[0];
                $y = $element[1];
                $string .= $dumpBoard[$x][$y];
            }
//at this point we have a full string to validate with win condition, send it to calcWinnings to get integer of funds if won.
            $win = $this->calcWinnings($string); //integer
            $winSum += $win;
//te ir pieejama win kombinācija un var viņu kaut kā vizualizēt.
//            if($win > 0) {
//                var_dump($line); //šeit ir vinnesta līnija
//            }
        }
        return $winSum;
    }
    function calcWinnings(string $line): int {
        $firstChar = $line[0];
        $win = 0;
//saskaitam vienādos līdz pārtrūkst vienādo simbolu virkne
        for ($i = 1; $i < $this->size[1]; $i++) {
            $nextChar = $line[$i];
            if ($nextChar !== $firstChar) {
                break;
            }
            $win = $i;
        }
//šeit sareizinam ar to, cik vienādi simboli sakrita
        $valueIndex = array_search($firstChar, $this->getValueKeys());
        if($win > 0) {
            return  ($win+1) * $this->values[$valueIndex]->multiplier; //number of chars X multiplier of value
        }
        return $win;
    }
    public function getValueKeys(): array {
        $keys = [];
        foreach ($this->values as $value) {
            array_push($keys, $value->name);
        }
        return $keys;
    }
}
