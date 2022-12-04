<?php
include_once "db_connect.php";
$db = $GLOBALS['db'];

$bookingItems = $db->getBooking();




if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == false) {
    ?>
    <form action="login.php" method="post">
        Username: <br>
        <input type="text" name="username" ><br>
        Password: <br>
        <input type="password" name="password"><br>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
    <?php
} else {
    ?>

    <ul>
        <li><a href="index.php">Web page</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>


    <ul>
        <?php


    echo '<h2>Booking</h2>';
    echo '<div>';
    foreach ($bookingItems as $bookingItem) {
        echo "<li><b>Name: </b>".$bookingItem['meno_a_priezvisko'].", <b>Mail: </b>".$bookingItem['mail'].", <b>Telefonne cislo:</b> ".$bookingItem['telefonne_cislo'].", <b>Datum:</b> ".$bookingItem['datum'].", <b>Sprava:</b> ".$bookingItem['sprava'].", <b>IDpacient:</b> ".$bookingItem['pacient_idpacient']."</li>";
        echo '<a href="delete_booking.php?id='.$bookingItem['idbooking'].'">Delete </a>';
        echo '<a href="form.php?id='.$bookingItem['idbooking'].'">Update </a>';
        echo '<br>';
        echo '<br>';
    }

    echo '</div>';
    ?>
    </ul>
    <?php
}
?>