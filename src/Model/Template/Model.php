<?php
/**
 *
 */

namespace Mvc5\Test\Model\Template;

use Mvc5\Model\Template;
use Mvc5\Model\Plugin;

class Model
    implements Template
{
    /**
     *
     */
    use Plugin;

    /**
     *
     */
    const TEMPLATE_NAME = 'baz';
}
