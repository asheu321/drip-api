<?php 
$rule = get_post_meta($post->ID, '', true ); ?>
<pre><?php print_r($rule); ?></pre>
<div class="inp-group">
	<label>Which event should trigger this automation?</label>
	<select name="_drip_api_rule[action]">
		<option value=""> Select action </option>
		<option value="user_register">After User Signup</option>
	</select>
</div>