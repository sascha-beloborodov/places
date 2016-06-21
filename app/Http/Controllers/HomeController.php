<?php
/**
 * Created by PhpStorm.
 * User: sascha
 * Date: 6/21/2016
 * Time: 9:32 PM
 */
namespace App\Http\Controllers;


use App\Http\Requests;

class HomeController extends Controller
{
    public function index()
    {
        return view('places.map');
    }
}
