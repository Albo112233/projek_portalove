<?php
include_once "db_connect.php";
$db = $GLOBALS['db'];

$BookingDetails = $db->getBookingDetails($_GET['id']);
?>

<form action="update_booking.php" method="post">
    Name:<br>
    <input type="text" name="name" value="<?php echo $BookingDetails[0]['meno_a_priezvisko']; ?>" /><br>
    Mail:<br>
    <input type="text" name="email" value="<?php echo $BookingDetails[0]['mail']; ?>" /><br>
    Phone:<br>
    <input type="text" name="phone" value="<?php echo $BookingDetails[0]['telefonne_cislo']; ?>" /><br>
    Datum:<br>
    <input type="date" name="date" value="<?php echo $BookingDetails[0]['datum']; ?>" /><br>
    Sprava:<br>
    <textarea name="message"><?php echo $BookingDetails[0]['sprava']; ?></textarea><br>
    <input type="hidden" name="id" value="<?php echo $BookingDetails[0]['idbooking']; ?>">
    <input type="submit" name="submit" value="Update">
</form>