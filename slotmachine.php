<?php
    include "board.php";
    include "player.php";
    include "functions.php";

    $values = [
        newValue('A', 9, 2),
        newValue('K', 8, 3),
        newValue('Q', 7, 4),
        newValue('J', 6, 5),
        newValue('W', 10, 1),
        newValue('$', 5, 6),
        newValue('9', 4, 7),
        newValue('8', 3, 8),
        newValue('7', 2, 9),
        newValue('6', 1, 10),
    ];

    $lines3 = [
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
    $lines5 = [
        [
            [0,0],[0,1],[0,2],[0,3],[0,4] //top➙
        ],
        [
            [1,0],[1,1],[1,2],[1,3],[1,4] //middle➞
        ],
        [
            [0,0],[1,1],[2,2],[1,3],[0,4] // diagonal➚
        ],
        [
            [2,0],[1,1],[0,2],[1,3],[2,4] // diagonal➘
        ],
        [
            [0,0],[1,0],[2,0],[1,1],[0,1] // top to bottom➙
        ],
        [
            [0,1],[1,1],[2,1],[1,2],[0,2] // top to bottom➙
        ],
        [
            [0,2],[1,2],[2,2],[1,3],[0,3] // top to bottom➙
        ],
        [
            [0,3],[1,3],[2,3],[1,4],[0,4] // top to bottom➙
        ],
        [
            [2,0],[1,0],[0,0],[1,1],[2,1] // bottom to top➘
        ],
        [
            [2,1],[1,1],[0,1],[1,2],[2,2] // bottom to top➘
        ],
        [
            [2,2],[1,2],[0,2],[1,3],[2,3] // bottom to top➘
        ],
        [
            [2,3],[1,3],[0,3],[1,4],[2,4] // bottom to top➘
        ]
    ];

//init
    echo colorize("", 31);
    $player = register();
    $gameOn = true;
    $board = chooseMachine($values, $lines3, $lines5);
//game
    while($gameOn) {
        cls();
        echo $player->name . " credit: " . $player->money . "\n";
        $player->takeBet();
        $player->money -= $player->bet;
        $spin = $board->createBoard();
        $board->printBoard($spin);
        $win = $board->checkWin($spin, $player->betMuliplier);
        echo "Bet: " . $player->bet . " Win: " . $player->betMuliplier * $win . "\n";
        $player->money += $player->betMuliplier * $win;
        $gameOn = playAgain();
        if($player->money <= 0) {
            $gameOn = false;
            echo "Sorry, you don't have enough money to play again.\n";
        }
    }


