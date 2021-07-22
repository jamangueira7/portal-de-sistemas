<?php

namespace App\Helpers;

use App\model\Item;
use phpDocumentor\Reflection\Element;

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
            $print .= '<ul id="stateList" class="navbar-nav">';
        }


        foreach($memento as $items) {
            if(!$rec) {

                $print .= '<li class="nav-item dropdown has-megamenu" >
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">'. $items["father"]["title"].'</a>
                <div class="dropdown-menu megamenu" role="menu" style="overflow-y: scroll; min-height: 500px; height: 100%;">
                            <div class="row g-3">';


                if(!empty($items["father"]['childrens'])) {
                    foreach($items as $firstChildrens) {
                        $print .= self::gerarFilhos($firstChildrens['childrens'], $slug, true, 0);
                    }
                } else {
                    $target = $items["father"]["new_tab"] ? 'target="_blank"' : '';

                    $print .= '<div class="col-lg-4 col-6">
                                <div class="col-megamenu">
                                <h6 class="title">' . $items["father"]["title"] . '</h6>
                                    <ul>
                                        <li>
                                            <a '. $target . ' href="' . route('auth.pages', [$page['page']['slug'], $items["father"]["slug"]]) .'">' . $items["father"]["title"] . '</a>
                                        </li>
                                    </ul>
                                </div>
                               </div>';
                }

                $print .= '</div></div></li>';

            } else {
                if($cont === 0 ) {
                    $print .= '<div class="col-lg-4 col-6">
                                    <div class="col-megamenu">
                                    <h6 class="title">'.$items['title'].'</h6>
                                        <ul>';

                    if(!empty($items["childrens"])) {
                        $print .= '<li>' . $items["title"];
                        $print .= '<ul>';
                        $print .= self::gerarFilhos($items['childrens'], $slug, true, 2);
                        $print .= '</ul></li>';

                    } else {

                        if($items['new_tab']) {
                            $print .= '<li><a target="_blank" href="' . $items["url"] .'">' . $items["title"] . '</a></li>';

                        } else {

                            $print .= '<li><a href="' . route('auth.pages', [$slug, $items["slug"]]) .'">' . $items["title"] . '</a></li>';
                        }
                    }


                    $print .= '</ul>
                            </div>  <!-- col-megamenu.// -->
                        </div><!-- end col-4 -->';
                } else {

                    if(!empty($items["childrens"])) {
                        $print .= '<li>' . $items["title"];
                        $print .= '<ul>';
                        $print .= self::gerarFilhos($items['childrens'], $slug, true, 2);
                        $print .= '</ul></li>';
                    } else {
                        if($items['new_tab']) {
                            $print .= '<li class="2"><a target="_blank" href="' . $items["url"] .'">' . $items["title"] . '</a></li>';

                        } else {
                            $print .= '<li><a class="1" href="' . route('auth.pages', [$slug, $items["slug"]]) .'">' . $items["title"] . '</a></li>';
                        }
                    }
                }
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
                   <ol class="breadcrumb p-3 pb-0 bg-light small">';
       $html .= '<li class="breadcrumb-item"><a href="' . route('auth.pages', [$page["page"]["slug"]]) .'" style="text-decoration:none" class="text-secondary">'. $page["page"]["description"] . '</a></li>';

       if(!empty($current)) {
           $html .= self::generaRising($current['title'], $current['slug'], $current['father'], $page["page"]["slug"]);
       }


       $html .= '</ol>
                </nav>';

       echo $html;
    }
}
