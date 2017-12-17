<?php

namespace Components\Base;

/**
 * Class View
 * @package Components\Base
 */
class View {
    function generate($content_view, $template_view, $data = null)
    {
        if(is_array($data)) {
            extract($data);
        }

        include __DIR__ .'../../../View/'.$template_view;
    }
} 