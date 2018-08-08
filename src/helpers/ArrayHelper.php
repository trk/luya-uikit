<?php

namespace trk\uikit\helpers;

/**
 * ArrayHelper
 *
 * @author Iskender TOTOGLU <iskender@altivebir.com>
 */
class ArrayHelper extends \luya\helpers\ArrayHelper
{
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

    // ------------------------------------------------------------------------

    /**
     * Random Element - Takes an array as input and returns a random element
     *
     * @param	array
     * @return	mixed	depends on what the array contains
     */
    public static function random_element($array)
    {
        return is_array($array) ? $array[array_rand($array)] : $array;
    }

    // ------------------------------------------------------------------------

    /**
     * Elements
     *
     * Returns only the array items specified. Will return a default value if
     * it is not set.
     *
     * @param	array
     * @param	array
     * @param	mixed
     * @return	mixed	depends on what the array contains
     */
    function elements($items, array $array, $default = NULL)
    {
        $return = array();
        is_array($items) OR $items = array($items);
        foreach ($items as $item)
        {
            $return[$item] = array_key_exists($item, $array) ? $array[$item] : $default;
        }
        return $return;
    }
}
