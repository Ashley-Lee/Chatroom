<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="res/css/index.css" />
    <title>Home page</title>
  </head>
  <body>
    <div class="container">
      <h2 style="color: #52555c;">Virtual Chatting Room</h2>
      <br />
      <div id="chat-window">
        <div class="message"></div>
      </div>
      <div id="msg"><form method="post" action="add1235.php" name="form" >
        <input id="msg-input" name="message" type="text" />
        <input type="submit" name="Submit" value="Send" 
          id="send"
          onclick="appendMessage(document.getElementById('msg-input').value)"
        />
        </form>
      </div>
    </div>
  </body>
  
  <script type="text/javascript" src="res/js/jquery-3.2.1.min.js"></script>

  <script>

  let addedToDB = 1;

$('form[name=form]').submit(function(e) {
   e.preventDefault();
   window.scrollTo(5000,500);

   // a sample AJAX request
   if (addedToDB == 0) {
    $.ajax({
      url : this.action,
      type : this.method,
      data : $(this).serialize(),
      success : function(response) {

      }
    });
    addedToDB = 1;
  }
});

    var messageCount = 0;
    var messages = ["Hello, I am Sam. Nice to e-meet you.", "<span style='color: blue'> Experimenter: Great, we will give you both an icebreaker question to help get to know each other. <b> How about describing your plans for the next weekend? </b> </p> </span>", "I'm going to New Jersey next week because of a jury duty. It’s a bummer that I have to do the jury duty during the semester. This is the view of my hometown in New Jersey where I will stay for a couple of days."];
    var botmessagesent = 0;
    var currentBotMessage = 0;

    $(document).ready(function() {
           timeoutwd("<span style='color: blue'> Experimenter: Another participant enters a chatting room. </span>", 1500);
      timeoutwd("<span style='color: blue'> Experimenter: Now you may start to chat! Do not exit the chatroom until instructed to do so. </span>", 4000);
      timeoutBot(messages[0], 7000);
    });
    

    function timeoutwd(message, time) {
      setTimeout(function() {       
        appendMessagewd(message);
        if(currentBotMessage > 0) {
        botmessagesent = 1;
        addedToDB = 0;
        currentBotMessage++;
      }
      }, time);
    }

    function timeout(message, time) {
      setTimeout(function() {
        appendMessage(message);
      }, time);
    }
    function timeoutBot(message, time) {
      setTimeout(function() {
        appendMessageBot(message);
        botmessagesent = 1;
        addedToDB = 0;
        if(currentBotMessage == 2) {
          document.getElementById("msg-input").disabled = true;
          document.getElementById("send").disabled = true;
          timeoutwd("<span style='color: blue'> Experimenter: Time is done. <b> Please click the arrow button at the right bottom of this page </b></span>",15000)
        }
        currentBotMessage++;
      }, time);
      
    }

    function appendMessage(message) {
      if (message == "") return;
      var div = document.createElement("div");
      div.setAttribute("class", "message");
      div.innerHTML = getTime() + " >> " + message;
      if (currentBotMessage ==2) {
        document.getElementById("chat-window").appendChild(div);
        appendImage("NewJersey.jpg", 15000);
      }
      else {
        document.getElementById("chat-window").appendChild(div);
      }
      let objDiv = document.getElementById("chat-window");
      objDiv.scrollTop = objDiv.scrollHeight;
      
      
      if(botmessagesent == 1) {
        botmessagesent = 0;
        if(currentBotMessage != 1)
          timeoutBot(messages[currentBotMessage], 12000);
        else
          timeoutwd(messages[currentBotMessage], 15000)
      }
      setTimeout(() => {
        document.getElementById("msg-input").value = "";
      }, 200);
      
    }


    function appendMessageBot(message) {
      if (message == "") return;
      var div = document.createElement("div");
      div.setAttribute("class", "message");
      div.innerHTML = getTime() + " >> " + message;
      document.getElementById("chat-window").appendChild(div);
      let objDiv = document.getElementById("chat-window");
      objDiv.scrollTop = objDiv.scrollHeight;

    }

    function appendMessagewd(message) {
      if (message == "") return;
      var div = document.createElement("div");
      div.setAttribute("class", "message");
      div.innerHTML = message;
      document.getElementById("chat-window").appendChild(div);
      let objDiv = document.getElementById("chat-window");
      objDiv.scrollTop = objDiv.scrollHeight;
    }

    function appendImage(src, time) {
      var img = document.createElement("img")
      img.setAttribute("src", src);
      img.setAttribute("width", "100%");
      img.setAttribute("height", "auto");
      setTimeout(function() {
        document.getElementById("chat-window").appendChild(img);
      }, time);
    }


    function getTime() {
      var today = new Date();
      return (
        "(" +
        today.getHours() +
        ":" +
        today.getMinutes() +
        ":" +
        today.getSeconds() +
        ") "
      );
    }
  </script>
</html>


