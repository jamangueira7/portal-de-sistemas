<?php

namespace App\Helpers;

use App\model\Item;

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
            $print .= '
            <ul class="navbar-nav mx-auto">
                        <span id="title-page " class="d-none">
                            <a class="" href="' . route('auth.pages', [$page['page']['slug']]) .'" >'. $page['page']['description'].'</a>
                        </span><br><br>';
        }

        foreach($memento as $items) {
            $tes[] = $memento;
            if(!$rec) {

                $print .= '<li class="nav-item dropdown megamenu ">
                <a id="megamneu" href="' . route('auth.pages', [$slug, $items["father"]["slug"]]) .'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle font-weight-bold text-uppercase">'. $items["father"]["title"].' </a>
                  <div aria-labelledby="megamneu" class="dropdown-menu border-0 p-0 m-0">


                                <ul class="container 1 "> <li class="row bg-white"> ';

                // $print .= '<li class="nav-item dropdown"><a href="' . route('auth.pages', [$slug, $items["father"]["slug"]]) .'" class="nav-link  dropdown-toggle" data-bs-toggle="dropdown">' . $items["father"]["title"] . '</a>';
                $sons = $items["father"]["childrens"];
                $cont = 1;

            } else {
                if(!empty($items["childrens"])) {
                    $print .= '<li class="nav-item ">' . $items["title"] . '</li>';

                } else {
                    $print .= '<li class="nav-item "><a href="' . route('auth.pages', [$slug, $items["slug"]]) .'" class=" nav-link text-small pb-0">' . $items["title"] . '</a></li>';

                }
                $sons = $items["childrens"];
                $tes[] = $items;
                $cont = 2;
            }

            if(!empty($sons)) {
                if($cont <= 1) {
                    $print .= '<ul class="list-unstyled 2 col mb-4 ">';
                } else {
                    $print .= '<ul class="list-unstyled 3 pl-3">';
                }
                $print .= self::gerarFilhos($sons, $slug, true, $cont++);

                $print .= '

                        </ul>


                ';
                $print .= '';
            }


            if(!$rec) {
                $print .= '</li></ul></div> </li>
                <!-- fecha div -->';
            }
        }
        if(!$rec) {

            $print .= '</ul>';
        }

        if(!$rec) {
            echo $print;
        } else {
            return $print;
        }
    }

    public static function generaRising($title, $slug, $father, $page_slug, $rec=false)
    {
        $html = "";
        if(!empty($father)){
            $item = Item::where('id', $father)->first();
            $html .= self::generaRising($item['title'], $item['slug'], $item['father'], $item["slug"], true);
            $html .= '<li class="breadcrumb-item">'. $item['title'] . '</li>';

        }

        if(!$rec) {
            $html .= '<li class="breadcrumb-item"><a href="' . route('auth.pages', [$page_slug, $slug]) .'">'. $title . '</a></li>';
        }

        return $html;
    }

    public static function generateBreadcrumb($page, $current=null)
    {
        //dd($current);
       $html = '<nav aria-label="breadcrumb">
                   <ol class="breadcrumb p-3 pb-0 bg-light">';
       $html .= '<li class="breadcrumb-item"><a href="' . route('auth.pages', [$page["page"]["slug"]]) .'">'. $page["page"]["description"] . '</a></li>';

       if(!empty($current)) {
           $html .= self::generaRising($current['title'], $current['slug'], $current['father'], $page["page"]["slug"]);
       }


       $html .= '</ol>
                </nav>';

       echo $html;
    }
}
