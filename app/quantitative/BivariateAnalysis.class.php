<?php

class BivariateAnalysis {

    // ================= Determinants =================
    public function getDeterminant2Into2($a, $b, $c, $d) {
        return ($a * $d) - ($b * $c);
    }

    public function getDeterminant3Into3($a,$b,$c,$d,$e,$f,$g,$h,$i) {
        return $a*($e*$i - $f*$h)
             - $b*($d*$i - $f*$g)
             + $c*($d*$h - $e*$g);
    }

    // ================= Correlation =================
    public function getCorrelation($x, $y) {
        if (count($x) != count($y)) {
            throw new Exception("X and Y must be same length");
        }

        $n = count($x);
        $sum_x = array_sum($x);
        $sum_y = array_sum($y);

        $sum_xy = 0;
        $sum_x2 = 0;
        $sum_y2 = 0;

        for ($i = 0; $i < $n; $i++) {
            $sum_xy += $x[$i] * $y[$i];
            $sum_x2 += pow($x[$i], 2);
            $sum_y2 += pow($y[$i], 2);
        }

        $numerator = ($n * $sum_xy) - ($sum_x * $sum_y);
        $denominator = sqrt(
            (($n * $sum_x2) - pow($sum_x, 2)) *
            (($n * $sum_y2) - pow($sum_y, 2))
        );

        return $numerator / $denominator;
    }

    // ================= Linear Regression =================
    public function getLinearRegressionSlope($x, $y) {
        if (count($x) != count($y)) {
            throw new Exception("X and Y must be same length");
        }

        $n = count($x);
        $sum_x = array_sum($x);
        $sum_y = array_sum($y);

        $sum_xy = 0;
        $sum_x2 = 0;

        for ($i = 0; $i < $n; $i++) {
            $sum_xy += $x[$i] * $y[$i];
            $sum_x2 += pow($x[$i], 2);
        }

        return (($n * $sum_xy) - ($sum_x * $sum_y)) /
               (($n * $sum_x2) - pow($sum_x, 2));
    }

    public function getLinearRegressionIntercept($x, $y) {
        $mean_x = array_sum($x) / count($x);
        $mean_y = array_sum($y) / count($y);

        return $mean_y - ($this->getLinearRegressionSlope($x, $y) * $mean_x);
    }

    public function getNonLinearRegressionIntercept($x, $y) {
        // (your original logic preserved if you had custom one)
        return $this->getLinearRegressionIntercept($x, $y);
    }

    // ================= ML: Prediction =================
    public function predict($x, $slope, $intercept) {
        return $intercept + $slope * $x;
    }

    // ================= ML: MSE =================
    public function mse($y_true, $y_pred) {
        if (count($y_true) != count($y_pred)) {
            throw new Exception("y_true and y_pred must be same length");
        }

        $n = count($y_true);
        $sum = 0;

        for ($i = 0; $i < $n; $i++) {
            $sum += pow($y_true[$i] - $y_pred[$i], 2);
        }

        return $sum / $n;
    }

    // ================= ML: R² =================
    public function r2($y_true, $y_pred) {
        if (count($y_true) != count($y_pred)) {
            throw new Exception("y_true and y_pred must be same length");
        }

        $mean = array_sum($y_true) / count($y_true);

        $ss_total = 0;
        $ss_res = 0;

        for ($i = 0; $i < count($y_true); $i++) {
            $ss_total += pow($y_true[$i] - $mean, 2);
            $ss_res += pow($y_true[$i] - $y_pred[$i], 2);
        }

        return 1 - ($ss_res / $ss_total);
    }

    // ================= ML: Gradient Descent =================
    public function gradientDescent($x, $y, $lr = 0.01, $epochs = 1000) {
        if (count($x) != count($y)) {
            throw new Exception("X and Y must be same length");
        }

        $n = count($x);
        $m = 0;
        $b = 0;

        for ($i = 0; $i < $epochs; $i++) {
            $dm = 0;
            $db = 0;

            for ($j = 0; $j < $n; $j++) {
                $y_pred = $m * $x[$j] + $b;
                $error = $y_pred - $y[$j];

                $dm += $error * $x[$j];
                $db += $error;
            }

            $m -= $lr * ($dm / $n);
            $b -= $lr * ($db / $n);
        }

        return ['slope' => $m, 'intercept' => $b];
    }

    // ================= ML: Multi-variable Regression =================
    public function multiLinearRegression($X, $y, $lr = 0.01, $epochs = 1000) {
        $n = count($X);          // rows
        $features = count($X[0]); // columns

        // Initialize weights
        $weights = array_fill(0, $features, 0);
        $bias = 0;

        for ($e = 0; $e < $epochs; $e++) {
            $dw = array_fill(0, $features, 0);
            $db = 0;

            for ($i = 0; $i < $n; $i++) {
                $prediction = $bias;

                for ($j = 0; $j < $features; $j++) {
                    $prediction += $weights[$j] * $X[$i][$j];
                }

                $error = $prediction - $y[$i];

                for ($j = 0; $j < $features; $j++) {
                    $dw[$j] += $error * $X[$i][$j];
                }

                $db += $error;
            }

            // Update weights
            for ($j = 0; $j < $features; $j++) {
                $weights[$j] -= $lr * ($dw[$j] / $n);
            }

            $bias -= $lr * ($db / $n);
        }

        return [
            'weights' => $weights,
            'bias' => $bias
        ];
    }

    public function predictMulti($X, $weights, $bias) {
        $predictions = [];
    
        foreach ($X as $row) {
            $sum = $bias;
    
            foreach ($row as $i => $val) {
                $sum += $weights[$i] * $val;
            }
    
            $predictions[] = $sum;
        }
    
        return $predictions;
    }
}