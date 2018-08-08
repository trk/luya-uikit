<?php

namespace tkr\uikit\widgets;

/**
 * Breadcrumbs for Uikit 3.
 *
 * Example Html
 *
 * ```html
 * <ul class="uk-breadcrumb">
 *   <li class="uk-active">Home</li>
 * </ul>
 * <ul class="uk-breadcrumb">
 *   <li><a href="#">Home</a></li>
 *   <li class="uk-active">Library</li>
 * </ul>
 * <ul class="uk-breadcrumb">
 *   <li><a href="#">Home</a></li>
 *   <li><a href="#">Library</a></li>
 *   <li class="uk-active">Data</li>
 * </ul>
 * ```
 *
 * @author Iskender TOTOĞLY <iskender@altivebir.com>
 */
class Breadcrumbs extends \yii\widgets\Breadcrumbs
{
    /**
     * @var string the name of the breadcrumb container tag.
     */
    public $tag = 'ul';

    /**
     * @var array the HTML attributes for the breadcrumb container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'uk-breadcrumb'];

    /**
     * @var string the template used to render each inactive item in the breadcrumbs. The token `{link}`
     * will be replaced with the actual HTML link for each inactive item.
     */
    public $itemTemplate = "<li>{link}</li>\n";

    /**
     * @var string the template used to render each active item in the breadcrumbs. The token `{link}`
     * will be replaced with the actual HTML link for each active item.
     */
    public $activeItemTemplate = "<li class=\"uk-active\">{link}</li>\n";
}