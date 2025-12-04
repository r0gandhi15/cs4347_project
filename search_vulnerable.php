<?php
$conn = new mysqli("localhost", "root", "", "library");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_GET['email'];

$query = "SELECT * FROM Member WHERE email = '$email'";

echo "<h3>Executed SQL Query:</h3><pre>$query</pre>";

$result = $conn->query($query);

echo "<h3>Results:</h3>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row['card_no'] . " - " . $row['fname'] . " " . $row['lname'] . "<br>";
    }
} else {
    echo "No results found.";
}

$conn->close();
?>
