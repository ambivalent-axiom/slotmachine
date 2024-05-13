<?php
    include "board.php";
    include "player.php";
    include "functions.php";
//still missing weights function

    $values = [
        newValue('A', 4, 2),
        newValue('K', 3, 3),
        newValue('Q', 2, 4),
        newValue('J', 1, 5),
        newValue('W', 5, 1)
    ];

    $lines3x3 = [
        [
            [0,0],[0,1],[0,2] //top➙
        ],
        [
            [1,0],[1,1],[1,2] //middle➞
        ],
        [
            [2,0],[2,1],[2,2] //bottom➞
        ],
        [
            [0,0],[1,1],[2,2] //➘
        ],
        [
            [2,0],[1,1],[0,2] //➚
        ],
    ];

//init
    $player = register();
    $board = new Board([3, 3], $values, $lines3x3);
    $gameOn = true;

//game
    while($gameOn) {
        cls();
        echo $player->name . " credit: " . $player->money . "\n";
        $player->takeBet();
        $player->money -= $player->bet;
        $spin = $board->createBoard();
        //print board/dump board
        $board->printBoard($spin);
        $win = $board->checkWin($spin);
        echo "Bet: " . $player->bet . " Win: " . $player->bet * $win . "\n";
        $player->money += $player->bet * $win;
        $gameOn = playAgain();
        if($player->money <= 0) {
            $gameOn = false;
            echo "Sorry, you don't have enough money to play again.\n";
        }
    }


