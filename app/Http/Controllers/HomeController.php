<?php

namespace App\Http\Controllers;

use App\Models\Building;
use DiDom\Document;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

//        $string = '1 689 $';
//
//        $numericString = preg_replace('/[^\d]/', '', $string);
//
//
//        dd(intval($numericString));
//
//
//        $numberPrice = is_numeric($numericString) ? (int)$numericString : 0;
//
//        dd($numberPrice);


        $region = 'vin';
        $price = 5001;

        $page = 1;


        $url = 'https://www.olx.ua/uk/nedvizhimost/doma/prodazha-domov/' . $region . '/?currency=USD&page=' . $page . '&search%5Bfilter_float_price:to%5D=' . $price;

//        https://www.olx.ua/uk/nedvizhimost/doma/prodazha-domov/vin/?currency=USD&page=1&search%5Bfilter_float_price:to%5D=5001


//        https://www.olx.ua/uk/nedvizhimost/doma/prodazha-domov/vin/?currency=USD&search%5Bfilter_float_price%3Ato%5D=5001

        $document = new Document($url, true);

        //->find('span')->text()

//        dd($document->find('.css-7ddzao')[0]->find('span')[0]->text());
        // page pagination start

        $paginationList = $document->find('.pagination-item');

        if ($paginationList) {

            $countPages = end($paginationList)->find('a')[0]->text();
//            $countPages = 1;

            for ($i = 1; $i <= $countPages; $i++) {

                $url = 'https://www.olx.ua/uk/nedvizhimost/doma/prodazha-domov/' . $region . '/?currency=USD&page=' . $i . '&search%5Bfilter_float_price:to%5D=' . $price;

                $document = new Document($url, true);

                $ads = $document->find('.css-l9drzq');

                foreach ($ads as $ad) {


                    $a_url = ' https://www.olx.ua' . $ad->find('.css-z3gu2d')[0]->attr('href');
                    $h6_title = $ad->find('.css-1wxaaza')[0]->text();
                    $p_price = $ad->find('.css-13afqrm')[0]->text(); // "3 800 $"

                    $p_location = $ad->find('.css-1mwdrlh')[0]->text();
                    $array_loc = explode(' - ', $p_location);
                    $norn_loc = $array_loc[0];

                    $numericArray = explode(' $', $p_price);
                    $numericString = preg_replace('/[^\d]/', '', $numericArray[0]);
                    $price = intval($numericString);


                    $building = Building::firstOrCreate(
                        ['url' => $a_url],
                        ['price' => $price, 'location' => $norn_loc, 'title' => $h6_title, 'region' => $region]
                    );

                }


            }


            // page pagination end

//        $ads = $document->find('.css-l9drzq');
//
//        foreach ($ads as $post) {
//            $a_url = $ad->find('.css-z3gu2d');
//            $h6_title = $ad->find('.css-1wxaaza');
//            $p_price = $ad->find('.css-13afqrm'); // "3 800 $"
//        }
        }
    }
}
