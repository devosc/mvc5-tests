<?php

namespace Mvc5\Test\View\Model;

use Mvc5\View\Model\Base;
use Mvc5\View\Model\Plugin;
use Mvc5\View\Model\ViewModel;
use Mvc5\View\ViewPlugin;

class ModelTemplateConstant
    implements Plugin, ViewModel
{
    /**
     *
     */
    use Base;
    use ViewPlugin;

    /**
     *
     */
    const TEMPLATE_NAME = 'foo';
}
