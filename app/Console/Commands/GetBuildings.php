<?php

namespace App\Console\Commands;

use DiDom\Document;
use Illuminate\Console\Command;

class GetBuildings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'buildings:get {region} {price}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $region = $this->argument('region');
        $price = $this->argument('price');

        $page = 1;


        $url = 'https://www.olx.ua/uk/nedvizhimost/doma/prodazha-domov/' . $region . '/?currency=USD&page=' . $page . '&search%5Bfilter_float_price:to%5D=' . $price;


        $document = new Document($url, true);


        // page pagination start

        $paginationList = $document->find('.pagination-list');

        if ($paginationList) {


//            $li_last = $paginationList-> ->getLast = 'pagination-list-item';

//            $a_num = $li_last->getNum '';

        }


        // page pagination end

        $posts = $document->find('.css-l9drzq');

        foreach ($posts as $post) {
            $a_url = $post->find('.css-z3gu2d');
            $h6_title = $post->find('.css-1wxaaza');
            $p_price = $post->find('.css-13afqrm'); // "3 800 $"
        }
    }
}
