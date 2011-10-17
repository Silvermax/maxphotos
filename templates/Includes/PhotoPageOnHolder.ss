<div class="PhotoPageOnHolder">
		<h2><a href="$Link" title="$Title">$MenuTitle</a></h2>
		<div class="previewImages floatbox">
			<% control previewImages(4) %>
				<a href="$PhotoImage.Link" rel="floatbox.photos" title="$Name">
					$PhotoImage.PhotoThumb
				</a>
			<% end_control %>
		</div>
</div>