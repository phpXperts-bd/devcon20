<?php


namespace App\Support;


trait Utility
{
    public function checkAdmin()
    {
        if (auth()->guard('backpack')->user()->email !== env('ADMIN_EMAIL')) {
            return abort(404);
        }
    }
}
