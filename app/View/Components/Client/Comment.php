<?php

namespace App\View\Components\Client;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Comment extends Component
{
    /**
     * Create a new component instance.
     */
    public $review;
    public $reviews;

    public function __construct($review, $reviews)
    {
        $this->review = $review;
        $this->reviews = $reviews;
    }

    public function render()
    {
        return view('components.client.comment');
    }
}
