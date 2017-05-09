<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Homepage</title>

<style>
html{
	padding: 0px;
	margin: 0px;
}
body{
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color:#CCC;
	width:100%;
	min-height: auto;	
}

#container{
	border:1px solid #000;
	min-height:auto;
}

header{
	padding:0px;
	margin:0px;
	height:75px;
	background-color:#0F6;
}
#left{
	float: left;
}
#left li{
	list-style-type:none;
	margin:0px;
	padding:0px;
	font-size:26px;
	font-family:Arial, Helvetica, sans-serif;
}
#right{
	float:right;
	margin-top: 20px;
}
#right ul{
	padding-bottom:0px;
}
#right li{
	list-style-type:none;
	margin:0px;
	padding:0px;
	font-size:16px;
	display: inline-block;
	font-family:Arial, Helvetica, sans-serif;
	text-transform:uppercase;
}
#right a{
	text-decoration:none;
	border:1px solid;
	margin-right:25px;
	padding:5px;
	border-radius:10px;
}
#right a:hover{
	color:#930;
}
#main{
	width:100%;
	min-height:auto;
}
nav{
	
	float:left;
	width:25%;
	background-color:#CFBFFF;
	height:525px;
	overflow: auto;
}

nav ul{
	padding-left:10px;
	list-style-type:none;
	font-size:25px;
}

section{
	height:525px;
	background-color:#FFFF9D;
}
#chatarea{
	width:75%;
	height:475px;
	overflow:auto;
}

#chatbox{
	width:75%;
	height:50px;
}

footer{
	width: 100%;
	height:50px;
	background-color:#4FE365;
	padding:10px;
}

</style>

</head>

<body>
<div id="container">
	<!-- header for showing banner and links for other pages-->
	<header>
    	<div id="left">
        	<ul>
            	<li>Family Connection</li>  
            </ul>
        </div>
        <div id="right">
        <!-- Links for other pages-->
        
        	<ul>
            	<a href=""><li>Home</li></a>
                <a href="" active><li>Chat</li></a>
                <a href=""><li>Log Out</li></a>
            </ul>
        </div>
    </header>
    
    <!-- End of header -->
    
    
    <!-- nav sidebar for showing friends and group list-->
    <div id="main">
    <nav>
    
    	<ul>
        	<li><img src="">Friend 1</li>     <!-- If friends pic is inserted then add the src path-->
            <hr>  								<!-- Use php loop to fill up the friends and group list-->
            <li>Friend 2</li>
        </ul>
    
    </nav>
    
    <!-- End of nav sidebar -->
    
    <!-- Section for Chatting -->
    
    <section>
    <div id="chatarea">
    </div>
    <div id="chatbox">
    	<form method="post" action="">
        	<textarea cols="90" rows="1"></textarea>
            <input type="submit" name="Submit">
        </form>
    </div>
    </section>
    
    
    <!-- End of section-->
    
    </div>
    <!-- fOOTER portion -->
    <footer>
    	<h4 align="center">&copy; Copyright to Family-Connection</h4>
    </footer>
    <!-- End of footer-->
</div>
</body>
</html>