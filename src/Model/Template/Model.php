<?php
/**
 *
 */

namespace Mvc5\Test\Model\Template;

use Mvc5\Model\Template;
use Mvc5\Model\Template\Model as Base;

class Model
    implements Template
{
    /**
     *
     */
    use Base;

    /**
     *
     */
    const TEMPLATE_NAME = 'baz';
}
