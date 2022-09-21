<?php

$start = 0;
$rowperpage = 3;
if(isset($_POST['start'])){
   $start = mysqli_real_escape_string($con,$_POST['start']); 
}
if(isset($_POST['rowperpage'])){
   $rowperpage = mysqli_real_escape_string($con,$_POST['rowperpage']); 
}

// selecting posts
$query = 'SELECT * FROM posts limit '.$start.','.$rowperpage;

$result = mysqli_query($con,$query);

$html = '';

while($row = mysqli_fetch_array($result)){
   $id = $row['id'];
   $title = $row['title'];
   $content = $row['description'];
   $shortcontent = substr($content, 0, 160)."...";
   $link = $row['link'];

   // Creating HTML structure
   $html .= '<div id="post_'.$id.'" class="post">';
   $html .= '<h2>'.$title.'</h2>';
   $html .= '<p>'.$shortcontent.'</p>';
   $html .= "<a href='".$link."' target='_blank' class='more'>More</a>";
   $html .= '</div>';

}

echo $html;

?>