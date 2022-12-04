<?php
namespace projekt_portalove;

class DB
{
    private $host;
    private $dbName;
    private $username;
    private $password;
    private $port;

    private $connection;

    public function __construct($host, $dbName, $username, $password, $port = '')
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;

        try {
            $this->connection = new \PDO("mysql:host=$host;dbname=$dbName", $username, $password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function insertBooking($name, $email, $phone, $date, $msg)
    {
        $sql = "INSERT INTO booking(meno_a_priezvisko, mail, telefonne_cislo, datum, sprava)
                 VALUE ('".$name."', 
                '".$email."', 
                '".$phone."', 
                '".$date."',
                '".$msg."')";
        try {
            $this->connection->exec($sql);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getBooking()
    {
        $bookingItems = [];
        $sql = "SELECT * FROM `booking`";
        $query = $this->connection->query($sql);

        while ($row = $query->fetch()) {
            $bookingItems[] = [
                'idbooking' => $row['idbooking'],
                'meno_a_priezvisko' => $row['meno_a_priezvisko'],
                'mail' => $row['mail'],
                'telefonne_cislo' => $row['telefonne_cislo'],
                'datum' => $row['datum'],
                'sprava' => $row['sprava'],
                'pacient_idpacient' => $row['pacient_idpacient'],
            ];
        }

        return $bookingItems;
    }
    public function deleteBooking($idbooking)
    {
        $sql = "DELETE FROM booking WHERE idbooking = ".$idbooking;

        try {
            $this->connection->exec($sql);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function updateBooking($id, $name, $email, $phone, $date, $message)
    {
        $sql = "UPDATE booking 
                SET meno_a_priezvisko = '".$name."', mail = '".$email."', telefonne_cislo = '".$phone."', datum = '".$date."', sprava = '".$message."'
                WHERE idbooking = ".$id;

        try {
            $this->connection->exec($sql);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getBookingDetails($id)
    {
        $sql = "SELECT idbooking, meno_a_priezvisko, mail, telefonne_cislo, datum, sprava  FROM booking WHERE idbooking = " . $id;
        $result = [];

        try {
            $query = $this->connection->query($sql);
            $result = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            return $result;
        }

    }

    public function login($username, $password) {
        $hasPassword = sha1($password);
        $sql = "SELECT COUNT(id) AS is_admin FROM user WHERE username = '".$username."' AND password = '".$password."'";

        try {
            $query = $this->connection->query($sql);
            $result = $query->fetch(\PDO::FETCH_ASSOC);
            if(intval($result['is_admin']) == 1) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }
    }
}

?>
