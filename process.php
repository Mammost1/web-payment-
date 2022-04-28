
<?php include 'condb.php'; ?>

<?php


$username = $_POST['username'];
$password = $_POST['password'];
$re_password = $_POST['re_password'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];

if ($password == $re_password and $password != "" and $phone_number != "" and $email != "") {
     


    mysqli_query($con, "INSERT INTO login (username , password,phone_number,email)
                         VALUES ('$username ','$password','$phone_number','$email' )");
    sleep(2);
    Header("Location: index.html", 'username');
} else {
    sleep(2);
    Header("Location: register.html");
 }

?>
