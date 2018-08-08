<?php

namespace trk\uikit;

class Uikit
{
    /**
     * Regex for image files
     */
    const REGEX_IMAGE = '#\.(gif|png|jpe?g|svg)$#';

    /**
     * Regex for video files
     */
    const REGEX_VIDEO = '#\.(mp4|ogv|webm)$#';

    /**
     * Regex for vimeo
     */
    const REGEX_VIMEO = '#(?:player\.)?vimeo\.com(?:/video)?/(\d+)#i';

    /**
     * Regex for youtube
     */
    const REGEX_YOUTUBE = '#(?:youtube(-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})#i';

    /**
     * Set general block configs for view
     *
     * @param array $configs
     * @return array
     */
    public static function configs(array $configs = []) {

        $class = self::element('class', $configs, '');
        // Set class
        $configs['class'] = [];
        if($class) $configs['class'][] = $class;
        // Set given id or an create an unique id
        $configs['id'] = self::element('id', $configs, self::unique());
        // Set empty attributes array
        $configs['attrs'] = [];

        // Animation
        $animation = self::element('animation', $configs, '');
        // if ($animation && $configs['animation'] != 'none' && $configs['animation'] != 'parallax' && $element->parent('section', 'animation') && $element->parent->type == 'column') {
        if ($animation && $animation != 'none' && $animation != 'parallax') {
            $configs['attrs']['data-uk-scrollspy-class'] = $animation ? "uk-animation-{$animation}" : true;
        }

        // Parallax
        // if ($animation && $animation == 'parallax' || $configs['item_animation'] == 'parallax') {
        if ($animation && $animation == 'parallax') {

            foreach(['x', 'y', 'scale', 'rotate', 'opacity'] as $prop) {
                $start = self::element("parallax_{$prop}_start", $configs, '');
                $end = self::element("parallax_{$prop}_end", $configs, '');
                $default = in_array($prop, ['scale', 'opacity']) ? 1 : 0;

                if (strlen($start) || strlen($end)) {
                    $options[] = "{$prop}: " . (strlen($start) ? $start : $default) . "," . (strlen($end) ? $end : $default);
                }
            }
            $parallax_easing = self::element("parallax_easing", $configs, '');
            $parallax_target = self::element("parallax_target", $configs, '');
            $parallax_viewport = self::element("parallax_viewport", $configs, '');
            $parallax_breakpoint = self::element("parallax_breakpoint", $configs, '');
            $options[] = is_numeric($parallax_easing) ? "easing: {$parallax_easing}" : '';
            $options[] = $parallax_target ? 'target: !.uk-section' : '';
            $options[] = is_numeric($parallax_viewport) ? "viewport: {$parallax_viewport}" : '';
            $options[] = $parallax_breakpoint ? "media: @{$parallax_breakpoint}" : '';
            $configs['attrs']['data-uk-parallax'] = implode(';', array_filter($options));
        }

        // Visibility
        $visibility = self::element('visibility', $configs, '');
        if ($visibility) {
            switch ($visibility) {
                case 's':
                    $configs['class'][] = 'uk-visible@s';
                    break;
                case 'm':
                    $configs['class'][] = 'uk-visible@m';
                    break;
                case 'l':
                    $configs['class'][] = 'uk-visible@l';
                    break;
                case 'xl':
                    $configs['class'][] = 'uk-visible@xl';
                    break;
                default:
                    $configs['class'][] = '';
                    break;
            }
        }

        // Margin
        $margin = self::element('margin', $configs, '');
        if ($margin) {
            switch ($margin) {
                case '':
                    break;
                case 'default':
                    $configs['class'][] = 'uk-margin';
                    break;
                default:
                    $configs['class'][] = "uk-margin-{$margin}";
            }
        }

        if ($margin && $margin != 'remove-vertical') {
            $marginRemoveTop = self::element('margin_remove_top', $configs);
            if ($marginRemoveTop) {
                $configs['class'][] = 'uk-margin-remove-top';
            }
            $marginRemoveBottom = self::element('margin_remove_bottom', $configs);
            if ($marginRemoveBottom) {
                $configs['class'][] = 'uk-margin-remove-bottom';
            }
        }

        // Max Width
        $maxwidth = self::element('maxwidth', $configs);
        if ($maxwidth) {
            $maxwidth_align = self::element('maxwidth_align', $configs, '');
            $maxwidth_breakpoint = self::element('maxwidth_breakpoint', $configs, '');
            switch ($maxwidth_breakpoint) {
                case 's':
                    $configs['class'][] = "uk-width-$maxwidth@s";
                    break;
                case 'm':
                    $configs['class'][] = "uk-width-$maxwidth@m";
                    break;
                case 'l':
                    $configs['class'][] = "uk-width-$maxwidth@l";
                    break;
                case 'xl':
                    $configs['class'][] = "uk-width-$maxwidth@xl";
                    break;
                default:
                    $configs['class'][] = "uk-width-$maxwidth";
                    break;
            }

            switch ($maxwidth_align) {
                case 'right':
                    $configs['class'][] = "uk-margin-auto-left";
                    break;
                case 'center':
                    $configs['class'][] = "uk-margin-auto";
                    break;
            }
        }

        // Text alignment
        $text_align = self::element('text_align', $configs);
        $text_align_breakpoint = self::element('text_align_breakpoint', $configs);
        if ($text_align && $text_align != 'justify' && $text_align_breakpoint) {
            $configs['class'][] = "uk-text-{$text_align}@{$text_align_breakpoint}";
            $text_align_fallback = self::element('text_align_fallback', $configs);
            if ($text_align_fallback) {
                $configs['class'][] = "uk-text-{$text_align_fallback}";
            }
        } else if ($text_align) {
            $configs['class'][] = "uk-text-{$text_align}";
        }

        // Custom CSS
        $css = self::element('css', $configs);
        if ($css) {
            $pre = str_replace('#', '\#', $configs['id']);
            $css = self::prefix("{$css}\n", "#{$pre}");

            $configs['css'] = $css;
        }

        return $configs;
    }

    /**
     * Generate and return unique value
     *
     * @param string $prefix
     * @return string
     */
    public static function unique($prefix = '') {
        $prefix = $prefix ? $prefix . "-" : "";
        return $prefix . substr(uniqid(), -3);
    }

    /**
     * Prefix CSS classes.
     *
     * @param  string $css
     * @param  string $prefix
     * @return string
     */
    protected static function prefix($css, $prefix = '')
    {
        $pattern = '/([@#:\.\w\[\]][@#:,>~="\'\+\-\.\(\)\w\s\[\]\*]*)({(?:[^{}]+|(?R))*})/s';

        if (preg_match_all($pattern, $css, $matches, PREG_SET_ORDER)) {

            $keys = [];

            foreach ($matches as $match) {

                list($match, $selector, $content) = $match;

                if (in_array($key = sha1($match), $keys)) {
                    continue;
                }

                if ($selector[0] != '@') {
                    $selector = preg_replace('/[^\n\,]+/', "{$prefix} $0", $selector);
                    $selector = preg_replace('/\s\.el-(element|section|column)/', '', $selector);
                }

                $css = str_replace($match, $selector.self::prefix($content, $prefix), $css); $keys[] = $key;
            }
        }

        return $css;
    }

    /**
     * Render tag attributes
     *
     * @param array $attributes
     * @return string
     */
    public static function attrs(array $attributes) {
        $output = [];

        if (count($args = func_get_args()) > 1) {
            $attributes = call_user_func_array('array_merge_recursive', $args);
        }

        foreach ($attributes as $key => $value) {
            if (is_array($value)) {
                $value = implode(' ', array_filter($value));
            }

            if (empty($value) && !is_numeric($value)) {
                continue;
            }

            if (is_numeric($key)) {
                $output[] = $value;
            } elseif ($value === true) {
                $output[] = $key;
            } elseif ($value !== '') {
                $output[] = sprintf('%s="%s"', $key, htmlspecialchars($value, ENT_COMPAT, 'UTF-8', false));
            }
        }

        return $output ? ' '.implode(' ', $output) : '';
    }

    /**
     * Gets the picked values from the given array.
     *
     * @param  array        $array
     * @param  array|string $keys
     * @return array
     */
    public static function pick($array, $keys)
    {
        return array_intersect_key($array, array_flip((array) $keys));
    }

    /**
     * Gets items as JSON string.
     *
     * @param array $array
     * @param int $options
     * @return string
     */
    public static function json(array $array, $options = 0)
    {
        return json_encode($array, $options);
    }

    /**
     * Renders a link tag.
     *
     * @param  string $title
     * @param  string $url
     * @param  array  $attrs
     * @return string
     */
    public static function link($title, $url = null, array $attrs = []) {
        return "<a" . self::attrs(['href' => $url], $attrs) . ">{$title}</a>";
    }

    /**
     * Renders an image tag.
     *
     * @param  array|string $url
     * @param  array        $attrs
     * @return string
     */
    public static function image($url, array $attrs = [])
    {
        $url = (array) $url;
        $path = array_shift($url);
        $params = $url ? '#' . http_build_query(array_map(function ($value) {
                return is_array($value) ? implode(',', $value) : $value;
            }, $url), '', '&') : '';

        if (empty($attrs['alt'])) {
            $attrs['alt'] = true;
        }

        return "<img" . self::attrs(['src' => $path . $params], $attrs) . ">";
    }

    /**
     * is the link image ?
     *
     * @param $link
     * @return bool
     */
    public static function isImage($link) {
        return $link && preg_match(self::REGEX_IMAGE, $link, $matches) ? $matches[1] : false;
    }

    // ------------------------------------------------------------------------

    /**
     * is the link video ?
     *
     * @param $link
     * @return bool
     */
    public static function isVideo($link) {
        return $link && preg_match(self::REGEX_VIDEO, $link, $matches) ? $matches[1] : false;
    }

    /**
     * is the iframe url ?
     *
     * @param $link
     * @param array $params
     * @param bool $defaults
     * @return string
     */
    public static function iframeVideo($link, $params = [], $defaults = true) {
        $query = parse_url($link, PHP_URL_QUERY);

        if ($query) {
            parse_str($query, $_params);
            $params = array_merge($_params, $params);
        }

        if (preg_match(self::REGEX_VIMEO, $link, $matches)) {
            return self::url("https://player.vimeo.com/video/{$matches[1]}", $defaults ? array_merge([
                'loop' => 1,
                'autoplay' => 1,
                'title' => 0,
                'byline' => 0,
                'setVolume' => 0
            ], $params) : $params);
        }

        if (preg_match(self::REGEX_YOUTUBE, $link, $matches)) {

            if (!empty($params['loop'])) {
                $params['playlist'] = $matches[2];
            }

            if (empty($params['controls'])) {
                $params['disablekb'] = 1;
            }

            return self::url("https://www.youtube{$matches[1]}.com/embed/{$matches[2]}", $defaults ? array_merge([
                'rel' => 0,
                'loop' => 1,
                'playlist' => $matches[2],
                'autoplay' => 1,
                'controls' => 0,
                'showinfo' => 0,
                'iv_load_policy' => 3,
                'modestbranding' => 1,
                'wmode' => 'transparent',
                'playsinline' => 1
            ], $params) : $params);
        }
    }

    /**
     * Url Generator
     *
     * @param $path
     * @param array $parameters
     * @return string
     */
    public static function url($path, array $parameters = []) {
        if(count($parameters)) $path .= '?' . http_build_query($parameters);
        return $path;
    }

    /**
     * Element
     *
     * Lets you determine whether an array index is set and whether it has a value.
     * If the element is empty it returns NULL (or whatever you specify as the default value.)
     *
     * @param	string
     * @param	array
     * @param	mixed
     * @return	mixed	depends on what the array contains
     */
    public static function element($item, array $array, $default = NULL)
    {
        return array_key_exists($item, $array) ? $array[$item] : $default;
    }

    /**
     * Simple debug function
     *
     * @param $var
     */
    public static function trace($var)
    {
        echo('<pre>');
        print_r($var);
        echo('</pre>');

    }
}