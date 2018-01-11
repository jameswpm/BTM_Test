<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    /**
     * Receive the the type of API to test and show results
     */
    public function send(Request $request){
        $apiType = $request->get('apitype');

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://jsonplaceholder.typicode.com',
        ]);

        if ($apiType == "posts") {
            $response = $client->request('GET', 'posts');
            $data = array(
                'response' => json_decode($response->getBody()->getContents(), true),
                'type' => 'posts',
            );
            return view('result', compact('data'));
        }
        if ($apiType == "post") {
            $user_id = $request->get('user_id');
            $content = $request->get('content');
            $name = $request->get('name');

            $response = $client->post('posts', [
                'body' => json_encode(["user" => $user_id,
                                        "title" => $name,
                                        "content" => $content]),
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ]
            ]);
            $data = array(
                'response' => json_decode($response->getBody()->getContents(), true),
                'type' => 'post',
            );
            return view('result', compact('data'));
        }

    }
}
