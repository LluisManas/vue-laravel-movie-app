<?php

namespace App\Repository\Eloquent;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;

class MoviesRepository
{
    public function getPopularMovies()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/movie/popular')
        ->json();
       
        $popularMovies = $this->addStreamingProvider($popularMovies);
       
        return $popularMovies;
    }

    public function getTopRatedMovies()
    {
        $topRatedMovies = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/movie/top_rated')
        ->json();

        $topRatedMovies = $this->addStreamingProvider($topRatedMovies);

        return $topRatedMovies;
    }

    public function getMovieDetails($movieId)
    {
        $detailsMovie = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/movie/' . $movieId)
        ->json();

        $countryCode = $this->getStreamingCountry();
        
        $detailsMovie['provider'] = $this->getStreamingProviderName($detailsMovie['id'], $countryCode);
        
        return $detailsMovie;
    }

    public function addStreamingProvider($moviesList)
    {
        $countryCode = $this->getStreamingCountry();
       
        foreach ($moviesList['results'] as $key => $moviesDetails) {
            $movieId = $moviesDetails['id'];
            $moviesList['results'][$key]['provider'] = $this->getStreamingProviderName($movieId, $countryCode);
        }
       
        return $moviesList;
    }

    /**
     * Get the streaming provider of the movie
     * 
     * @param integer $movieId
     * @return Colletion
     */
    public function getStreamingProviderName($movieId, $countryCode)
    {
        $streamingProvider = Http::withToken(config('services.tmdb.token'))
            ->get('http://api.themoviedb.org/3/movie/' . $movieId . '/watch/providers')
            ->json();
        
        
        if ($streamingProvider['results']) {
            if (array_key_exists($countryCode, $streamingProvider['results'])) {
                if (array_key_exists('flatrate', $streamingProvider['results'][$countryCode])) {
                    $streamingProvider = $streamingProvider['results'][$countryCode]['flatrate'][0]['provider_name']; 
                    } else {            
                    $streamingProvider = 'Not available for stream in ' . $countryCode;
                }
            } else {
                $streamingProvider = 'Not available in ' . $countryCode;
            }
        }


        return $streamingProvider;
    }

    public function getStreamingCountry()
    {
        $user = auth()->user();
        $country = User::find($user['id']);
        if ($country) {
            $countryCode = $country['country'];
        } else {
            $countrycode = 'DE';
        }

        return $countryCode;
    }

    public function getSimilarMovies($movieId)
    {
        $similarMovies = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/movie/' . $movieId . '/similar')
        ->json();

        return $similarMovies['results'];
    }

    public function searchMovie($movieName)
    {
        $results = Http::withToken(config('services.tmdb.token'))
        ->get('http://api.themoviedb.org/3/search/movie/?query=' . $movieName)
        ->json();
        
        $foundMovies = $this->addStreamingProvider($results);

        return $foundMovies['results'];
    }

}