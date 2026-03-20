# Quantitative

Lightweight **statistical and machine learning formula library for PHP**.

No engines. No abstractions. No dependencies.
Just **pre-written formulas** you can use directly in your backend.

---

## 🚀 Why Quantitative?

Most ML libraries are:

* Complex
* Heavy
* Require pipelines, training loops, or external tools

**Quantitative is different.**

> 🔥 It gives you ready-to-use formulas — like Excel, but in PHP.

---

## ✨ Features

* 📊 Central Tendency

  * Mean
  * Standard Deviation

* 📈 Regression

  * Linear Regression (slope & intercept)
  * Prediction

* 🔢 Matrix Operations

  * Determinant (2x2, 3x3)

* 📦 Data Utilities

  * Train/Test Split

---

## ⚡ Installation

Just copy the files into your project.

Or via Composer (optional):

```bash
composer require suneet/quantitative
```

---

## 🧠 Usage

### 1. Linear Regression

```php
$x = [1, 2, 3, 4];
$y = [2, 4, 6, 8];

list($m, $b) = Regression::linear($x, $y);

echo Regression::predict(5, $m, $b); // Output: 10
```

---

### 2. Mean & Standard Deviation

```php
$data = [10, 20, 30, 40];

echo Stats::mean($data);
echo Stats::std($data);
```

---

### 3. Matrix Determinant

```php
$matrix = [
    [1, 2],
    [3, 4]
];

echo Matrix::determinant2x2($matrix);
```

---

### 4. Train Test Split

```php
list($xTrain, $xTest, $yTrain, $yTest) =
    Distribution::trainTestSplit($X, $y, 0.8);
```

---

## 🧩 Philosophy

Quantitative is built on one simple idea:

> ❌ No ML engine
> ❌ No over-engineering
> ✅ Just formulas

It is designed for:

* Backend developers
* PHP APIs
* Quick analytics
* Lightweight ML use cases

---

## 🧠 Analogy

> 🧩 Quantitative = Excel formulas for PHP

---

## 📌 Use Cases

* Cost prediction
* Shipment analytics
* Backend data processing
* Simple ML without Python

---

## ⚠️ Limitations

* Not a full ML framework
* No neural networks
* No automatic training pipelines

---

## 🚀 Roadmap

* Correlation functions
* More regression models
* Classification (simple formulas)
* Additional matrix operations

---

## 🤝 Contributing

Feel free to open issues or submit pull requests.

---

## 📄 License

MIT

---

## 👨‍💻 Author

Built by Suneet C.
