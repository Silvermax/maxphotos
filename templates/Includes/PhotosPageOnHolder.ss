<div class="PhotoPageOnHolder">
		<h2><a href="$Link" title="$Title">$MenuTitle</a></h2>
		<div class="previewPhotos">
			<div class="floatbox">
				<% control previewPhotos %>
					<div class="photo">
						<a href="$PhotoImage.Link" rel="floatbox.photos" title="$Name">
							$PhotoImage.PhotoThumb
						</a>
					</div>
				<% end_control %>
			</div>
		</div>
		<div class="previewContent">
			<% if Perex %>
				$Perex
			<% else %>
				<% if Content %>
					<p>$Content.LimitWordCount(25)</p>
				<% end_if %>
			<% end_if %>
		</div>
		<div class="previewMoreLink">
			<p><a href="$Link" title="$Title"><% _t("PhotosPage.VIEWALL", "View all photos and read full article") %> &#187;</a></p>
		</div>
</div>