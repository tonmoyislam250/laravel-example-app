<?php

namespace App\Http\View\Composers;
use Illuminate\View\View;

class WelcomeComposer
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function compose(View $view)
    {
        $view->with('pageSubTitle', 'Welcome to Laravel Example App');
    }
    
}
