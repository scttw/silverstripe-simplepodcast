<div class="podcast">
<h2>$PodcastTitle</h2>
$Description
<p><a href="$iTunesLink">Open in iTunes</a></p>

<% control PodcastList %>
	<div class="episode">
		<h3><a href="$Link">$EpisodeTitle - $Artist</a></h3>
		<p>$Summary</p>
		<p>
			<audio controls>
				<source src="<% if Audio %>$Audio.AbsoluteURL<% else %>$ExternalLink<% end_if %>" type="audio/mp3">
				<a class="podcast" href="<% if Audio %>$Audio.AbsoluteURL<% else %>$ExternalLink<% end_if %>"></a>
			</audio> 
		</p>
		<p>$Date.Long - <% if Audio %>$Audio.getSize $Audio.getFileType<% else %> MP3 Audio<% end_if %></p>
	</div>
<% end_control %>
</div>