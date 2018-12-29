<h1>My Orders</h1>
<header class="top_box on_the_sides">
	<!--<div class="left_side v_centered">
		<p class="visible_pages">Showing 1 to 10 of 30 (3 pages)</p>
		<span>Show:</span> 
		<div class="custom_select">
			<select name="">
				<option value="10">10</option>
				<option value="9">9</option>
				<option value="8">8</option>
				<option value="7">7</option>
				<option value="6">6</option>
				<option value="5">5</option>
				<option value="4">4</option>
				<option value="3">3</option>
				<option value="2">2</option>
				<option value="1">1</option>
			</select>
		</div>
	</div>-->
	<div class="right_side">
		<ul class="pags">
			<li><a href="#"></a></li>
			<li class="active"><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#"></a></li>
		</ul>
	</div>
</header><!--/ .top_box -->
<div class="table_wrap">
	<table class="table_type_1 orders_table">
		<thead>
			<tr>
				<th class="order_number_col">Order Number</th>
				<th>Order Date</th>
				<th class="ship_col">Ship To</th>
				<th>Order Status</th>
				<th class="order_total_col">Total</th>
				<th class="product_action_col">Action</th>
				<?php
					
					foreach($headings as $heading) {
						echo '<th>';
						echo $heading;
						echo '</th>';
					}
				?>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td data-title="Order Number"><a href="#">145000007</a></td>
				<td data-title="Order Date">9/5/2014</td>
				<td data-title="Ship To">John Doe</td>
				<td data-title="Order Status">Pending</td>
				<td data-title="Total" class="total">$5.99</td>
				<td data-title="Action">
					<ul class="buttons_col">
						<li>
							<a href="#" class="button_grey">View Order</a>
						</li>
						<li>
							<a href="#" class="button_grey">Reorder</a>
						</li>
					</ul>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<footer class="bottom_box">
	<a href="#" class="button_grey middle_btn">Back</a>
</footer><!--/ .bottom_box -->