<?php

namespace App\Helpers;

class SearchHelper {
    /**
     * Returns array of the fields to be returned in response to the API search request
     * 
     * @return array
     */
    public static function responseFields(): array
    {
        // Fields attached in the API response - starts
        $responseFields = config('constants.search-response-fields');
        $fields = [];
        foreach($responseFields as $table => $columns){
            foreach($columns as $column){
                $fields[] = $table.'.'.$column;
            }
        }

        return $fields;
    }
}