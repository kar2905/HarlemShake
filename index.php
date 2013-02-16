<?php
$ch = curl_init("https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=50&order=date&q=harlem+shake&type=video&videoDuration=short&fields=items&key=AIzaSyCNWA-5u4bP8v80Msft_e54-JwAFNmGviA");

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$videoIDs = array();
$title[] = array();
$description=array();
$out = curl_exec($ch);
//var_dump($out);
//var_dump($out);
//echo "---------<br/>";
$json = json_decode($out, TRUE);
//var_dump($json);
//echo "---------<br/>";
//var_dump("hello");
$items = $json["items"];
//var_dump($json['kind']);
//var_dump("dump");
//var_dump($items);
//echo "---------<br/>";
//echo "---------<br/>";

foreach($items as $item){
	$videoIDs[] = $item["id"]["videoId"];
	$title[] = $item["snippet"]["title"];
	$description[] = $item["snippet"]["description"];
}
//var_dump($videoIDs);
curl_close($ch);
?>
<html>
<head>
<meta property="og:title" content="Watch Harlem Shake on an endless loop"/>
<meta property="og:url" content="http://watchharlemshake.com"/>
<title>Watch Harlem Shake on an endless loop</title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
</head>

<body>
    <div class="content">
    	<h2>Watch Harlem Shake on an endless loop</h2>
	    <div id="player" class="video-holder"></div>

		<div class="vid_desc_container text">
            <h3></h3>
            <br/>
            <div class="vid_desc"></div>
		</div>
	</div>
</body>


</html>
 <script>
        var hit=0;
        var videoPlayedCounter = 0;        
        var video= <?php echo json_encode($videoIDs); ?>;
        //var video= ["J6GDz1qQGNw","2C15bBUiKJA","I8JHrjPXxag","0kSSw0_GHCE","67GylQFf-6E"];

        var desc= <?php echo json_encode($description); ?>; 
        var title= <?php echo json_encode($title); ?>;
        //var points= <?php echo json_encode($points); ?>;
        //var min_dur= <?php echo json_encode($min_dur); ?>;
        //var msgid= <?php echo json_encode($msgid); ?>;
        //var url= <?php echo json_encode($url); ?>;
        //var seen= <?php echo json_encode($seen); ?>;
        var player;
                        
        var tag = document.createElement('script');
                                
        tag.src = "//www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                        
        function onYouTubeIframeAPIReady() {
            showVideoContent();
            player = new YT.Player('player', {
                height: '600',
                width: '600',
                videoId: video[videoPlayedCounter],
                playerVars: { 'autoplay': 1, 'rel':0, 'autohide':1,  'theme': 'light' , 'origin': ''},
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }   
        function onPlayerReady(event) {
            event.target.playVideo();
            total=player.getDuration();                 
        }
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING ) {
                //setInterval(countit, 1000);
            }
            if (event.data == YT.PlayerState.ENDED ) {
                videoPlayedCounter++;
                hit=0;
                player.loadVideoById(video[videoPlayedCounter]);
                showVideoContent();
            }
        }
          function showVideoContent(){
            $(".vid_desc_container h3").html(title[videoPlayedCounter]);
            $(".vid_desc_container .vid_desc").html(desc[videoPlayedCounter]);
                                                 
        }

</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38543971-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>