<% require themedCSS(photospage) %>
<h1>$Title</h1>
<div id="Photo" class="floatbox">
	<% control Photos %>
		<div class="photo">
			<a href="$PhotoImage.Link" rel="floatbox.photos" title="$Name">
				$PhotoImage.PhotoThumb
			</a>
		</div>
	<% end_control %>
	<div id="photo_content">$Content</div>
	<a href="$Parent.Link" class="back" title="Späť"><em class="uvodzovky">« </em>Späť</a>
</div>