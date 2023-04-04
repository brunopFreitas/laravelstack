<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $themes = Theme::all();
        return view('themes.index', compact('themes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('themes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //        Validate
        $request->validate([
            'name'=>['required','unique:themes,name','max:100'],
            'cdn_url'=>['required','unique:themes,cdn_url','max:255'],
        ]);

        $theme = new Theme;

        $theme->name = $request->name;
        $theme->cdn_url = $request->cdn_url;
        $theme->created_by = Auth::user()->id;
        $theme->save();

        return redirect(route('themes.index'))->with('status', 'Theme Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function show(Theme $theme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function edit(Theme $theme)
    {
        //
        return view('themes.edit', compact('theme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theme $theme)
    {
        //        Validate
        $request->validate([
            'name'=>['required','unique:themes,name,' .$theme->id,'max:100'],
            'cdn_url'=>['required','unique:themes,cdn_url,' .$theme->id,'max:255'],
        ]);

        $theme->name = $request->name;
        $theme->cdn_url = $request->cdn_url;
        $theme->updated_by = Auth::user()->id;
        $theme->save();

        return redirect(route('themes.index'))->with('status', 'Theme Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theme $theme)
    {
        //
        $theme->delete();

        return redirect(route('themes.index'))->with('status', 'Theme Deleted');
    }
}
