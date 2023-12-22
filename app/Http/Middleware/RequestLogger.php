<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use DB;

class RequestLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        //here you can check the request to be logged
        $log = [
            'path' => $request->getUri(),
            'method' => $request->getMethod(),
            'request_body' => json_encode($request->all()),
            'created_at' => date("Y-m-d g:i:s"),
            'updated_at' => date("Y-m-d g:i:s"),
        ];

        DB::table('request_logger')->insert($log);

        //for log in storage file
        /*$fileName = 'example_'.date('Y-m-d').'.txt';

        if (!Storage::disk('local')->exists($fileName)) {

            Storage::disk('local')->put($fileName, '');    
        }
        Storage::disk('local')->append($fileName, json_encode($log));*/

        return $response;
    }
}