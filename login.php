<?php
if (isset($_POST['submit'])) {
   # if (isset($_POST['email']) || isset($_POST['password']){
        
        $email = $_POST['logemail'];
        $password = $_POST['logpassword'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "dan";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM login WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO login(email, password) values(?, ?)";

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
                $stmt->bind_param("ss",$email, $password);
                if ($stmt->execute()) {
                    echo "Thank You for Our Course Joining.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already login using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
   # }
}
#else {
    #echo "Submit button is not set";
#}
?>