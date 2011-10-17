<% require themedCSS(photospage) %>
<div class="PhotoPageHolder">
<h1>$Title</h1>
$Content
<% control Children %>
	<% include PhotoPageOnHolder %>
<% end_control %>
</div>