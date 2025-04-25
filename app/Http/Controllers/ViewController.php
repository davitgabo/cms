<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index($slug = null)
    {
        if ($slug) {
            $page = Menu::where('slug',$slug)->with('contents')->first();

            if (!$page) {
                abort(404);
            }
        } else {
            $page = Menu::where('is_homepage',true)->with('contents')->first();
        }

        $menus = Menu::published()->orderBy('order')->get();
        return view("index", compact('page','menus'));
    }
}
