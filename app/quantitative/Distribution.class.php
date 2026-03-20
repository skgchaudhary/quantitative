<?php

class Distribution {

    public function randomUniform($min, $max, $count) {
        $data = [];

        for ($i = 0; $i < $count; $i++) {
            $data[] = $min + lcg_value() * ($max - $min);
        }

        return $data;
    }

    public function randomNormal($mean, $sd, $count) {
        $data = [];

        for ($i = 0; $i < $count; $i++) {
            $u1 = lcg_value();
            $u2 = lcg_value();

            $z = sqrt(-2 * log($u1)) * cos(2 * pi() * $u2);
            $data[] = $mean + $sd * $z;
        }

        return $data;
    }

    // ================= ML: Train/Test Split =================
    public function trainTestSplit($data, $ratio = 0.8) {
        if ($ratio <= 0 || $ratio >= 1) {
            throw new Exception("Ratio must be between 0 and 1");
        }

        shuffle($data);
        $split = intval(count($data) * $ratio);

        return [
            'train' => array_slice($data, 0, $split),
            'test' => array_slice($data, $split)
        ];
    }
}