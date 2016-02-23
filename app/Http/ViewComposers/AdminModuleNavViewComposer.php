<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use RadCms\Modules\Modules;

class AdminModuleNavViewComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $modules;

    /**
     * Create a new profile composer.
     *
     * @param Modules $modules
     * @internal param UserRepository $users
     */
    public function __construct(Modules $modules)
    {
        // Dependencies automatically resolved by service container...
        $this->modules = $modules;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('modules', $this->modules->all());
    }
}