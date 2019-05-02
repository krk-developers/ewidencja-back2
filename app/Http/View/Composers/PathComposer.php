<?php

declare(strict_types = 1);

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class PathComposer
{
    /**
     * Request
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new path composer.
     *
     * @param Request $request Request
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        // Dependencies automatically resolved by service container.
        $this->request = $request;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view View
     * 
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('path', $this->request->segment(1));
    }
}
