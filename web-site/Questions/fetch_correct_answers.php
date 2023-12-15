<?php
include 'dbconfig.php'; // Make sure this path is correct

$response = array();

$query = "SELECT question_id, answer_id FROM correct_answers";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Storing question ID as key and answer ID as value
        $response[$row["question_id"]] = $row["answer_id"];
    }
}
$conn->close();

echo json_encode($response);
?>
