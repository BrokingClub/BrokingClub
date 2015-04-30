<?php
namespace BrokingClub\Statistics;
/**
 * Project: BrokingClub | ArrayGenerator.php
 * Author: Simon - www.triggerdesign.de
 * Date: 30.04.2015
 * Time: 22:33
 */

class ArrayGenerator {

    public function variationArray($values){
        $min = min($values);
        $max = max($values);
        $maxVariation = $max - $min;

        $variations = array();
        foreach ($values as $value) {
            if ($maxVariation == 0) {
                $variations[] = 1;
                continue;
            }

            $variation = $value - $min;

            $percent = ($variation / $maxVariation) * 100;

            $variations[] = $percent;
        }

        return $variations;
    }

    public function steppedArray($objects, $step, $attribute = false){
        $stepped = array();
        $i = 0;
        foreach ($objects as $object) {

            if ($i % $step == 0)
                $stepped[] = ($attribute) ? $object->$attribute : $object;
            $i++;
        }

        return $stepped;
    }
} 