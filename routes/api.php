<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    $message = [
        'app' => env('APP_NAME', 'Something of the day')
    ];
    return json_encode($message);
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('wotd', '\Wotd\Controllers\WotdController@getWotdAction');
    Route::get('words', '\Wotd\Controllers\WotdController@getWordsAction');
//    Route::get('chatbot/facebook/webhook', 'FacebookChatBotController@responseChatBotChallengeAction');
//    Route::post('chatbot/facebook/webhook', 'FacebookChatBotController@responseUserMessageAction');
});
