<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use BotMan\BotMan\Interfaces\MiddlewareInterface;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;

class LogConversations
{
    public function received(IncomingMessage $message, $next, BotMan $bot)
    {
        \Log::info('Message received: ' . $message->getText());
        return $next($message);
    }

    public function sending($payload, $next, BotMan $bot)
    {
        return $next($payload);
    }

    public function heard(IncomingMessage $message, $next, BotMan $bot)
    {
        return $next($message);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
