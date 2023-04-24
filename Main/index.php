

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">    
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<style>
body {
  font-family: Bahnschrift;
  margin:0px
}
#ch{
  float: right;
}
.sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 0;
  top: 0;
  left: 0;
  background-color: rgb(21, 164, 186);
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
  text-align: left;
  float: left;
  z-index: 1;
}

.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 15px;
  color: #ffffff;
  display: inline-block;
  transition: 0.3s;
}

.sidebar a:hover {
  color: #f1f1f1;
}

.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}
.logopic{
  font-size: 20px;
  float:left;
  width: 10px;
  margin: 20px;
}
.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: rgb(21, 164, 186);
  color: white;
  padding: 6px 10px;
  border: none;
  margin: 20px;
}
.btnbtn-light{
  float:right;
  width: 44px ;
  height: 44px;
  border-radius: 5px;
  padding: 6px 10px;
  margin: 20px;
  cursor: pointer;
}
span {
  content: "\263C";
}
.openbtn:hover {
  background-color: #444;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}
form {
  margin: 20px;
  background-color: #ffffff;
  width: 300px;
  height: x;
  border-radius: 5px;
  display:flex;
  float:right;
  flex-direction:row;
  align-items:center;
}
input {
  all: unset;
  font: 16px system-ui;
  color: #000000;
  height: 100%;
  width: 100%;
  padding: 6px 10px;
  font-family: Bahnschrift;
}
::placeholder {
  color: #000000;
  opacity: 0.7; 
}
svg {
  color: #fff;
  fill: currentColor;
  width: 24px;
  height: 24px;
  position: relative;
}
.searchbutton {
  all: unset;
  cursor: pointer;
  width: 44px;
  height: 44px;
}
.navigationbar{
  position: fixed;
  width: 100%;
  background-color: rgb(21, 164, 186);
  overflow: auto;
  z-index: 0;
}
.upperbar{
  margin: 1;
  padding: 0;
  list-style: none;
  line-height: 60px;
}
.menubtn{
  float: left;
}
.popular{
  align-items: center;
}
.popular .popular_content{
font-size: 30px;
text-align: left;
}
.topcreators{
  border-width: 100px;
}
.topcreators .topcreators_content{
  font-size: 30px;
  text-align: left;
}
.foryou{
  border-width: 100px;
}
.foryou .foryou_content{
  font-size: 30px;
  text-align: left;
}
.Home{
  align-self: center;
}
.admin{
  text-align:center;
  color:white;
  font-family:Bahnschrift;
}
.upload{
text-align: center;
align-items: center;
justify-content: center;
 margin-top:150px ;
  }

@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
</style>
<link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
   <title>Home
  </title> 
  
  <link rel="icon" type="image" href="Logo3.png">
        <?php
        $error="";
        include("config.php");
     
        if(isset($_POST['but_upload'])){
            $maxsize = 10242880; // 5MB
                       
            $name = $_FILES['file']['name'];
            $target_dir = "videos/";
            $target_file = $target_dir . $_FILES["file"]["name"];

            // Select file type
            $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

            // Check extension
            if( in_array($videoFileType,$extensions_arr) ){
                
                // Check file size
                if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
                    echo "File too large. File must be less than 5MB.";
                }else{
                    // Upload
                    if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
                        // Insert record
                        $query = "INSERT INTO videos(name,location) VALUES('".$name."','".$target_file."')";

                        mysqli_query($con,$query);
                        $error.= "<p>Upload successfully.</p>";
                    }
                }

            }else{
                echo "Invalid file extension.";
            }
        
        }
        ?>
</head>
<body>



<div id="mySidebar" class="sidebar">
  <div class="logopic2">
    <a href="Main.php">
    <img src="Logo1.png" alt="logo">
  </a>
  </div>

  <h1 class="admin">
    Admin
  </h1>
  <hr>
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a><br>
  
      <a href="#">
      <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-wide" viewBox="0 0 16 16">
        <path d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434L8.932.727zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z"/>
      </svg>
        Settings</p></a><br>
      <a href="#">
        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
          <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646.087.065-.087-.065z"/>
        </svg>
        Admin settings</p>
      </a><br>
      <hr>
      <a class="profile" href="#">
      </p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-person-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
      </svg>
      Profile</p>
    </a><br>
      <a href="/dashboard/Home.php">
        <p style="text-align: right;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
          <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
        </svg>
         Logout</p>
      </a><br>
    <hr>
</div>
<nav class="navigationbar ">
  <dl class="upperbar">
    <dd class="logopic">
      <a href="Main.php">
      <img src="Logo1.png" alt="logo">
    </a>
    </dd>
    <dd class="menubtn">
      <button class="openbtn" onclick="openNav()">☰</button>  
    </dd>
    <dd>
      <button type="button" class="btnbtn-light" onclick="font()"><span class="bi bi-moon" id="ch"></span></button>
    </dd>
  </dl>
<form role="search" id="form">
  <input type="search" id="query" name="q" placeholder="Search" aria-label="Search through site content">
  <button class="searchbutton">
    <svg style="color: #000000;" viewBox="0 0 1024 1024"><path class="path1" d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z"></path></svg>
  </button>
</form>
</nav>
<div id="main" class="main">
<p> Welocom Please Upload Your Files</p>

<div class="upload">
<form style="font-size=400px"class= "form" method="post" action="" enctype='multipart/form-data'>
            <input type='file' name='file' />
            <input type='submit' value='Upload' name='but_upload'>
<?php echo $error; ?>
      </form>
</div>

 
</div>
</div>
<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
<script>
  const f = document.getElementById('form');
  const q = document.getElementById('query');
  const google = '#';
  const site = '#';

  function submitted(event) {
    event.preventDefault();
    const url = google + site + '+' + q.value;
    const win = window.open(url, '_blank');
    win.focus();
  }

  f.addEventListener('submit', submitted);
  var p=0;
  function font(){
  if(p==0){
    document.body.style.backgroundColor= "black";
    document.body.style.color="white";
    document.getElementById('ch').className = "bi bi-sun";
  p++;}
  else if(p==1){
    document.body.style.backgroundColor= "white";
    document.body.style.color="black";
    document.getElementById('ch').className = "bi bi-moon";
  p--;
  }}
</script>


</body>
</html> 