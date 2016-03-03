<?php

namespace RadCms\Pages\Http\ViewComposers;

use Illuminate\View\View;
use RadCms\Pages\ContentTypes\AdminContentType;

class HeadContentSelectorViewComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $contentTypes;

    /**
     * Create a new profile composer.
     *
     * @param Modules $modules
     * @internal param UserRepository $users
     */
    public function __construct(AdminContentType $contentTypes)
    {
        // Dependencies automatically resolved by service container...
        $this->contentTypes = $contentTypes;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('contentTypes', $this->contentTypes->head());
    }
}