<?php

namespace Statamic\Addons\Drafts;

use Statamic\API\Arr;
use Statamic\API\Str;
use Statamic\API\URL;
use Statamic\API\Content;
use Statamic\Extend\Listener;
use Illuminate\Support\Facades\Route;

class DraftsListener extends Listener
{
    public $events = [
        'cp.add_to_head' => 'addToHead',
    ];

    public function addToHead()
    {
        $route = Route::current();
        $params = $route->parametersWithoutNulls();

        if (in_array($route->getName(), ['entry.edit', 'page.edit'])) {
            $url = Arr::get($params, 'url') ?: URL::assemble(
                Arr::get($params, 'collection'),
                Arr::get($params, 'slug')
            );

            $content = Content::whereUri($url);

            if (!$content->published()) {
                $js = $this->js->inline('var url = "' . Str::removeLeft($content->url(), '/') . '";') . PHP_EOL;

                return $js . $this->js->tag('cp.js');
            }
        }
    }
}
