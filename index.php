<html lang="en">
<head>
    <title>SOS</title>
    <script src="js/main.js" defer></script>
    <script src="js/queryParser.js" defer></script>
    <script src="js/graphic.js" defer></script>
    <script src="js/sos.js" defer></script>
    <script src="js/globals.js" defer></script>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

    <div id="gameArea">
        <canvas id="canvas"></canvas>
        <table id="gameTable">
            <?php
            if (!isset($_GET['n']) || !isset($_GET['m'])) {
                echo "
                <tr>
                    <td>
                        <form action='index.php' method='get'>
                            <input type='text' name='n' placeholder='n'/>
                            <br />
                            <br />
                            <input type='text' name='m' placeholder='m'/>
                            <br />
                            <br />
                            <input style='width: 170px' type='submit' value='Start'/>
                        </form>
                    </td>
                </tr>
                ";
            } else {
                $n = $_GET['n'];
                $m = $_GET['m'];

                // sanitize input
                try{
                    $n = intval($n);
                    $m = intval($m);
                    if ($n == 0 || $m == 0)
                        throw new Exception("Invalid input");
                    if ($n < 3 || $m < 3)
                        throw new Exception("Dimensions should be at least 3x3");
                } catch (Exception $e) {
                    echo $e->getMessage();
                    return;
                }

                // create table
                $idCounter = 0;
                for ($i = 0; $i < $n; $i++) {
                    echo "<tr>";
                    for ($j = 0; $j < $m; $j++) {
                        echo "<td data-row=".$i." data-col=".$j." id='t".$idCounter."' onclick='tdclick(this)'>&nbsp</td>";
                        $idCounter += 1;
                    }
                    echo "</tr>";
                }
            }
            ?>
        </table>
        <div id="scoreTable">
            <div id="scores">
                <p id='blue'>Blue Team Score: 0</p>
                <p id='red'>Red Team Score: 0</p>
            </div>
            <p id="turn"></p>
            <div id="textSelection">
                <p>Selected: </p>
                <p id="selectedText"></p>
                <button onclick="changeText()">Change Selection</button>
            </div>
            <div id="gameOptions">
                <button onclick="endGame()">End Game</button>
            </div>
        </div>
    </div>
</body>
</html>
