<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discrete Math Study Quiz</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --background-color: #ecf0f1;
            --text-color: #333;
            --card-background: #ffffff;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--background-color);
            line-height: 1.6;
            color: var(--text-color);
            padding: 20px;
        }
        .welcome-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(44, 62, 80, 0.95);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            z-index: 1000;
        }
        .welcome-text {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            line-height: 1.6;
        }
        .enter-btn {
            padding: 15px 30px;
            font-size: 18px;
            background: #3498db;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background 0.3s;
        }
        .enter-btn:hover {
            background: #2980b9;
        }
        .quiz-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: var(--card-background);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .quiz-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .quiz-controls {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .btn {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .question-card {
            position: relative;
            background-color: #f9f9f9;
            border-left: 4px solid var(--secondary-color);
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 0 5px 5px 0;
        }
        .pdf-link {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            background: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 3px;
            font-size: 12px;
            transition: background 0.3s;
        }
        .pdf-link:hover {
            background: #c0392b;
        }
        .question-topic {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 10px;
            padding-right: 80px;
        }
        .solution {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background-color: #e8f4f8;
            border-radius: 5px;
        }
        .solution-toggle {
            color: var(--secondary-color);
            cursor: pointer;
            user-select: none;
            font-weight: bold;
        }
        #score-display {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
class DiscreteQuizGenerator {
    private $topics = [
        'Set Theory' => [
            'pdf' => 'ch01.pdf',
            'questions' => [
                [
                    'text' => "Given A = {1, 2, 3} and B = {3, 4, 5}, find A ∩ B",
                    'solution' => "A ∩ B = {3}"
                ],
                [
                    'text' => "Convert the set {x | x ∈ ℕ, x < 5} to roster notation",
                    'solution' => "{0, 1, 2, 3, 4}"
                ]
            ]
        ],
        'Combinatorics' => [
            'pdf' => 'ch02.pdf',
            'questions' => [
                [
                    'text' => "How many ways can 4 people be arranged in a line?",
                    'solution' => "4! = 24 permutations"
                ],
                [
                    'text' => "From 10 people, how many 3-person committees can be formed?",
                    'solution' => "C(10,3) = 10! / (3! * 7!) = 120 combinations"
                ]
            ]
        ],
        'Mathematical Logic' => [
            'pdf' => 'ch03.pdf',
            'questions' => [
                [
                    'text' => "Create a truth table for p → q",
                    'solution' => "Shows all 4 possible truth value combinations for implication"
                ],
                [
                    'text' => "Simplify the logical expression: ¬(p ∧ q)",
                    'solution' => "Equivalent to (¬p) ∨ (¬q) by De Morgan's law"
                ]
            ]
        ]
    ];

    public function generateQuiz($numQuestions = 5) {
        $quiz = [];
        $allQuestions = [];

        foreach ($this->topics as $topicName => $topicData) {
            foreach ($topicData['questions'] as $question) {
                $allQuestions[] = [
                    'topic' => $topicName,
                    'pdf' => $topicData['pdf'],
                    'text' => $question['text'],
                    'solution' => $question['solution']
                ];
            }
        }

        shuffle($allQuestions);
        return array_slice($allQuestions, 0, $numQuestions);
    }
}

$generator = new DiscreteQuizGenerator();
$questions = $generator->generateQuiz(5);
?>

<div id="welcome" class="welcome-screen">
    <div class="welcome-text">
        Hello, I am Eliana<br>
        Your AI assistant here to help you with Discrete Math
    </div>
    <button class="enter-btn" onclick="document.getElementById('welcome').style.display='none'">Enter Website</button>
</div>

<div class="quiz-container">
    <div class="quiz-header">
        <h1>Discrete Mathematics Study Quiz</h1>
    </div>

    <div class="quiz-controls">
        <button class="btn" onclick="window.location.reload()">New Quiz</button>
    </div>

    <?php foreach ($questions as $index => $question): ?>
        <div class="question-card">
            <a href="<?php echo htmlspecialchars($question['pdf']); ?>" class="pdf-link" target="_blank">Topic PDF</a>
            <div class="question-topic"><?php echo htmlspecialchars($question['topic']); ?></div>
            <div><?php echo ($index + 1) . '. ' . htmlspecialchars($question['text']); ?></div>
            <div class="solution-toggle" onclick="toggleSolution(this)">[Show Solution]</div>
            <div class="solution"><?php echo htmlspecialchars($question['solution']); ?></div>
        </div>
    <?php endforeach; ?>

    <div id="score-display"></div>
</div>

<script>
function toggleSolution(element) {
    const solution = element.nextElementSibling;
    solution.style.display = solution.style.display === 'block' ? 'none' : 'block';
    element.textContent = solution.style.display === 'block' 
        ? '[Hide Solution]' 
        : '[Show Solution]';
}

document.addEventListener('DOMContentLoaded', () => {
    const solutionsViewed = localStorage.getItem('solutionsViewed') || 0;
    const scoreDisplay = document.getElementById('score-display');
    
    const solutionToggles = document.querySelectorAll('.solution-toggle');
    solutionToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            localStorage.setItem('solutionsViewed', parseInt(solutionsViewed) + 1);
        });
    });

    scoreDisplay.textContent = `Study Streak: Solutions Viewed ${solutionsViewed} times`;
});
</script>
</body>
</html>