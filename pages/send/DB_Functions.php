<?php


class DB_Functions {

     private $conn;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {
        
    }

 
    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $plan, $email, $tpin, $address, $phone, $password) {
        $uuid = uniqid('', true);

$hash = $this->hashSSHA($password);

$encrypted_password = $hash["encrypted"]; // encrypted password

$salt = $hash["salt"]; // salt

$wallet = $this->getwallet($plan);//wallet

$spent = '0';

$debt = '0';

$stmt = $this->conn->prepare("INSERT INTO clients (unique_id, name, plan, wallet, spent, debt, email, tpin, address, phone, encrypted_password, salt, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

$stmt->bind_param("ssssssssssss", $uuid, $name, $plan, $wallet, $spent, $debt, $email, $tpin, $address, $phone, $encrypted_password, $salt);

$result = $stmt->execute();

$stmt->close();

// check for successful store

if ($result) {

$stmt = $this->conn->prepare("SELECT * FROM clients WHERE email = ?");

$stmt->bind_param("s", $email);

$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

$stmt->close();

return $user;

} else {

return false;

}
    }



    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {

       if( $stmt = $this->conn->prepare("SELECT unique_id, name, plan_type, wallet, spent, debt, email, tpin, address, phone, encrypted_password, salt, created_at FROM clients LEFT JOIN membership ON clients.plan = membership.id WHERE email = ?")){

        $stmt->bind_param("s", $email);

$stmt->execute();

$stmt->store_result();

$stmt->bind_result($v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14);

$user=array();
 
while($stmt->fetch()){

$user[unique_id] = $v2;

$user[name] = $v3;

$user[plan_type] = $v4;

$user[wallet] = $v5;

$user[spent] = $v6;

$user[debt] = $v7;

$user[email] = $v8;

$user[tpin] = $v9;

$user[address] = $v10;

$user[phone] = $v11;

$user[encrypted_password] = $v12;

$user[salt] = $v13;

$user[created_at] = $v14;

$salt =$user['salt'];

$encrypted_password = $user['encrypted_password'];

$hash = $this->checkhashSSHA($salt, $password);

if ($encrypted_password == $hash) {

return $user;
}
}

} else {

return NULL;

}
    }

 
    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $stmt = $this->conn->prepare("SELECT email from clients WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }

function getwallet($plan) {

switch ($plan) {

    case "1":

        return '30000';

        break;

    case "2":

        return '10000';

        break;

   case "3":

        return '7500';

        break;

   case "4":

        return '5000';

        break;

   case "5":

        return '2500';

        break;

}
}

}

?>
