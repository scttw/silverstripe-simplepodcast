<?xml version="1.0" encoding="utf-8"?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
  <channel>
    <title>$PodcastTitle</title>
    <link>$$FeedLink</link>
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
    <itunes:category text="$Category" />

    <% control PodcastList %>
    <item>
      <title>$EpisodeTitle</title>
      <itunes:author>$Artist</itunes:author>
      <% if Summary %><itunes:summary>$Summary</itunes:summary><% end_if %>
      
      <enclosure url="$Audio.AbsoluteURL"
      length="$Audio.getAbsoluteSize" type="audio/mp3" />
      <guid>$Link</guid>
      <pubDate>$Date.Rfc822</pubDate>
      <itunes:duration>Duration</itunes:duration>
    </item>
    <% end_control %>
  </channel>
</rss>
