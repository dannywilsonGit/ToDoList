<?php

protected function redirectTo($request)
{
    if (! $request->expectsJson()) {
        return route('login'); // Assure-toi que cette route existe
    }
}
