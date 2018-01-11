<?php

namespace App\Http\Controllers;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;


class MapController extends Controller
{
    public function index()
    {
        Mapper::map(47.1585, 27.6014);

        return view('frontend.map');
    }
}