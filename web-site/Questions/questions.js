$(document).ready(function() {
  loadQuestion(1); // Load the first question on page load

  $('#next-button').click(function() {
    saveAnswer(); // Call saveAnswer when the next button is clicked
});
});
function saveAnswer() {
  var selectedAnswer = $('input[name="answer"]:checked').val();
  if (!selectedAnswer) {
      alert("Wybierz odpowiedż.");
      return;
  }

  // Save the answer to localStorage
  var currentQuestionNumber = $('#current-question-number').text();
  localStorage.setItem('answer' + currentQuestionNumber, selectedAnswer);

  // Prepare for the next question
  var nextQuestionNumber = parseInt(currentQuestionNumber) + 1;
  $('#current-question-number').text(nextQuestionNumber); // Update the hidden question number
  var totalQuestions = 10; // Total number of questions in the quiz
  if (nextQuestionNumber > totalQuestions) {
      window.location.href = 'results.html'; // Redirect to results page
  } else {
      loadQuestion(nextQuestionNumber);
  }
}
var fetchQuestionUrl = 'fetch_question.php';
var fetchCorrectAnswersUrl = 'fetch_correct_answers.php';
function loadQuestion(questionNumber) {
  $.ajax({
      url: fetchQuestionUrl, // Updated URL
      type: 'GET',
      data: { questionNumber: questionNumber },
      success: function(response) {
          $('#question-container').html(response);
      }
  });
}
var totalQuestions=10;

function showResults() {
  // Fetch correct answers from the database
  $.ajax({
      url: 'fetch_correct_answers.php', // URL to your PHP script
      type: 'GET',
      dataType: 'json',
      success: function(correctAnswers) {
          var score = 0;
          for (var i = 1; i <= totalQuestions; i++) {
              var userAnswer = localStorage.getItem('answer' + i);
              // Assuming correctAnswers is an object with question_id as key and answer_id as value
              var correctAnswer = correctAnswers[i];

              if (userAnswer === correctAnswer) {
                  score++;
              }
          }
          $('#result').html('Uzyskałeś ' + score + ' z ' + totalQuestions);
      }
  });
}

