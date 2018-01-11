<?php
namespace App\Helpers;
use PragmaRX\Countries\Facade as Countries;

class RequestCountries {

    public static function getCountries(){

        $data = Countries::all();
        $cities = file_get_contents( getcwd() . '/../citiesCountry.json');

        $cities = json_decode($cities, true);
        foreach ($cities as $value) {
            $citiesCountry[$value['AD']] = '';
        }

        $countries = [];
        foreach ($data as $key => $value) {
            $countries[$value['cca2']][] = $value['name']['common'];
        }
        $countries = array_intersect_key($countries,$citiesCountry);

        asort($countries);
        return $countries;
    }

    public static function getCities($country){

        $cities = file_get_contents( getcwd() . '/../citiesCountry.json');

        $cities = json_decode($cities, true);

        foreach ($cities as $value) {
            if($value['AD'] == $country){
                $citiesCountry[] = $value['Canillo'];
            }
        }

        return $citiesCountry;

    }
}