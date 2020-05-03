<div class="podcast">
<h2>$PodcastTitle</h2>
$Description
<p><a href="$iTunesLink">Open in iTunes</a></p>

<% loop $PodcastList %>

	<div class="episode">
		<h3><a href="$Link">$EpisodeTitle - $Artist</a></h3>
		<p>$Summary</p>
		<p>
			<a class="podcast" href="<% if Audio %>$Audio.AbsoluteURL<% else %>$ExternalLink<% end_if %>"></a>
		</p>
		<p>$Date.Long - <% if $Audio %>$Audio.getSize $Audio.getFileType<% else %> MP3 Audio<% end_if %></p>
	</div>
<% end_loop %>
	<% if $PodcastList.MoreThanOnePage %>
	<div id="PageNumbers">
		<p>
			<% if $PodcastList.NotFirstPage %>
			<a class="prev" href="$PodcastList.PrevLink" title="View the previous page">Prev</a>
			<% end_if %>

			<span>
				<% loop $PodcastList.PaginationSummary(4) %>
				<% if $CurrentBool %>
				$PageNum
				<% else %>
				<% if $Link %>
				<a href="$Link" title="View page number $PageNum">$PageNum</a>
				<% else %>
				&hellip;
				<% end_if %>
				<% end_if %>
				<% end_loop %>
			</span>

			<% if $PodcastList.NotLastPage %>
			<a class="next" href="$PodcastList.NextLink" title="View the next page">Next</a>
			<% end_if %>
		</p>
	</div>
	<% end_if %>
</div>