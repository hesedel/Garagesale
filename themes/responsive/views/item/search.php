<?php
$this->pageTitle=Yii::app()->name . ' - Search Results for ' . ucwords($this->model_itemSearchForm->keywords);

//$this->breadcrumbs = array_merge($this->breadcrumbs, $categories);

$this->layout = 'column1';

$uri = Yii::app()->request->requestUri;
?>

<div id="item_search">

<?php if(strlen($this->model_itemSearchForm->keywords) > 0): ?>
<h2>Search Results for "<span><?php echo ucwords(CHTML::encode($this->model_itemSearchForm->keywords)); ?></span>"</h2>
<?php endif; ?>

<div class="filters">

	<div class="dropDownList">
	<?php
	if(!Yii::app()->user->isGuest && !isset($_GET['university']))
		$_GET['university'] = Yii::app()->params['user']->university->parent_id ? Yii::app()->params['user']->university->parent_id : Yii::app()->params['user']->university_id;

	// get the universities
	$universities = Yii::app()->db->createCommand()
		->select('id, title')
		->from('user_university')
		->where('parent_id IS NULL')
		->order('title')
		->queryAll();

	// store the universities in a real array
	$listData = array();
	$listData_options = array();
	foreach($universities as $university)
	{
		$listData[] = array(
			'id'=>$university['id'],
			'title'=>CHtml::encode($university['title']),
		);
		$listData_options[$university['id']] = array(
			'selected'=>(isset($_GET['university']) && $_GET['university'] == $university['id']),
			'data-uri'=>(
				!isset($_GET['university']) || (!Yii::app()->user->isGuest && !strpos($uri, 'university')) ? (
					!strpos($uri, '?') ?
						$uri . '?university=' . $university['id']
					:
						$uri . '&university=' . $university['id']
				) :
					preg_replace('/(\?|\&)university=' . $_GET['university'] . '/', '$1university=' . $university['id'], $uri)
			),
		);
	}

	echo CHtml::dropDownList('university', false, CHtml::listData($listData, 'id', 'title'), array('encode'=>false, 'empty'=>'select a university', 'options'=>$listData_options));
		?>
	</div><!--

	--><?php if(isset($_GET['wanted'])):
		echo CHtml::link('<span>Wanted ads</span><i class="fa fa-times"></i>', preg_replace('/(\?|\&)wanted=?/', '', $uri));
	endif; ?><!--

	--><?php if(isset($_GET['course'])):
		echo CHtml::link('<span>' . (strlen($_GET['course']) > 0 ? 'From your course' : 'Course-related') . '</span><i class="fa fa-times"></i>', preg_replace('/(\?|\&)course=\d*(\&)?/', '$1', $uri));
	endif; ?><!--

	--><?php if(isset($_GET['price-max']) && $_GET['price-max'] == 0):
		echo CHtml::link('<span>FREE</span><i class="fa fa-times"></i>', preg_replace('/(\?|\&)price-max=0(\&)?/', '$1', $uri));
	endif; ?><!--

	--><?php
	$value_prev = array('/item/search', 'category' => false);
	foreach($categories as $key => $value) {
		if($value_prev['category'])
			$link = preg_replace('/(\?|\&)category=' . $_GET['category'] . '/', '$1category=' . $value_prev['category'], $uri);
		else
			$link = preg_replace('/(\?|\&)category=' . $_GET['category'] . '/', '', $uri);
		echo CHtml::link('<span>' . $key . '</span><i class="fa fa-times"></i>', $link);
		$value_prev = $value;
	}
	?><!--

	--><?php echo count($subcategories) > 1 ? '<div class="dropDownList">' . CHtml::dropDownList('subcategories', '', $subcategories) . '</div>' : ''; ?><!--

	--><?php if(!isset($_GET['price-max']) || (isset($_GET['price-max']) && $_GET['price-max'] != 0)):
	echo '<div class="dropDownList">' . CHtml::dropDownList('sort', (isset($_GET['sort']) ? $_GET['sort'] : ''), array(
		'' => 'sort by',
		'price-low' => 'Price: Low - High',
		'price-high' => 'Price: High - Low'
		), array('options' => array(
			'' => array(
				'data-uri' => (
					!isset($_GET['sort']) ? (
						!strpos($uri, '?') ?
							preg_replace('/(\/item\/search\/)/', '$1', $uri)
						:
							$uri
					) :
						preg_replace('/(\?|\&)sort=' . $_GET['sort'] . '/', '', $uri)
				)
			),
			'price-low' => array(
				'data-uri' => (
					!isset($_GET['sort']) ? (
						!strpos($uri, '?') ?
							preg_replace('/(\/item\/search\/)/', '$1?sort=price-low', $uri)
						:
							$uri . '&sort=price-low'
					) :
						preg_replace('/(\?|\&)sort=' . $_GET['sort'] . '/', '$1sort=price-low', $uri)
				)
			),
			'price-high' => array(
				'data-uri' => (
					!isset($_GET['sort']) ? (
						!strpos($uri, '?') ?
							preg_replace('/(\/item\/search\/)/', '$1?sort=price-high', $uri)
						:
							$uri . '&sort=price-high'
					) :
						preg_replace('/(\?|\&)sort=' . $_GET['sort'] . '/', '$1sort=price-high', $uri)
				)
			),
		))) . '</div>';
	endif; ?>

</div>

<?php $this->renderPartial('/item/_index', array(
	'dataProvider' => $dataProvider,
	'options' => array(
		'toolbox' => array(
			'viewButton' => false,
			'sortButton' => false,
		),
	),
)); ?>

</div><!-- #item_search -->

<?php Yii::app()->clientScript->registerScript('item_search',
	"
	$('#university').bind('change blur', function() {
		if($('option:selected', $(this)).index() > 0)
			window.location.href = $('option:selected', $(this)).attr('data-uri');
	});
	$('option:not(:first-child)', '#subcategories').each(function() {
		$(this).attr('data-uri', '" . (
			!isset($_GET['category']) ? (
				!strpos($uri, '?') ?
					preg_replace('/(\/item\/search\/)/', '$1?category=\' + $(this).val()', $uri)
				:
					$uri . '&category=\' + $(this).val()'
			) :
				preg_replace('/(\?|\&)category=' . $_GET['category'] . '(.*)/', '$1category=\' + $(this).val() + \'$2\'', $uri)
		) . ");
	});
	$('#subcategories').bind('change blur', function() {
		if($('option:selected', $(this)).index() > 0)
			window.location.href = $('option:selected', $(this)).attr('data-uri');
	});
	$('#sort').bind('change blur', function() {
		//if($('option:selected', $(this)).index() > 0)
			window.location.href = $('option:selected', $(this)).attr('data-uri');
	});
	",
CClientScript::POS_READY);
