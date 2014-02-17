<div class="container">
	<div class="row">
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Server</th>
					<th>Type</th>
					<th>Status</th>
					<th>RTT</th>
					<th>Check</th>
				</tr>
			</thead>
			<tbody>
			{foreach $servers as $server}
				<tr class="{$server.ui.class}">
					<td>{$server.name}</td>
					<td>{$server.type}</td>
					<td>{$server.status}</td>
					<td>{$server.rtt}s</td>
					<td><a href="/?view=scan&server_id={$server.id}" class="btn btn-primary btn-xs" role="button">Scan now</a></td>
				</tr>
			{/foreach}
			</tbody>
		</table>
		
	</div>
</div>