<?php
header("Content-Type: application/json");

// Connect to database
$conn = new mysqli("localhost", "root", "", "library");
if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$q = isset($_GET['q']) ? "%".$_GET['q']."%" : "%";

// Prepared statement protects from SQL injection
$sql = "
    SELECT 
        Book.book_id,
        Book.title,
        Book.isbn,
        Book.genre,
        Book.publication_date,
        GROUP_CONCAT(Author.a_name SEPARATOR ', ') AS authors
    FROM Book
    LEFT JOIN Author ON Book.book_id = Author.book_id
    WHERE 
        Book.title LIKE ? OR
        Author.a_name LIKE ? OR
        Book.isbn LIKE ?
    GROUP BY Book.book_id
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $q, $q, $q);
$stmt->execute();
$result = $stmt->get_result();

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

echo json_encode($books);
