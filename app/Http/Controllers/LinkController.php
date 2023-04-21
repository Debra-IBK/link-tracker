<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
    

class LinkController extends Controller
{
    
   
        public function index()
        {
            $links = Link::all();
            return view('links.index', compact('links'));
        }
    
       
    
        public function store(Request $request)
        {
            $request->validate([
                'url' => 'required|url',
            ]);
    
            $code = Str::random(6);
    
            Link::create([
                'url' => $request->url,
                'code' => $code,
            ]);
    
            return redirect()->route('links.index');
        }
    
        public function show($code)
        {
            $link = Link::where('code', $code)->firstOrFail();
    
            DB::table('links')->where('code', $code)->increment('clicks');
    
            return redirect($link->url);
        }

    
    
}
