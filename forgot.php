<?php
if (isset($_POST['submit'])) {
    #if (isset($_POST['email']){

        $email = $_POST['foremail'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "dan";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM forgot WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO forgot(email) values(?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("s",$email);
                if ($stmt->execute()) {
                    echo "Go to The Your Gmail !";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Already Send  Your  Email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
  #}
}
#else {
   ### echo "Submit button is not set";
##}
?>