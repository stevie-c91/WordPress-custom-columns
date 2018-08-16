<?php

#######################################################
#
# Custom columns in admin area
#
#######################################################

// Add column for Cars:
function columns_cars($columns) {
	unset($columns['date']);
	$columns['car_bought_price'] = 'Bought price';
	$columns['car_sold_price'] = 'Sold price';
	$columns['car_profit_loss'] = 'Profit / Loss';
	return $columns;
}
add_filter('manage_cars_posts_columns', 'columns_cars');

// Populate column with data:
function columns_cars_data($column, $post_id) {

    if ($column === 'car_bought_price') {

		$car_bought_price = get_field('car_bought_price');
		$car_bought_price = number_format($car_bought_price);
		echo '£' . $car_bought_price . '</p>';

	}

	elseif ($column === 'car_sold_price') {

		$car_sold_price = get_field('car_sold_price');

		if ($car_sold_price) {
			$car_sold_price = number_format($car_sold_price);
			echo '£' . $car_sold_price . '</p>';
		} else {
			echo 'For sale';
		}

	}

	elseif ($column === 'car_profit_loss') {

		$car_bought_price = get_field('car_bought_price');
		$car_sold_price = get_field('car_sold_price');

		if ($car_sold_price) {

			$car_profit_loss = $car_sold_price - $car_bought_price;

			if ($car_profit_loss >= 1000) {
				echo '<p style="color:green;font-weight:bold;">+';
			} else {
				echo '<p style="color:red;font-weight:bold;">';
			}

			echo $car_profit_loss . '</p>';

		} else {
			echo 'For sale';
		}

	}

}
add_action('manage_posts_custom_column' , 'columns_cars_data', 10, 2); ?>