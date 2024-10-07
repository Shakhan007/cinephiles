<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; // Import File facade

class adminController extends Controller
{
    function moviestore(Request $request)
    {



        $movie_name = $request->input('moviename');
        $release_year = $request->input('year');
        $genres = $request->input('genres');
        $synopsis = $request->input('synopsis');
        $image = $request->input('image');

        // Set the directory where your video files are stored
        $video_directory = public_path('videos/'); // Ensure this directory is correct
     

// Debug: Print out the paths being checked
        \Log::info("Checking video file for: " . $video_directory . $movie_name . '.mp4');
        \Log::info("Checking movie clip file for: " . $video_directory . $movie_name . '.mp4');



        // Insert the movie data into the database

        // DB::table('movie_infos')->insert([
        //     'movie_name' => $movie_name,
        //     'release_year' => $release_year,
        //     'genres' => $genres,
        //     'synopsis' => 'Avatar is  good movie',
        //     'category' => 'DARK',
        //     'image' => 'avatar.jpg',
        //     'video' => 'Avatar.mp4',
        //     'movie_clip' => 'Avatar.mp4',
        // ]);
        // return response()->json("OK");

        // Check if the specific video file exists
        $video_file = $video_directory . $movie_name . '.mp4';
        if (File::exists($video_file)) {
            $video = $movie_name . '.mp4';
        } else {
            $video = 'default.mp4'; // Fallback to default video
        }

        // Check if the specific movie clip file exists
        $movie_clip_file = $video_directory . $movie_name . '.mp4'; // Use different naming if needed
        if (File::exists($movie_clip_file)) {
            $movie_clip = $movie_name . '.mp4';
        } else {
            $movie_clip = 'default.mp4'; // Fallback to default movie clip
        }

         DB::table('movie_infos')->insert([
            'movie_name' => $movie_name,
            'release_year' => $release_year,
            'genres' => $genres,
            'synopsis' => $synopsis,
            'category' => 'DARK',
            'image' => $image,
            'video' => $video,
            'movie_clip' => $movie_clip,
        ]);
        return response()->json("OK");

    }

    function setContest(Request $request){

        $hour = $request->input('hour');
        $min = $request->input('min');
        $sec = $request->input('sec');
        
        DB::table('contesttime')->delete();


        DB::table('contesttime')->insert([
            'h' => $hour,
            'm' => $min,
            's' => $sec,
           
        ]);

        return response()->json("OK");


    }

}
