<?php
include 'dbconfig.php';

$questionNumber = isset($_GET['questionNumber']) ? $_GET['questionNumber'] : 1;

$query = "SELECT * FROM questions WHERE question_num = $questionNumber";
$result = $conn->query($query);

if ($row = $result->fetch_assoc()) {
    echo '<div class="question-container">';
    echo '<h1 class="question-number">Pytanie ' . $row["question_num"] . '</h1>';
    echo '<form id="questionForm">';
    echo '<h2 class="question">' . $row["question_text"] . '</h2>';
    echo '<div class="answers">';

    // Fetch answers for this question
    $answers_query = "SELECT * FROM answers WHERE question_id = " . $row["question_id"];
    $answers_result = $conn->query($answers_query);

    while ($answer = $answers_result->fetch_assoc()) {
        echo '<label class="answer"><input type="radio" name="answer" value="' . $answer["answer_id"] . '" /> ' . $answer["answer_text"] . '</label>';
    }

    echo '</div>';
    echo '<button type="button" onclick="saveAnswer()">Next</button>';
    echo '</form></div>';
}

$conn->close();
?>
