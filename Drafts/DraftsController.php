<?php

namespace Statamic\Addons\Drafts;

use Statamic\Http\View;
use Statamic\API\Content;
use Statamic\Extend\Controller;

class DraftsController extends Controller
{
    public function getView(...$segments)
    {
        $content = Content::whereUri(join('/', $segments));

        if ($content->published()) {
            return redirect($content->absoluteUrl());
        }

        $this->loadKeyVars();

        return response('')
            ->header('X-Statamic-Draft', true)
            ->setContent(app(View::class)
            ->render($content));
    }
}
