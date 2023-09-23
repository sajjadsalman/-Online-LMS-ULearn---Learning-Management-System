<?php
// function parseContent($content) {
// 	$output = array();
// 	$pattern = '/{subchap}([\s\S.]*?){\/subchap}/';
// 	preg_match_all($pattern, $content, $subtopics);
// 	if($subtopics[1]) {
function parseContent($content) {
	$output = array();

	// Find all subtopics
	$subtopicPattern = '/{subchap}([\s\S.]*?){\/subchap}/';
	preg_match_all($subtopicPattern, $content, $subtopics);

	// Parse each subtopic
	if ($subtopics[1]) {
		$notePattern = '/({heading}([\s\S.]*?){\/heading})(?:[\s\S.]*?)({notes}([\s\S.]*?){\/notes})/';
		preg_match_all($notePattern, $content, $matches);
		if ($matches[2] && $matches[4]) {
			$headers = $matches[2];
			$notes = $matches[4];
			for ($i = 0; $i < count($headers); $i++) {
				$append = array();
				$append['heading'] = $headers[$i];
				$content = $notes[$i];

				// Extract all content blocks
				$contentPattern = '/{content}([\s\S.]*?){\/content}/';
				preg_match_all($contentPattern, $content, $matches);
				if ($matches[1]) {
					$append['content'] = $matches[1];
				}
				array_push($output, $append);
			}
		}
	}

	return $output;
}


/**
 * Parses a quiz content string and returns an array of questions
 *
 * @param string $quizContent The quiz content string to parse
 *
 * @return array An array of MCQ arrays with 'form', 'question', 'answer', and 'choices' keys
 */
function parseQuiz($quizContent) {
	$output = array();

	// Find all MCQ blocks
	$questionPattern = '/{MCQ}([\s\S.]*?){\/MCQ}/';
	preg_match_all($questionPattern, $quizContent, $questions);
	$questions = $questions[1];

	// Parse each MCQ block
	if ($questions) {
		foreach ($questions as $MCQ) {
			$questionData = array();

			// Extract MCQ form and question
			$pattern = '/({form}([\s\S.]*?){\/form})(?:[\s\S]*?)({question}([\s\S.]*?){\/question})([\s\S.]*)/';
			preg_match($pattern, $MCQ, $matches);
			$questionData['form'] = $matches[2];
			$questionData['question'] = $matches[4];
			$rest = $matches[5];

			// Extract answer and choices, if present
			if ($rest) {
				$pattern = '/([\s\S]*?)({answer}([\s\S.]*?){\/answer})/';
				preg_match($pattern, $rest, $matches);
				$questionData['answer'] = $matches[3];
				$choices = $matches[1];

				// Parse choices, if present
				if ($choices) {
					$choicePattern = '/{choice}([\s\S.]*?){\/choice}/';
					preg_match_all($choicePattern, $choices, $matches);
					$choiceData = $matches[1];
					$choiceArray = array();
					foreach ($choiceData as $choice) {
						array_push($choiceArray, $choice);
					}
					$questionData['choices'] = $choiceArray;
				}
			}

			array_push($output, $questionData);
		}
	}

	return $output;
}

