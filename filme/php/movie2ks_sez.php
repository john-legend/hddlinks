#!/usr/local/bin/Resource/www/cgi-bin/php
<?php
echo "<?xml version='1.0' encoding='UTF8' ?>";
$host = "http://127.0.0.1/cgi-bin";
$query = $_GET["query"];
if($query) {
   $queryArr = explode(',', $query);
   $link = $queryArr[0];
   $tit = urldecode($queryArr[1]);
}
?>
<rss version="2.0">
<onEnter>
  startitem = "middle";
  setRefreshTime(1);
</onEnter>

<onRefresh>
  setRefreshTime(-1);
  itemCount = getPageInfo("itemCount");
</onRefresh>

<mediaDisplay name="threePartsView"
	sideLeftWidthPC="0"
	sideRightWidthPC="0"

	headerImageWidthPC="0"
	selectMenuOnRight="no"
	autoSelectMenu="no"
	autoSelectItem="no"
	itemImageHeightPC="0"
	itemImageWidthPC="0"
	itemXPC="8"
	itemYPC="25"
	itemWidthPC="45"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="45"
	capHeightPC="64"
	itemBackgroundColor="0:0:0"
	itemPerPage="8"
  itemGap="0"
	bottomYPC="90"
	backgroundColor="0:0:0"
	showHeader="no"
	showDefaultInfo="no"
	imageFocus=""
	sliding="no"
	idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10"
>

  	<text align="center" offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20" fontSize="30" backgroundColor="10:105:150" foregroundColor="100:200:255">
		  <script>getPageInfo("pageTitle");</script>
		</text>
  	<text align="left" offsetXPC="6" offsetYPC="15" widthPC="75" heightPC="4" fontSize="16" backgroundColor="10:105:150" foregroundColor="100:200:255">
    2= add to favorite
		</text>
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
		</text>

		<text align="center" redraw="yes"
          lines="10" fontSize=17
		      offsetXPC=55 offsetYPC=55 widthPC=40 heightPC=42
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
			<script>print(annotation); annotation;</script>
		</text>
		<image  redraw="yes" offsetXPC=65 offsetYPC=22.5 widthPC=20 heightPC=20>
		<script>print(img); img;</script>
		</image>
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>

		<itemDisplay>
			<text align="left" lines="1" offsetXPC=0 offsetYPC=0 widthPC=100 heightPC=100>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus==idx)
					{
					  location = getItemInfo(idx, "location");
					  annotation = getItemInfo(idx, "annotation");
					  img = getItemInfo(idx,"image");
					}
					getItemInfo(idx, "title");
				</script>
				<fontSize>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "14"; else "14";
  				</script>
				</fontSize>
			  <backgroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "10:80:120"; else "-1:-1:-1";
  				</script>
			  </backgroundColor>
			  <foregroundColor>
  				<script>
  					idx = getQueryItemIndex();
  					focus = getFocusItemIndex();
  			    if(focus==idx) "255:255:255"; else "140:140:140";
  				</script>
			  </foregroundColor>
			</text>

		</itemDisplay>

<onUserInput>
<script>
ret = "false";
userInput = currentUserInput();

if (userInput == "pagedown" || userInput == "pageup")
{
  idx = Integer(getFocusItemIndex());
  if (userInput == "pagedown")
  {
    idx -= -8;
    if(idx &gt;= itemCount)
      idx = itemCount-1;
  }
  else
  {
    idx -= 8;
    if(idx &lt; 0)
      idx = 0;
  }

  print("new idx: "+idx);
  setFocusItemIndex(idx);
	setItemFocus(0);
  redrawDisplay();
  "true";
}
else if (userInput == "two" || userInput == "2")
{
 showIdle();
 url="http://127.0.0.1/cgi-bin/scripts/filme/php/movie2ks_add.php?mod=add*" + getItemInfo(getFocusItemIndex(),"link1") + "*" + getItemInfo(getFocusItemIndex(),"title1");
 dummy=getUrl(url);
 cancelIdle();
 redrawDisplay();
 ret="true";
}
ret;
</script>
</onUserInput>

	</mediaDisplay>

	<item_template>
		<mediaDisplay  name="threePartsView" idleImageXPC="5" idleImageYPC="5" idleImageWidthPC="8" idleImageHeightPC="10">
        <idleImage>image/POPUP_LOADING_01.png</idleImage>
        <idleImage>image/POPUP_LOADING_02.png</idleImage>
        <idleImage>image/POPUP_LOADING_03.png</idleImage>
        <idleImage>image/POPUP_LOADING_04.png</idleImage>
        <idleImage>image/POPUP_LOADING_05.png</idleImage>
        <idleImage>image/POPUP_LOADING_06.png</idleImage>
        <idleImage>image/POPUP_LOADING_07.png</idleImage>
        <idleImage>image/POPUP_LOADING_08.png</idleImage>
		</mediaDisplay>
	</item_template>

<channel>
	<title><?php echo $tit; ?></title>
	<menu>main menu</menu>


<?php

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookies.txt');
  curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookies.txt');
  $html = curl_exec($ch);
  curl_close($ch);


function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$html = str_between($html,'<TABLE id="tablemoviesindex">','</TABLE>');
$videos = explode('<TR', $html);
unset($videos[0]);
$videos = array_values($videos);
foreach($videos as $video) {
  $t1 = explode('href="', $video);
  $t2 = explode('"', $t1[1]);
  $link1 = $t2[0];
  if (strpos($link1,"http") ===false) {
    $link1="http://www.movie2k.to/".$link1;
  }
  
  $t3 = explode(">",$t1[1]);
  $t4 = explode("<",$t3[1]);
  $title = trim($t4[0]);
  $title=urlencode($title);
  $title=str_replace("%09","",$title);
  $title=str_replace("%2C","",$title);
  $title=str_replace("++","",$title);
  $title=urldecode($title);

  $data=str_between($video,'<TD id="tdmovies" width="175">',"</TD>");
  $data = preg_replace("/(<\/?)([^>]*>)/e","",$data);
  if ($data <> "") {
    $data="Date added: ".trim($data);
  } else {
    $data="";
  }

  for ($i=1;$i<10;$i++) {
  $t1=explode('src="',$video);
  $t2=explode('"',$t1[$i]);
  $image=$t2[0];
  if (preg_match("/flag|us|ger/i",$image)) break;
  }

	$link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/movie2ks_cat2.php?query='.$link1.",".urlencode($title);
	echo '
  <item>
    <link>'.$link.'</link>
    <title>'.$title.'</title>
    <title1>'.urlencode($title).'</title1>
    <link1>'.urlencode($link1).'</link1>
    <annotation>'.$data.'</annotation>
    <image>'.$image.'</image>
    <media:thumbnail url="'.$image.'" />
    <mediaDisplay name="threePartsView"/>
  </item>';
}
?>


</channel>
</rss>
