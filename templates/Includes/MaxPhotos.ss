<% if MaxPhotos %>
		<ul class="small-block-grid-2 large-block-grid-4">
			<% loop MaxPhotos %>
				<li>
					<a href="$Image.Link" class="gallery" data-fancybox-group="gallery" <% if Title %>title="$Title"<% end_if %>>
						<img src="$Image.Thumb.Link" <% if Title %>alt="$Title"<% end_if %> />
					</a>
				</li>
			<% end_loop %>
		</ul>
		$addEffect("fancyBox","gallery")
<% end_if %>