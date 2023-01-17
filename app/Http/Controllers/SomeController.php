<?php

namespace App\Http\Controllers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class SomeController extends Controller
{
    public function moneyWithdraw(){
        /**
         * Suppose this is action is about money withdraw from your credit card.
         * But you can withdraw only one time within a min. And that is because
         * let's suppose bank does this for our protection. Or maybe for their own
         * benefits, I don't care.
         */
        $key = 'moneyWithdraw-'.auth()->user()->id;
        $max = 1;
        $declay = 60;

        $toManyRequests = '';
        $availableIn = '';

        if(RateLimiter::tooManyAttempts($key, $max)){
            $toManyRequests = 'To many requests. Come back latter.';
            $availableIn = 'Available in: ' . RateLimiter::availableIn($key) . 'sec';
        }else{
            RateLimiter::hit($key, $declay);
            /**
             * Dispatch the MoneyWithdraw event or maybe implement the code here,
             * but that's another story.
             */
        }

        $remaining = 'Remaining left: ' . RateLimiter::remaining($key, $max);

        return [
            'key' => $key,
            'max' => $max,
            'declay' => $declay, //(delay, vonese)
            'toManyRequests' => $toManyRequests,
            'availableIn' => $availableIn,
            'remaining' => $remaining
        ];

        /**
         * Try it out using 2 different browsers and users and perform the same action.
         * You'll see that the withdraws will be treated separately.
         */
    }
}
