<?php

class CentralTendency {

    public function mean($data) {
        return array_sum($data) / count($data);
    }

    public function median($data) {
        sort($data);
        $n = count($data);

        if ($n % 2 == 0) {
            return ($data[$n/2 - 1] + $data[$n/2]) / 2;
        } else {
            return $data[floor($n/2)];
        }
    }

    public function mode($data) {
        $counts = array_count_values($data);
        arsort($counts);
        return array_key_first($counts);
    }

    public function standardDeviation($data) {
        $mean = $this->mean($data);
        $sum = 0;

        foreach ($data as $val) {
            $sum += pow($val - $mean, 2);
        }

        return sqrt($sum / count($data));
    }

    // ================= ML: Normalize =================
    public function normalize($data) {
        $min = min($data);
        $max = max($data);

        if ($max == $min) {
            throw new Exception("Cannot normalize constant array");
        }

        return array_map(fn($x) => ($x - $min) / ($max - $min), $data);
    }

    // ================= ML: Standardize =================
    public function standardize($data) {
        $mean = $this->mean($data);
        $sd = $this->standardDeviation($data);

        if ($sd == 0) {
            throw new Exception("Standard deviation is zero");
        }

        return array_map(fn($x) => ($x - $mean) / $sd, $data);
    }
}