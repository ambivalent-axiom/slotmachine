<?php
    include "Board.php";
    include "Player.php";
    include "functions.php";

    $values = [
        newValue('A', 9, 2),
        newValue('K', 8, 3),
        newValue('Q', 7, 4),
        newValue('J', 6, 5),
        newValue('W', 10, 1),
        newValue('$', 2, 5),
        newValue('9', 1, 10),
        newValue('8', 1, 10),
        newValue('7', 1, 10),
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
    $takeBet = false;
//game
    while($gameOn) {
        cls();
        if( ! $takeBet) {
            $player->takeBet();
            $takeBet = true;
        }
        $player->subtractMoney($player->getBet());
        $spin = $board->createBoard();
        echo "\n" .
            str_repeat("::", $board->getSize()) .
            "SPIN" .
            str_repeat("::", $board->getSize()) .
            "\n";
        $board->printBoard($spin);
        $win = $board->checkWin($spin, $player->getBetMultiplier());
        echo "Bet: " . $player->getBet() . " Win Total: " . $player->getBetMultiplier() * $win . "\n";
        $player->addMoney($player->getBetMultiplier() * $win);
        echo $player->getName() . " credit: " . $player->getMoney() . "\n";
        $gameCheck = playAgain();

        if($gameCheck === 'exit') {
            $gameOn = false;
            echo "Thank You for playing!\n";
            echo "Your withdrawals: " . number_format($player->getMoney() / 100, 2) . "Eur\n";
        }
        if($gameCheck === 'bet') {
            $takeBet = false;
        }
        if($player->getMoney() < 5) {
            $gameOn = false;
            echo "Sorry, you don't have enough money to play again.\n";
        }
        if($player->getMoney() < $player->getBet()) {
            $takeBet = false;
        }

    }