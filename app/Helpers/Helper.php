<?php

namespace App\Helpers;

class Helper
{
    public static function slugify(string $string)
    {
        $string = preg_replace('/[\t\n]/', ' ', $string);
        $string = preg_replace('/\s{2,}/', ' ', $string);
        $list = array(
            'Š' => 'S',
            'š' => 's',
            'Đ' => 'Dj',
            'đ' => 'dj',
            'Ž' => 'Z',
            'ž' => 'z',
            'Č' => 'C',
            'č' => 'c',
            'Ć' => 'C',
            'ć' => 'c',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ý' => 'y',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y',
            'Ŕ' => 'R',
            'ŕ' => 'r',
            '/' => '-',
            ' ' => '-',
            '.' => '-',
        );

        $string = strtr($string, $list);
        $string = preg_replace('/-{2,}/', '-', $string);
        $string = strtolower($string);

        return $string;
    }

    public static function gerarFilhos($page, $slug, $rec = false)
    {
        $memento = !$rec ? $page["fathers"] : $page;


        $print = '<div class="ml-3">';

        foreach($memento as $items) {
            $tes[] = $memento;
            if(!$rec) {
                $print .= '<a href="' . route('auth.pages', [$slug, $items["father"]["slug"]]) .'" class="badge badge-primary">--> ' . $items["father"]["title"] . '</a><br>';
                $sons = $items["father"]["childrens"];

            } else {
                $print .= '<a href="' . route('auth.pages', [$slug, $items["slug"]]) .'" class="badge badge-primary">--> ' . $items["title"] . '</a><br>';
                $sons = $items["childrens"];
                $tes[] = $items;
            }

            if(!empty($sons)) {
                $print .= self::gerarFilhos($sons, $slug, true);
            }
        }

        $print .= '</div>';

        if(!$rec) {
            echo $print;
        } else {
            return $print;
        }


    }
}