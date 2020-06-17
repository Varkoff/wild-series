<?php


namespace App\Service;

class Slugify
{
    public function generate(string $input): string
    {
       $modifiedInput = strtolower(preg_replace("/[^a-zA-Z-]/", " ", $input));
        $lastInput = str_replace(' ', '-', $modifiedInput);

        while (preg_match("/[-]{2}+/",  $lastInput)){
            $lastInput = str_replace("--", "-", $lastInput);
        }
        return $lastInput;
    }
}
