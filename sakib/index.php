<?php
session_start();
if(!isset($_SESSION['user_id'])) header("Location: login.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>AI Chatbot Pro</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="chat-container">
<h2>AI Chatbot</h2>
<div id="chat-box"></div>

<div class="input-area">
<input type="text" id="user-input" placeholder="Type message...">
<button onclick="sendMessage()">Send</button>
</div>

<?php if($_SESSION['role']=='admin'): ?>
<a href="admin.php">Admin Panel</a>
<?php endif; ?>
</div>

<script>
function sendMessage(){
    let input = document.getElementById("user-input");
    let message = input.value;
    if(message.trim()==="") return;

    let box = document.getElementById("chat-box");
    box.innerHTML += "<div class='user'>"+message+"</div>";
    box.innerHTML += "<div class='bot typing'>Typing...</div>";

    fetch("chat.php", {
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:"message="+encodeURIComponent(message)
    })
    .then(res=>res.text())
    .then(data=>{
        document.querySelector(".typing").remove();
        box.innerHTML += "<div class='bot'>"+data+"</div>";
        box.scrollTop = box.scrollHeight;
    });

    input.value="";
}
</script>

</body>
</html>
