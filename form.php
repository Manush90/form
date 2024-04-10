<?php
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $birthdate = $_POST['birthdate'];
        $password = $_POST['password'];

        $dob = new DateTime($birthdate);
        $now = new DateTime();
        $age = $now->diff($dob)->y;

        if ($age < 18) {
            echo "<script>alert('Devi essere maggiorenne per poterti iscrivere!');</script>";
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Formato e-mail non valido');</script>";
            exit();
        }

        if (strlen($password) < 8) {
            echo "<script>alert('La Password deve contenere almeno 8 caratteri');</script>";
            exit();
        }

        // $to = "your_email@example.com"; 
        // $subject = "New Registration";
        // $body = "Username: $username\nEmail: $email\nDate of Birth: $birthdate\nPassword: $password";

       
        // if (mail($to, $subject, $body)) {
        //     echo "<script>alert('Registrazione Avvenuta con successo!');</script>";
        // } else {
        //     echo "<script>alert('!!!ATTENZIONE!!! Registrazione non riuscita!!!');</script>";
        // }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <?php
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "<h2>Dati inseriti:</h2>";
                echo "<p>Username: " . htmlspecialchars($username) . "</p>";
                echo "<p>Email: " . htmlspecialchars($email) . "</p>";
                echo "<p>Data di nascita: " . htmlspecialchars($birthdate) . "</p>";
                
            }
        ?>
        <h2>Registrazione Utente</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Please enter a valid email address" required>
            <input type="date" name="birthdate" max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" required>
            <input type="password" name="password" placeholder="Password" minlength="8" required>
            <button type="submit">Registrati</button>
        </form>
    </div>
</body>
</html>



