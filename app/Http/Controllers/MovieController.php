<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class MovieController extends Controller {
    
    const ORDER_BY = 'movie.id';
    const ORDER_TYPE = 'asc';
    const ITEMS_PER_PAGE = 9;
    
    private function getOrder($orderArray, $order, $default) {
        $value = array_search($order, $orderArray);
        if(!$value) {
            return $default;
        }
        return $value;
    }

    private function getOrderBy($order) {
        return $this->getOrder($this->getOrderBys(), $order, self::ORDER_BY);
    }

    private function getOrderBys() {
        return [
            'movie.id' => 'b1',
            'movie.name' => 'b2',
            'movie.description' => 'b3',
            'genre.name' => 'b4',
            'format.name' => 'b5',
            'movie.price' => 'b6',
        ];
    }

    private function getOrderType($order) {
        return $this->getOrder($this->getOrderTypes(), $order, self::ORDER_TYPE);
    }

    private function getOrderTypes() {
        return [
            'asc'  => 't1',
            'desc' => 't2',
        ];
    }

    private function getOrderUrls($oBy, $oType, $q, $for, $gen, $pri, $route) {
        $urls = [];
        $orderBys = $this->getOrderBys();
        $orderTypes = $this->getOrderTypes();
        foreach($orderBys as $indexBy => $by) {
            foreach($orderTypes as $indexType => $type) {
                if($oBy == $indexBy && $oType == $indexType) {
                    $urls[$indexBy][$indexType] = url()->full() . '#';
                } else {
                    $urls[$indexBy][$indexType] = route($route, [
                                                            'orderby'   => $by,
                                                            'ordertype' => $type,
                                                            'q'         => $q,
                                                            'format'    => $for,
                                                            'genre'     => $gen,
                                                            'price'     => $pri]);
                }
            }
        }
        return $urls;
    }
    
    public function fetchData(Request $request) {
        $format = $request->input('format', '');
        $genre = $request->input('genre', '');
        $price = $request->input('price', '');
        $q = $request->input('q', '');
        $orderby = $this->getOrderBy($request->input('orderby'));
        $ordertype = $this->getOrderType($request->input('ordertype'));
        
        $movie = DB::table('movie')
                    ->join('genre', 'genre.id', '=', 'movie.idgenre')
                    ->join('format', 'format.id', '=', 'movie.idformat')
                    ->select('movie.*', 'genre.name as gname', 'format.name as fname');
        
        if (!empty($format)) {
            if (!str_contains($format, ':')) {
                $movie = $movie->where('format.name', 'like', '%' . $format . '%');
            } else {
                $formats = explode(":", $format);
                $query = '';
                foreach($formats as $format) {
                    $query .= 'format.name = "'.$format.'" OR ';
                }
                $query = rtrim($query, " OR ");
                $movie = $movie->whereRaw('( '.$query.' )');
            }
        }
        
        if (!empty($genre)) {
            if (!str_contains($genre, ':')) {
                $movie = $movie->where('genre.name', 'like', '%' . $genre . '%');
            } else {
                $genres = explode(":", $genre);
                $query = '';
                foreach($genres as $genre) {
                    $query .= 'genre.name = "'.$genre.'" OR ';
                }
                $query = rtrim($query, " OR ");
                $movie = $movie->whereRaw('( '.$query.' )');
            }
        }
        
        
        if (!empty($price)) {
            if (!str_contains($price, ':')) {
                $price = "0:900";
            }
            $prices = explode(":", $price);
            $movie = $movie->where('movie.price', '>', floatval($prices[0] != '' ? $prices[0] : '0'));
            $movie = $movie->where('movie.price', '<', floatval($prices[1] != '' ? $prices[1] : '900'));
        }
                    
        if($q != '') {
            $query = 'movie.id LIKE "%'.$q.'%" OR
                      movie.name LIKE "%'.$q.'%" OR
                      movie.description LIKE "%'.$q.'%" OR
                      genre.name LIKE "%'.$q.'%" OR
                      format.name LIKE "%'.$q.'%" OR
                      movie.price LIKE "%'.$q.'%"
            ';
            $movie = $movie->whereRaw('( '.$query.' )');
        }
        
        $movie = $movie->orderBy($orderby, $ordertype);
        if($orderby != self::ORDER_BY) {
            $movie = $movie->orderBy(self::ORDER_BY, self::ORDER_TYPE);
        }
        
        $movies = $movie->paginate(self::ITEMS_PER_PAGE)->appends(
            [
             'orderby' => $request->input('orderby'),
             'ordertype' => $request->input('ordertype'),
             'q' => $request->input('q'),
             'format' => $request->input('format'),
             'genre' => $request->input('genre'),
             'price' => $request->input('price')
            ]
        );
        
        return response()->json(['csrf'   => csrf_token(),
                                 'order'  => $this->getOrderUrls($orderby, $ordertype, $q, $format, $genre, $price, 'movie.index'),
                                 'q'      => $q,
                                 'url'    => route('movie.index'),
                                 'user'   => Auth::user(),
                                 'movies' => $movies,
                                ], 200);
    }
    
    public function index(Request $request) {
        return view('index');
    }

    public function show(Movie $movie) {
        return view('movie.show', ['movie' => $movie]);
    }
}
