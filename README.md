# 📊 Quantitative – PHP Statistical & ML Formula Library

A lightweight PHP library providing **statistics, regression, and machine learning helper methods** using **pre-written mathematical formulas**.

> 🔥 No heavy frameworks. No dependencies. Just formulas.

---

## 🚀 Features

* 📈 Central Tendency (Mean, Median, Mode, Standard Deviation)
* ⚙️ Data Preprocessing (Normalization, Standardization)
* 🎲 Random Distributions (Normal, Uniform)
* 🔀 Train/Test Split
* 📉 Correlation & Regression
* 🧮 Determinants (2x2, 3x3)
* 🤖 Machine Learning Helpers (Prediction, MSE, R², Gradient Descent)

---

# 📈 Central Tendency

### Input

```php
$data = [32, 111, 138, 28, 59, 77, 97];
```

### Usage

```php
$ct = new CentralTendency();

$ct->mean($data);
$ct->median($data);
$ct->mode($data);
$ct->standardDeviation($data);
$ct->normalize($data);
$ct->standardize($data);
```

### Output

* Mean: **77.43**
* Median: **77**
* Mode: **32**
* Std Dev: **37.84**

---

# 🎲 Distribution

### Usage

```php
$d = new Distribution();

$d->randomNormal($mean, $sd, $count);
$d->randomUniform($min, $max, $count);
$d->trainTestSplit($data, 0.7);
```

### Output Highlights

* Random Normal Mean ≈ **4.97**
* Random Uniform Mean ≈ **2.79**
* Train/Test split works correctly (70/30)

---

# 📉 Bivariate Analysis

### Input

```php
$x = [1,6,11,16,20,26];
$y = [13,16,17,23,24,31];
```

### Usage

```php
$ba = new BivariateAnalysis();

$ba->getCorrelation($x, $y);
$ba->getLinearRegressionSlope($x, $y);
$ba->getLinearRegressionIntercept($x, $y);
$ba->predict(10, $slope, $intercept);
$ba->mse($yTrue, $yPred);
$ba->r2($yTrue, $yPred);
```

### Output

* Correlation: **0.978** (strong positive)
* Regression:

  ```
  Y = 11.32 + 0.70X
  ```
* Prediction (X=10): **18.33**
* MSE: **1.57**
* R²: **0.956**

---

# 🧮 Determinants

### Usage

```php
$ba->getDeterminant2Into2(3, -1, 4, -2);
$ba->getDeterminant3Into3(1,2,3,4,5,6,7,8,9);
```

### Output

* Determinant 2x2: **-2**
* Determinant 3x3: **0**

---

# 🤖 Machine Learning Demo (Formula-Based)

> This demonstrates ML using **pure gradient descent formulas**.

### Training

```php
$model = $ba->multiLinearRegression($X_train, $y_train, 0.01, 5000);
```

### Model Output

* Weights: `[0.33, 2.66]`
* Bias: `2.33`

---

### Prediction

```php
$predictions = $ba->predictMulti($X_predict, $model['weights'], $model['bias']);
```

### Output

* Predictions: `[23, 26, 29]` (approx)

---

# ⚠️ Error Handling

```php
$x = [1,2,3];
$y = [1,2];

$ba->getCorrelation($x, $y);
```

Output:

```
Error: X and Y must be same length
```

---

# 🧠 Mathematical Validity

All methods are based on **standard, verified formulas**:

### ✔️ Statistics

* Mean, Median, Mode → textbook definitions
* Standard Deviation → population formula

### ✔️ Regression

* Slope:

  ```
  b = (nΣxy - ΣxΣy) / (nΣx² - (Σx)²)
  ```
* Intercept:

  ```
  a = (Σy - bΣx) / n
  ```

### ✔️ Machine Learning

* Gradient Descent:

  ```
  w = w - α * ∂Loss/∂w
  b = b - α * ∂Loss*
  ```
