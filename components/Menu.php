<?php

namespace jx\admin_zhcn\components;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Menu as Menus;
/**
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class Menu extends Menus
{
	/**
	 * @inheritdoc
	 */
	public $linkTemplate = '<a href="{url}">{icon} {label}</a>';
	public $submenuTemplate = "\n<ul class='treeview-menu' {show}>\n{items}\n</ul>\n";
	public $activateParents = true;

	/**
	 * @inheritdoc
	 */
	protected function renderItem($item)
	{
		if (isset($item['items']))
			$linkTemplate = '<a href="{url}">{icon} {label} <i class="fa fa-angle-left pull-right"></i></a>';
		else
			$linkTemplate = $this->linkTemplate;
		if (isset($item['url'])) {
			$template = ArrayHelper::getValue($item, 'template', $linkTemplate);
			$replace = !empty($item['icon']) ? [
				'{url}' => Url::to($item['url']),
				'{label}' => '<span>' . $item['label'] . '</span>',
				'{icon}' => '<i class="fa ' . $item['icon'] . '"></i> '
			] : [
				'{url}' => Url::to($item['url']),
				'{label}' => '<span>' . $item['label'] . '</span>',
				'{icon}' => '',
			];
			return strtr($template, $replace);
		} else {
			$template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);
			$replace = !empty($item['icon']) ? [
				'{label}' => '<span>' . $item['label'] . '</span>',
				'{icon}' => '<i class="fa ' . $item['icon'] . '"></i> '
			] : [
				'{label}' => '<span>' . $item['label'] . '</span>',
				'{icon}' => '',
			];
			return strtr($template, $replace);
		}
	}

	/**
	 * Recursively renders the menu items (without the container tag).
	 * @param array $items the menu items to be rendered recursively
	 * @return string the rendering result
	 */
	protected function renderItems($items)
	{
		$n = count($items);
		$lines = [];
		foreach ($items as $i => $item) {
			$options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
			$tag = ArrayHelper::remove($options, 'tag', 'li');
			$class = [];
			if ($item['active']) {
				$class[] = $this->activeCssClass;
			}
			if ($i === 0 && $this->firstItemCssClass !== null) {
				$class[] = $this->firstItemCssClass;
			}
			if ($i === $n - 1 && $this->lastItemCssClass !== null) {
				$class[] = $this->lastItemCssClass;
			}
			if (!empty($class)) {
				if (empty($options['class'])) {
					$options['class'] = implode(' ', $class);
				} else {
					$options['class'] .= ' ' . implode(' ', $class);
				}
			}
			$menu = $this->renderItem($item);
			if (!empty($item['items'])) {
				$menu .= strtr($this->submenuTemplate, [
					'{show}' => $item['active'] ? "style='display: block'" : '',
					'{items}' => $this->renderItems($item['items']),
				]);
			}
			$lines[] = Html::tag($tag, $menu, $options);
		}
		return implode("\n", $lines);
	}

	/**
	 * @inheritdoc
	 */
	protected function normalizeItems($items, &$active)
	{
		if (empty($items))
			return false;
		foreach ($items as $i => $item) {
			if (isset($item['visible']) && !$item['visible']) {
				unset($items[$i]);
				continue;
			}
			if (!isset($item['label'])) {
				$item['label'] = '';
			}
			$encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
			$items[$i]['label'] = $encodeLabel ? Html::encode($item['label']) : $item['label'];
			$items[$i]['icon'] = isset($item['icon']) ? $item['icon'] : '';
			$hasActiveChild = false;
			if (isset($item['items'])) {
				$items[$i]['items'] = $this->normalizeItems($item['items'], $hasActiveChild);
				if (empty($items[$i]['items']) && $this->hideEmptyItems) {
					unset($items[$i]['items']);
					if (!isset($item['url'])) {
						unset($items[$i]);
						continue;
					}
				}
			}
			if (!isset($item['active'])) {
				if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item) || $this->activateItems && $this->isSubUrl($item,$this->route)) {
					$active = $items[$i]['active'] = true;
				} else {
					$items[$i]['active'] = false;
				}
			} elseif ($item['active']) {
				$active = true;
			}
		}
		return array_values($items);
	}
// 判断路由下的子方法
	protected function isSubUrl($item, $route)
	{
		if (!$this->activateItems) {
			return false;
		}
//		初始化父路由和子路由，以父路由为总数，与子路由控制器，对比
		$item_array=array_values(array_filter(explode('/',$item['url']['0'])));
		$route_array=array_values(array_filter(explode('/',$route)));
		$item_count=count($item_array)-1;
		$count=0;
		for ($i=0;$i<$item_count;$i++){
			$count++;
			if($item_array[$i]==$route_array[$i] && $count==$item_count){
				return true;
			}
		}
		return false;
	}
	/**
	 * Checks whether a menu item is active.
	 * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
	 * When the `url` option of a menu item is specified in terms of an array, its first element is treated
	 * as the route for the item and the rest of the elements are the associated parameters.
	 * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
	 * be considered active.
	 * @param array $item the menu item to be checked
	 * @return boolean whether the menu item is active
	 */
	protected function isItemActive($item)
	{
		if (!$this->activateItems) {
			return false;
		}
		if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
			$route = $item['url'][0];
			if ($route[0] !== '/' && Yii::$app->controller) {
				$route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
			}
			if (ltrim($route, '/') !== $this->route) {
				return false;
			}
			unset($item['url']['#']);
			if (count($item['url']) > 1) {
				$params = $item['url'];
				unset($params[0]);
				foreach ($params as $name => $value) {
					if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
						return false;
					}
				}
			}
			return true;
		}
		return false;
	}

}
