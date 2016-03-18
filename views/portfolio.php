<div>
	<div id="message" style="font-size:30px">
		<?php
			print("Hello, ". $cash[0]["username"] .". <p>Your current balance is $" . number_format($cash[0]["cash"],2));
		?>
	</div>
	<table class="table table-bordered">
		<thead>
			<tr>
			<th class="text-center" style="font-family: Verdana; color: red">Symbol</th>
			<th class="text-center" style="font-family: Verdana; color: blue">Name</th>
			<th class="text-center" style="font-family: Verdana; color: green">Shares</th>
			<th class="text-center" style="font-family: Verdana; color: purple">Price</th>
			<th class="text-center" style="font-family: Verdana; color: orange">Total</th>
			</tr>
	</thead>
	
	<tbody bgcolor="#CBCAC8">
		<?php
				foreach ($positions as $position)
				{	  
					print("<tr>");
					print("<td>{$position["symbol"]}</td>");
					print("<td>{$position["name"]}</td>");
					print("<td>{$position["shares"]}</td>");
					print("<td>\${$position["price"]}</td>");
					print("<td>\${$position["total"]}</td>");
					print("</tr>");
				}
		?>
	</tbody>
	</table>
</div>