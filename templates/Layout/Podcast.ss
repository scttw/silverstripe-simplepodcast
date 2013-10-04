<div class="podcast">
	<div class="episode">
		<h3><a href="<% if Audio %>$Audio.AbsoluteURL<% else %>$ExternalLink<% end_if %>">$EpisodeTitle - $Artist</a></h3>
		<p>$Summary</p>
		<p>
			<audio controls>
				<source src="<% if Audio %>$Audio.AbsoluteURL<% else %>$ExternalLink<% end_if %>" type="audio/mp3">
				<a class="podcast" href="<% if Audio %>$Audio.AbsoluteURL<% else %>$ExternalLink<% end_if %>"></a>
			</audio> 
		</p>
		<p>$Date.Long - <% if Audio %>$Audio.getSize $Audio.getFileType<% else %> MP3 Audio<% end_if %></p>
	</div>
</div>