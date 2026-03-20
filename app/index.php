<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/quantitative/autoload.php';

$ba = new BivariateAnalysis();
$ct = new CentralTendency();
$d  = new Distribution();

// ================= CENTRAL TENDENCY DATA =================
$data = [32, 111, 138, 28, 59, 77, 97];
$normalizedData = $ct->normalize($data);
$standardizedData = $ct->standardize($data);

// ================= DISTRIBUTION DATA =================
$normal = $d->randomNormal(5, 1, 10);
$uniform = $d->randomUniform(0, 5, 10);
$splitDemo = $d->trainTestSplit($data, 0.7);

// ================= BIVARIATE DATA =================
$x = [1, 6, 11, 16, 20, 26];
$y = [13, 16, 17, 23, 24, 31];

$a = $ba->getLinearRegressionIntercept($x, $y);
$b = $ba->getLinearRegressionSlope($x, $y);
$x_new = 10;
$y_pred_single = $ba->predict($x_new, $b, $a);

// predictions for whole x set
$y_pred_all = [];
foreach ($x as $val) {
    $y_pred_all[] = $ba->predict($val, $b, $a);
}

$mseScore = $ba->mse($y, $y_pred_all);
$r2Score  = $ba->r2($y, $y_pred_all);

// ================= ML DEMO: TRAIN & PREDICT =================
// Simple multi-variable training demo
$X_train_demo = [
    [1, 2],
    [2, 3],
    [3, 4],
    [4, 5],
    [5, 6]
];
$y_train_demo = [8, 11, 14, 17, 20];

// Train model using multi-variable regression
$model = $ba->multiLinearRegression($X_train_demo, $y_train_demo, 0.01, 5000);

// Predict using trained model
$X_predict_demo = [
    [6, 7],
    [7, 8],
    [8, 9]
];
$predictedMulti = $ba->predictMulti($X_predict_demo, $model['weights'], $model['bias']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quantitative Library - Demo & Docs</title>
    <style>
        body {
            background-color: #0f172a;
            color: #e2e8f0;
            font-family: Arial, sans-serif;
            padding: 20px;
            line-height: 1.6;
        }
        h1, h2 {
            color: #38bdf8;
        }
        h3 {
            color: #7dd3fc;
            margin-top: 18px;
        }
        .section {
            margin-bottom: 30px;
            padding: 18px;
            background: #1e293b;
            border-radius: 10px;
        }
        code, pre {
            background: #020617;
            padding: 8px;
            border-radius: 5px;
            display: block;
            margin: 10px 0;
            white-space: pre-wrap;
            word-wrap: break-word;
            color: #cbd5e1;
        }
        .result {
            color: #22c55e;
        }
        .note {
            color: #fbbf24;
        }
    </style>
</head>
<body>

<h1>📊 PHP Quantitative Library</h1>
<p>Demo + documentation for statistics, regression, and machine learning helper methods.</p>

<div class="section">
    <h2>📈 Central Tendency</h2>

    <b>Input:</b>
    <pre><?php print_r($data); ?></pre>

    <b>Usage:</b>
    <code>
$ct = new CentralTendency();
$ct->mean($data);
$ct->median($data);
$ct->mode($data);
$ct->standardDeviation($data);
$ct->normalize($data);
$ct->standardize($data);
    </code>

    <b>Output:</b>
    <div class="result">
        Mean: <?= $ct->mean($data) ?><br>
        Median: <?= $ct->median($data) ?><br>
        Mode: <?= $ct->mode($data) ?><br>
        Standard Deviation: <?= $ct->standardDeviation($data) ?><br><br>

        Normalized Data:
        <pre><?php print_r($normalizedData); ?></pre>

        Standardized Data:
        <pre><?php print_r($standardizedData); ?></pre>
    </div>
</div>

<div class="section">
    <h2>🎲 Distribution</h2>

    <b>Usage:</b>
    <code>
$d = new Distribution();
$d->randomNormal(mean, sd, count);
$d->randomUniform(min, max, count);
$d->trainTestSplit($data, ratio);
    </code>

    <b>Output:</b>
    <div class="result">
        Random Normal:
        <pre><?php print_r($normal); ?></pre>
        Mean(Random Normal): <?= $ct->mean($normal) ?><br><br>

        Random Uniform:
        <pre><?php print_r($uniform); ?></pre>
        Mean(Random Uniform): <?= $ct->mean($uniform) ?><br><br>

        Train/Test Split (70/30):
        <pre><?php print_r($splitDemo); ?></pre>
    </div>
</div>

<div class="section">
    <h2>📉 Bivariate Analysis</h2>

    <b>Input:</b>
    <pre><?php echo "X: "; print_r($x); echo "\nY: "; print_r($y); ?></pre>

    <b>Usage:</b>
    <code>
$ba = new BivariateAnalysis();
$ba->getCorrelation($x, $y);
$ba->getLinearRegressionSlope($x, $y);
$ba->getLinearRegressionIntercept($x, $y);
$ba->getNonLinearRegressionIntercept($x, $y);
$ba->predict($xValue, $slope, $intercept);
$ba->mse($yTrue, $yPred);
$ba->r2($yTrue, $yPred);
    </code>

    <b>Output:</b>
    <div class="result">
        Correlation: <?= $ba->getCorrelation($x, $y) ?><br>
        Slope (b): <?= $b ?><br>
        Intercept (a): <?= $a ?><br>
        Non-Linear Intercept: <?= $ba->getNonLinearRegressionIntercept($x, $y) ?><br><br>

        Regression Equation:<br>
        Y = <?= $a ?> + <?= $b ?>X<br><br>

        Prediction for X = <?= $x_new ?> → Y = <?= $y_pred_single ?><br><br>

        Predictions for full X:
        <pre><?php print_r($y_pred_all); ?></pre>

        MSE: <?= $mseScore ?><br>
        R² Score: <?= $r2Score ?><br>
    </div>
</div>

<div class="section">
    <h2>🧮 Determinants</h2>

    <b>Usage:</b>
    <code>
$ba->getDeterminant2Into2(a, b, c, d);
$ba->getDeterminant3Into3(a, b, c, d, e, f, g, h, i);
    </code>

    <b>Example Matrix (2x2):</b>
    <pre>| 3  -1 |
| 4  -2 |</pre>

    <b>Output:</b>
    <div class="result">
        Determinant 2x2: <?= $ba->getDeterminant2Into2(3, -1, 4, -2) ?><br><br>
        Determinant 3x3 (1..9 matrix): <?= $ba->getDeterminant3Into3(1,2,3,4,5,6,7,8,9) ?>
    </div>
</div>

<div class="section">
    <h2>🤖 Machine Learning Demo: Train & Predict</h2>

    <p class="note">
        This section demonstrates training and prediction in-memory only. Model persistence/storage is intentionally left to the developer.
    </p>

    <h3>Training Data</h3>
    <pre><?php
echo "X_train:\n";
print_r($X_train_demo);
echo "\ny_train:\n";
print_r($y_train_demo);
    ?></pre>

    <b>Usage:</b>
    <code>
$model = $ba->multiLinearRegression($X_train_demo, $y_train_demo, 0.01, 5000);

$predictions = $ba->predictMulti($X_predict_demo, $model['weights'], $model['bias']);
    </code>

    <h3>Trained Model</h3>
    <div class="result">
        Weights:
        <pre><?php print_r($model['weights']); ?></pre>

        Bias:
        <pre><?php print_r($model['bias']); ?></pre>
    </div>

    <h3>Prediction Input</h3>
    <pre><?php print_r($X_predict_demo); ?></pre>

    <h3>Predictions</h3>
    <div class="result">
        <pre><?php print_r($predictedMulti); ?></pre>
    </div>
</div>

<div class="section">
    <h2>⚠️ Error Handling Demo</h2>

    <b>Example:</b>
    <code>
$x = [1,2,3];
$y = [1,2];
$ba->getCorrelation($x, $y);
    </code>

    <b>Output:</b>
    <div class="result">
        <?php
        try {
            $ba->getCorrelation([1,2,3], [1,2]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div>
</div>

<div class="section">
    <h2>🚀 About</h2>
    <p>
        This library currently provides:
        <br>• Central Tendency (Mean, Median, Mode, Standard Deviation)
        <br>• Data Preprocessing (Normalization, Standardization)
        <br>• Random Distributions (Normal, Uniform)
        <br>• Train/Test Split
        <br>• Correlation and Regression
        <br>• Determinants
        <br>• ML Helpers (Prediction, MSE, R², Gradient Descent, Multi-variable Regression)
    </p>
</div>

</body>
</html>