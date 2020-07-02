<body>
	<h3>Delivery System</h3>
	<h5 style="font-size: 14px;">New Order</h5>
	<hr>
	<pre>
		<h5>{{ $title }}</h6>
		<p>{{ $text }}</p>
		<p>Attached file: {{ url('/file/' . str_replace(' ', '%20', $file) . '/order_files')}}</p>
	</pre>
</body>