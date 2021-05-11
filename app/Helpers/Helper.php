<?php

namespace App\Helpers;

class Helper
{

    public static function formateDate(string $data)
    {
        $date = new \DateTime($data);
        return $date->format('d-m-Y H:i:s');
    }

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

    public static function gerarFilhos($page, $slug, $rec = false, $cont = 0)
    {
        $memento = !$rec ? $page["fathers"] : $page;
        $print = '';
        if(!$rec) {
            $print .= '<div id="menu-items" class="form-group row">
                        <span id="title-page">
                            <a class="" href="' . route('auth.pages', [$page['page']['slug']]) .'" >'. $page['page']['description'].'</a>
                        </span><br><br>';
        }

        foreach($memento as $items) {
            $tes[] = $memento;
            if(!$rec) {

                $print .= '<div class="col-3">
                        <span>
                            <a class="" href="' . route('auth.pages', [$slug, $items["father"]["slug"]]) .'" >'. $items["father"]["title"].'</a>
                        </span>
                                <ul class="">';

                $print .= '<li class="nav-item dropdown"><a href="' . route('auth.pages', [$slug, $items["father"]["slug"]]) .'" class="nav-link  dropdown-toggle" data-bs-toggle="dropdown">' . $items["father"]["title"] . '</a>';
                $sons = $items["father"]["childrens"];
                $cont = 1;

            } else {
                $print .= '<li><a href="' . route('auth.pages', [$slug, $items["slug"]]) .'" class="">' . $items["title"] . '</a></li>';
                $sons = $items["childrens"];
                $tes[] = $items;
                $cont = 2;
            }

            if(!empty($sons)) {
                if($cont <= 1) {
                    $print .= '<ul class="dropdown-menu dropdown-menu-right">';
                } else {
                    $print .= '<ul class="">';
                }
                $print .= self::gerarFilhos($sons, $slug, true, $cont++);
                $print .= '</ul>';
                $print .= '</li>';
            }

            if(!$rec) {
                $print .= '</ul></div>';
            }
        }
        if(!$rec) {
            $print .= '</div>';
        }

        if(!$rec) {
            echo $print;
        } else {
            return $print;
        }
    }
}
