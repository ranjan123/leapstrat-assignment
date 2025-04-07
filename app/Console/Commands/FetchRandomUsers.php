<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Http;

use App\Models\User;
use App\Models\UserDetails;
use App\Models\UserLocation;

class FetchRandomUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-random-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch users from the external API and store into the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get(config('constants.api-endpoint'));
        $response = json_decode($response);

        foreach($response->results as $result){
            \DB::transaction(function() use($result){
                
                $user = User::create([
                    'title' => $result->name->title,
                    'first' => $result->name->first,
                    'last' => $result->name->last,
                    'email' => $result->email
                ]);
        
                UserDetails::create([
                    'user_id' => $user->id,
                    'gender' => $result->gender
                ]);
        
                UserLocation::create([
                    'user_id' => $user->id,
                    'city' => $result->location->city,
                    'country' => $result->location->country
                ]);
            });
        }
    }
}
