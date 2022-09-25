<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['fullname'] ?></title>
</head>

<body>
    <div class="container">
        <?php
        global $db_connection;
        $fullname = $_SESSION['fullname'];
        $query = "SELECT * FROM user_information where full_name=$fullname";
        $result = mysqli_query($db_connection, $query);
        while($row= mysqli_fetch_assoc($result)){
            $fullname = $row['full_name'];
            $email = $row['email'];
            $country = $row['country'];
            $phone_number =$row['phone_number'];

            echo $fullname, '<br>', $email, '<br>', $country, '<br>', $phone_number;
        }
        ?>
    </div>
</body>

</html>