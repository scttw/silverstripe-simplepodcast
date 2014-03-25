<?xml version="1.0" encoding="utf-8"?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
  <channel>
    <title>$PodcastTitle</title>
    <link>$FeedLink</link>
    <language>en-us</language>
    <copyright>$Copyright</copyright>

    <description>$Description.Summary()</description>
    <itunes:owner>
      <itunes:name>$PodcastOwner</itunes:name>
      <itunes:email>$Email</itunes:email>
    </itunes:owner>
    <% if PodcastIcon %>
    <itunes:image href="$PodcastIcon.AbsoluteURL"></itunes:image>
    <% end_if %>
    <itunes:category text="$Category"></itunes:category>

    <% loop PodcastList %>
    <item>
      <title>$EpisodeTitle</title>
      <guid>$AbsoluteLink</guid>
      <% if Summary %><itunes:summary>$Summary</itunes:summary><% end_if %>
      <enclosure url="<% if Audio %>$Audio.AbsoluteURL<% else %>$ExternalLink<% end_if %>" length="<% if Audio %>$Audio.getAbsoluteSize<% else %>0<% end_if %>" type="audio/mp3"></enclosure>
      <pubDate>$Date.Rfc822</pubDate>
      <itunes:author>$Artist</itunes:author>
      <itunes:duration>$Duration</itunes:duration>
    </item>
    <% end_loop %>
  </channel>
</rss>
