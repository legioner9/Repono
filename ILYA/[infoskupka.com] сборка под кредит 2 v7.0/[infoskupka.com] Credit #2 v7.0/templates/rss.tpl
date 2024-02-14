[shortrss]<item turbo="true">
<title>{title}</title>
<guid isPermaLink="true">{rsslink}</guid>
<link>{rsslink}</link>
<description>{short-story}</description>
<turbo:content><![CDATA[{full-story}]]></turbo:content>
<category>{category}</category>
<dc:creator>{rssauthor}</dc:creator>
<pubDate>{rssdate}</pubDate>
</item>[/shortrss]
[fullrss]<item turbo="true">
<title>{title}</title>
<guid isPermaLink="true">{rsslink}</guid>
<link>{rsslink}</link>
<description><![CDATA[{short-story}]]></description>
<turbo:content><![CDATA[{full-story}]]></turbo:content>
<category><![CDATA[{category}]]></category>
<dc:creator>{rssauthor}</dc:creator>
<pubDate>{rssdate}</pubDate>
</item>[/fullrss]
[yandexrss]
<item>
<title>{title}</title>
<link>{rsslink}</link>
<pubDate>{rssdate}</pubDate>
<media:rating scheme="urn:simple">nonadult</media:rating>
<author>{rssauthor}</author>
<category>{category}</category>
{images}
<!--[xfgiven_fullstorytopimg]<enclosure url="[xfvalue_image_url_fullstorytopimg]" type="image/jpeg"/>[/xfgiven_fullstorytopimg]
[xfgiven_video]<enclosure url="https://www.youtube.com/watch?v=[xfvalue_video]" type="video/x-ms-asf"/>[/xfgiven_video]-->
<description><![CDATA[
{short-story}
]]></description>
<content:encoded><![CDATA[
<p>
{full-story}
</p>
]]></content:encoded>
</item>
[/yandexrss]