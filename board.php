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
    public function checkWin(array $board, int $bet): int //returns bet multiplier ++ prints WIN notifications
    {
        $winSum = 0;
        //this collects the line value as sequence in string
        foreach ($this->winLines as $line) {
            $string = '';
            foreach ($line as $element) {
                $x = $element[0];
                $y = $element[1];
                $string .= $board[$x][$y];
            }

            $win = $this->calcWinnings($string); //integer
            $winSum += $win;

            //WIN visualization
            if($win > 0) {
                echo "\n" .
                    str_repeat("**", $this->size[0]) .
                    "WIN" .
                    str_repeat("**", $this->size[0]) .
                    "\n";
                $wincombo = $this->visualizeGrid($board, $line);
                $this->printBoard($wincombo);
                echo $string . " " . $win * $bet . "\n";
            }
        }
        return $winSum;
    }
    function calcWinnings(string $line): int {
        $firstChar = $line[0];
        $win = 0;
//saskaitam vienādos līdz pārtrūkst vienādo simbolu virkne
        for ($i = 1; $i < $this->size[0]; $i++) {
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
    public function visualizeGrid(array $board, array $line): array
    {
        foreach ($line as $element) {
            $board[$element[0]][$element[1]] = colorize("*", 35);
        }
        return $board;
    }
}