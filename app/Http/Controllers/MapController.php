<?php

namespace App\Http\Controllers;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;


class MapController extends Controller
{
    public function index()
    {
        Mapper::map(47.1585, 27.6014)->informationWindow(47.1585, 27.6014, 'Content', ['markers' => ['animation' => 'DROP']]);
        Mapper::location('Iasi, Copou')->streetview(1, 1, ['ui' => false]);
        //my location
        Mapper::map(0, 0, ['marker' => true, 'locate' => true, 'animation' => 'DROP','eventAfterLoad' => 'loadMarkerOverlay(map);','zoom' => 12 ]);

        return view('frontend.map');
    }
}