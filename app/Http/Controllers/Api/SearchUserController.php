<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Helpers\SearchHelper;

class SearchUserController extends Controller
{
    /**
     * Fetch user details based on the search criteria
     *
     * If records are found the returns the json with 200 status else 404 status code is sent
     * 
     * @return json
     */
    public function fetch(Request $request): JsonResponse
    {
        $sql = User::select(SearchHelper::responseFields())
                    ->leftJoin('user_details', 'user_details.user_id', 'users.id')
                    ->leftJoin('user_location', 'user_location.user_id', 'users.id');

        if($request->name)
            $sql = $sql->where(function($query) use($request){
                $query->where('users.first', $request->name)
                      ->orWhere('users.last', $request->name);
            });

        if($request->email)
            $sql = $sql->where('users.email', $request->email);

        if($request->gender)
            $sql = $sql->where('user_details.gender', $request->gender);

        if($request->city)
            $sql = $sql->where('user_location.city', $request->city);

        if($request->country)
            $sql = $sql->where('user_location.country', $request->country);

        if($request->limit)
            $sql = $sql->limit($request->limit);

        $result = $sql->get();
        $statusCode = $result->count() ? 200 : 404;

        return response()->json($result, $statusCode);
    }
}
