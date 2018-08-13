<?php

namespace trk\uikit\helpers;

/**
 * HtmlHelper
 *
 * @author Iskender TOTOGLU <iskender@altivebir.com>
 */
class HtmlHelper extends \luya\helpers\Html
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
        return "<a" . ArrayHelper::attrs(['href' => $url], $attrs) . ">{$title}</a>";
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

        return "<img" . ArrayHelper::attrs(['src' => $path . $params], $attrs) . ">";
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
}
