#!/usr/local/bin/Resource/www/cgi-bin/php
<?php echo "<?xml version='1.0' encoding='UTF8' ?>";
function str_between($string, $start, $end){
	$string = " ".$string; $ini = strpos($string,$start);
	if ($ini == 0) return ""; $ini += strlen($start); $len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}
$host = "http://127.0.0.1/cgi-bin";
$query = $_GET["file"];
if($query) {
   $queryArr = explode(',', $query);
   $link = urldecode($queryArr[0]);
   $pg_tit = urldecode($queryArr[1]);
   $pg_tit = str_replace("\'","'",$pg_tit);
}
$cookie="D://iplay.txt";
$cookie="/tmp/iplay.txt";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  $html = curl_exec($ch);
  curl_close($ch);
$t=explode('seriesDetailsImage"',$html);
$t1=explode('src="',$t[1]);
$t2=explode('"',$t1[1]);
$img=$t2[0];
$t4=explode("Genuri:",$t[1]);
$gen="Gen: ".trim(str_between($t4[1],"<span>","</span"));
$imdb="IMDB: ".trim(str_between($t[1],'seriesDetailsRating">','<'));
//<div class="collectionOverviewSmall">
//$desc=trim(str_between($t[1],'Descriere:','</div'));
$t3=explode("Descriere:",$t1[1]);
$desc=str_between($t3[1],'<span>','</span>');
$desc=str_replace("&#x27;","'",$desc);
$desc=str_replace("&nbsp;"," ",$desc);
$desc=str_replace("&raquo;",">>",$desc);
$desc=str_replace("&#xE9;","e",$desc);
$desc = trim(preg_replace("/<(.*)>|(\{(.*)\})/e","",$desc));
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
	itemWidthPC="15"
	itemHeightPC="8"
	capXPC="8"
	capYPC="25"
	capWidthPC="15"
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
		<!--<image offsetXPC=5 offsetYPC=2 widthPC=20 heightPC=16>
		  <script>channelImage;</script>
		</image>-->
  	<text redraw="yes" offsetXPC="85" offsetYPC="12" widthPC="10" heightPC="6" fontSize="20" backgroundColor="10:105:150" foregroundColor="60:160:205">
		  <script>sprintf("%s / ", focus-(-1))+itemCount;</script>
   </text>
		<text align="left" redraw="yes"
          lines="10" fontSize=17
		      offsetXPC=25 offsetYPC=45 widthPC=70 heightPC=50
		      backgroundColor=0:0:0 foregroundColor=200:200:200>
   <?php echo $desc; ?>
		</text>
		<image  redraw="yes" offsetXPC=25 offsetYPC=22.5 widthPC=30 heightPC=20>
        <?php echo $img; ?>
		</image>
  <text offsetXPC=57 offsetYPC=22.5 widthPC=45 heightPC=5 fontSize=16 backgroundColor=0:0:0 foregroundColor=200:200:200>
    <?php echo $gen; ?>
  </text>
  <text offsetXPC=57 offsetYPC=27.5 widthPC=45 heightPC=5 fontSize=16 backgroundColor=0:0:0 foregroundColor=200:200:200>
    <?php echo $imdb; ?>
  </text>
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
  			    if(focus==idx) "16"; else "14";
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
	<title><?echo $pg_tit; ?></title>
	<menu>main menu</menu>

<?php
$num=str_between($html,'class="tabListHeader"','</table>');

$v=explode("Episod 01",$html);
$c=count($v);
for ($i=1;$i<$c;$i++) {
   $t1=explode("<td>",$num);
   $t2=explode("</td>",$t1[$i]);
   $sez=$t2[0];
   $c1=explode("Season",$sez);
   $ss=trim($c1[1]);
   //$sez = "Season ".$i;
  //$link = 'http://127.0.0.1/cgi-bin/scripts/filme/php/iplay_s.php?file='.urlencode($link).','.urlencode($title1);
   $s=$pg_tit." ".$sez;
   $link1 = $host."/scripts/filme/php/iplay.php?file=".urlencode($link).",".urlencode($pg_tit).",".urlencode($i).",".$ss;
    echo '
    <item>
    <title>'.$sez.'</title>
    <link>'.$link1.'</link>
    <annotation>'.$s.'</annotation>
    <mediaDisplay name="threePartsView"/>
    </item>
    ';
}

?>
</channel>
</rss>
