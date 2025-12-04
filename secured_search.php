<?php
$conn = new mysqli("localhost", "root", "", "library");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_GET['email'];

//preventing SQL injection
$stmt = $conn->prepare("SELECT card_no, fname, lname FROM Member WHERE email = ?");
$stmt->bind_param("s", $email);

//SQL template
echo "<h3>Prepared SQL Query:</h3><pre>SELECT card_no, fname, lname FROM Member WHERE email = ?</pre>";

$stmt->execute();
$result = $stmt->get_result();

echo "<h3>Results:</h3>";

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row['card_no'] . " - " . $row['fname'] . " " . $row['lname'] . "<br>";
    }
} else {
    echo "No results found.";
}

$stmt->close();
$conn->close();
?>
