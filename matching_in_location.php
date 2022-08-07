<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Models\Dog\Dog;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use App\Quotation;
use App\Models\Favourite\Favourite;

class LocationController extends APIController
{
    /**
     * Log the user in.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function location(Request $request)
    {
        //print_r($request->all());die;
        $user_id        =   auth('api')->user()->id;
        $locuser_id        =   auth('api')->user()->id;
        $user_data      =   DB::table('user_setting')->where('user_id', $user_id)->first();
        $user_latitude  =   $request->latitude;
        $user_longitude =   $request->longitude;
        $distance       =   $user_data->distance;
        $gender         =   $user_data->gender;
        $age1           =   $user_data->age1;
        $age2           =   $user_data->age2;


        $quest_match =  DB::select("SELECT 
    first_name,
    users.id,
    users.age,
    users.image,
    users.description,
    users.thumbnailimages as userthumbnail,
    users.gender,
    dogs.dog_name,
    dogs.dog_age,
    dogs.dog_image,
    dog_images.images,
    dogs.dog_descrition,
    dogs.thumbnailimages as dogthumbnail,
    dogs.dog_gender,
    users.latitude,
    users.longitude,
    GETDISTANCE($user_latitude,
            $user_longitude,
            users.latitude,
            users.longitude) AS Distance,
    questionmatched,
    (questionmatched / TotalQuestion) * 100 matchedPercentage,
    block_users.user_id AS isBlocked
    favourite.favourite_by as isFavorite
FROM
    users
        INNER JOIN
    dogs ON dogs.user_id = users.id
    LEFT JOIN
    dog_images ON dogs.id = dog_images.dog_id
    LEFT JOIN
    favourite ON favourite.favourite_to = users.id
    AND favourite.favourite_by = $user_id
        LEFT JOIN
    block_users ON users.id = block_users.block_user
        AND block_users.user_id = $user_id
        LEFT JOIN
    (SELECT 
        q.user_id,
            COUNT(q.user_id) questionmatched,
            (SELECT 
                    COUNT(question_id)
                FROM
                    question_matches
                WHERE
                    question_matches.user_id = $user_id
                GROUP BY question_matches.user_id) TotalQuestion
    FROM
        question_matches
    LEFT JOIN question_matches AS q ON q.question_id = question_matches.question_id
        AND q.answer = question_matches.answer
    WHERE
        question_matches.user_id = $user_id
    GROUP BY q.user_id) ques ON ques.user_id = users.id
HAVING users.id != $user_id AND users.gender = '$gender'
    AND blockedUser IS NULL
    AND Distance < $distance
    AND age BETWEEN $age1 AND $age2
ORDER BY questionmatched DESC
");


        return response(['location' => $quest_match],200)->header('Content-Type','application/json');
    }
}
