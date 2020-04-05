<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Movie;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $episodes = Episode::all()->load('movies', 'photo');
        return response($episodes, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $episode = new Episode();
        $episode->title = $request->input('title');
        $episode->photo_file_id = $request->input('photo_file_id');
        $episode->save();

        $moviesToAdd = array();

        foreach($request["movies"] as $request_movie) {
            $db_movie = Movie::find($request_movie["id"]);
            if(!$db_movie) {
                $movie = new Movie();
                $movie->id = $request_movie["id"];
                $movie->title = $request_movie["title"];
                $movie->poster_path = $request_movie["poster_path"];
                $movie->release_date = $request_movie["release_date"];
                $movie->save();
            }
            array_push($moviesToAdd, $movie->id);
        }
        $episode->movies()->sync($moviesToAdd);
        $episode->movies;
        return response($episode, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(Episode $episode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Episode $episode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Episode $episode)
    {
        //
    }
}
