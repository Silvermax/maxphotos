<% require themedCSS(PhotosPage) %>
<% require themedCSS(customPhotosPage) %>
<div id="PhotosPage">
	<h1>$Breadcrumbs</h1>
	$Content
	<% if Children %>
		<div class="PhotosPageHolder">
			<% control Children %>
				<% include PhotosPageOnHolder %>
			<% end_control %>
		</div>
	<% else %>
		<% if Photos %>
			<div class="Photos">
				<% control allPhotos %>
					<% include PhotoItem %>
				<% end_control %>
			</div>
		<% else %>
			<div class="NoPhotos">
				<p class="warning"><% _t("PhotosPage.NOPHOTOS", "No photos available on this Page") %></p>
			</div>
		<% end_if %>
	<% end_if %>
</div>