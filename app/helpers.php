<?php

use App\Models\School\Entities\SchoolGroup;
use App\Models\Subject\Entities\SubjectGroup;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;
use App\Models\CoreFacade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

function importValidationException($sheetName, \Illuminate\Validation\Validator $validator = null, array $errors = null) {
    if (!$validator) {
        $validator = \Illuminate\Support\Facades\Validator::make([], []);
        foreach ($errors as $key => $error) {
            $validator->errors()->add($key, $error);
        }
    }
    $sheetName = explode("\\", $sheetName);
    $sheetName = end($sheetName);
    throw new \Illuminate\Validation\ValidationException($validator, [
        "sheet" => $sheetName,
    ]);
}

function parse_group_name(string $name) : ?array {
    $groups = parse_group_names($name);
    if (!$groups || !isset($groups[0])) return null;
    return $groups[0];
}

function parse_group_names(string $names) : ?array {
    $numbers = parse_numbers($names);
    $digit = count($numbers) > 0 ? $numbers[0] : null;
    $letters = convert_group_name(trim(str_replace($digit, "", $names)));
    $digit = (int)$digit;
    if ($digit < 1) return null;
    preg_match_all('/[A-Za-zŽÄŇÖÜÇÝŞžäňöüçýş]/u', $letters, $letters);
    $letters = @$letters[0];
    if (!is_array($letters) || is_array($letters) && count($letters) < 1) return null;
    $letters = array_unique($letters);
    $groups = [];
    foreach ($letters as  $letter) {
        $groups[] = [
            $digit, $letter
        ];
    }
    return $groups;
}

function parse_numbers(string $txt, array $addChars = []) : array {
    $numbers = null;
    $addChars = implode("",$addChars);
    preg_match_all('/[\d'.$addChars.']+/', $txt, $numbers);
    $numbers = @$numbers[0];
    return $numbers ?? [];
}

function convert_group_name(string $letters) : string {
    return str_replace([
        'CC',
        'C',
        'AA',
    ], [
        'Ç',
        'Ç',
        'Ä',
    ], \Illuminate\Support\Str::upper($letters));
}

function makePassword($length = 20) {
    $str = "";
    $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $str .= $characters[mt_rand(0, $max)];
    }
    return $str;
}

function priceFormatValue(float $price): int
{
    return (int)round($price*100);
}

function getPaginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
