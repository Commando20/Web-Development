$(function () {
    var squares = [], 
        SIZE = 3,
        EMPTY = "&nbsp;",
        score,
        moves,
        turn = "X",
      
    /* Each cell represents an individual bit in a 9-bit string, and a player's 
     * squares at any given time can be represented as a unique 9-bit value.
     *     273                 84
     *        \               /
     *          1 |   2 |   4  = 7
     *       -----+-----+-----
     *          8 |  16 |  32  = 56
     *       -----+-----+-----
     *         64 | 128 | 256  = 448
     *       =================
     *         73   146   292
     */
        
    wins = [7, 56, 448, 73, 146, 292, 273, 84],
        

    startNewGame = function () { //Clears score and count, and erases board
        fadeOut();
        turn = "X"; //makes it X's turn.
        score = {"X": 0, "O": 0};
        moves = 0;
        squares.forEach(function (square) {square.html(EMPTY);});
    },
        

    win = function (score) { //Returns whether the given score is a winning score.
        for (var i = 0; i < wins.length; i += 1) { //Loop through each element in wins
            if ((wins[i] & score) === wins[i]) { //Find the boxes the player used to win
                return true; //They won
            }
        }
        return false; //Nobody has won
    },
        
        
    fadeIn = function () { //Function to have result and options appear after game
        $("#result").hide().fadeIn("normal");
        $("#restart").hide().fadeIn("normal");
    },
    
    
    fadeOut = function () { //Function to have result and options disappear after game
        $("#result").fadeOut("normal");
        $("#restart").fadeOut("normal");
    },
  
        
    //Sets the clicked-on square to the current player's mark, then checks for a win or a tie game.
    set = function () {       
        if ($(this).html() !== EMPTY) { return; } //If this (table) is full, then exit
        
        $(this).html(turn).hide().fadeIn("normal"); //On X or O turn, display it on table
        
        if (turn === "X") { //Conditions to change the appearance of the X and O
            displayX = $("<i color=#f46239></i>").addClass("fas fa-times fa-5x");
            $(this).html(displayX);
        } else if (turn === "O") {
            displayO = $("<i color=#969696></i>").addClass("far fa-circle fa-5x");
            $(this).html(displayO);
        }
        
        moves += 1; //Increment moves
        score[turn] += $(this)[0].indicator; //Adds the value of td to score so one can see if they got a sum that is equal to an element in wins to prove they won
        
        if (win(score[turn])) { //if score equals a value in wins[], we have winner
            fadeIn();
            $("#result").css({color: "#383838", fontWeight: "bold", fontFamily: "sans-serif", fontSize: "30px"});
            $("#result").html(turn + " is the winner!");
            $("#restart").click(startNewGame);
            
        } else if (moves === SIZE * SIZE) { //If all tiles are full, it's a tie
            fadeIn();
            $("#result").css({color: "#383838", fontWeight: "bold", fontFamily: "sans-serif", fontSize: "30px"});
            $("#result").html("It's a tie game!");
            $("#restart").click(startNewGame);
            
        } else {
            turn = (turn === "X" ? "O" : "X"); //If current turn is X, then change to O, otherwise, the current turn is O and will switch to X
        }
    },
    
        
    //Creates and attaches the DOM elements for the board as an HTML table, assigns the indicators for each cell, and starts a new game.
    play = function () { 
        $("#result").hide();
        $("#restart").hide();
               
        var board = $("<table border=5 cellspacing=0 align=center>"), indicator = 1;
        $(board).css({borderStyle: "solid", borderColor: "#gray"});
        for (var i = 0; i < SIZE; i += 1) { //Loop for setting up each row
            var row = $("<tr>");
            board.append(row);
            for (var j = 0; j < SIZE; j += 1) { //Loop to set each column
                var cell = $("<td height=130 width=130 align=center valign=center></td>");
                cell[0].indicator = indicator;
                cell.mouseover(function() {$(this).css("background-color", "#dedede");});
                cell.mouseout(function() {$(this).css("background-color", "white");});
                cell.click(set);
                row.append(cell);
                squares.push(cell);
                indicator += indicator;
            }
        }
        $("#tictactoe").fadeOut("normal");
        
        $("#play").click(function () { //playing against a real opponent
            $("#play").fadeOut("normal");
            $("#tictactoe").fadeIn("normal");
            $(document.getElementById("tictactoe") || document.body).append(board);
            startNewGame();    
        });
    };

    play();
});