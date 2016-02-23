<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use RadCms\Modules\Modules;
use RadCms\Modules\SystemModules;

class AdminModuleNavViewComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $modules;
    protected $systemModules;

    /**
     * Create a new profile composer.
     *
     * @param Modules $modules
     * @internal param UserRepository $users
     */
    public function __construct(Modules $modules, SystemModules $systemModules)
    {
        // Dependencies automatically resolved by service container...
        $this->modules = $modules;
        $this->systemModules = $systemModules;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $modules = [$this->modules->all()];
        $modules = array_merge($this->systemModules->all());
        $view->with('modules', $modules);
    }
}