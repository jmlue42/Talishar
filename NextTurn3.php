<head>

  <?php

  include 'Libraries/HTTPLibraries.php';

  //We should always have a player ID as a URL parameter
  $gameName = $_GET["gameName"];
  if (!IsGameNameValid($gameName)) {
    echo ("Invalid game name.");
    exit;
  }
  $playerID = TryGet("playerID", 3);
  if (!is_numeric($playerID)) {
    echo ("Invalid player ID.");
    exit;
  }
  $authKey = TryGet("authKey", 3);

  session_start();

  //First we need to parse the game state from the file
  include "WriteLog.php";
  include "ParseGamestate.php";
  include "GameTerms.php";
  include "GameLogic.php";
  include "HostFiles/Redirector.php";
  include "Libraries/UILibraries2.php";
  include "Libraries/StatFunctions.php";
  include "Libraries/PlayerSettings.php";

  if ($currentPlayer == $playerID) {
    $icon = "ready.png";
    $readyText = "You are the player with priority.";
  } else {
    $icon = "notReady.png";
    $readyText = "The other player has priority.";
  }
  echo '<link id="icon" rel="shortcut icon" type="image/png" href="./HostFiles/' . $icon . '"/>';

  $darkMode = IsDarkMode($playerID);

  if ($darkMode) $backgroundColor = "rgba(20,20,20,0.70)";
  else $backgroundColor = "rgba(255,255,255,0.70)";

  $borderColor = ($darkMode ? "#DDD" : "#1a1a1a");
  ?>


  <head>
    <meta charset="utf-8">
    <title>Talishar</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/gamestyle.css">
  </head>

  <script>
    function Hotkeys(event) {
      if (event.keyCode === 32) SubmitInput(99, ""); //Space = pass
      if (event.keyCode === 117) SubmitInput(10000, ""); //U = undo
      if (event.keyCode === 104) SubmitInput(3, "&cardID=0"); //H = hero ability
      if (event.keyCode === 109) ShowPopup("menuPopup"); //M = open menu
      <?php
      if (CardType($myCharacter[CharacterPieces()]) == "W") echo ("if(event.keyCode === 108) SubmitInput(3, '&cardID=" . CharacterPieces() . "');"); //L = left weapon
      if (CardType($myCharacter[CharacterPieces() * 2]) == "W") echo ("if(event.keyCode === 114) SubmitInput(3, '&cardID=" . (CharacterPieces() * 2) . "');"); //R = right weapon
      ?>
    }
  </script>

  <script src="./jsInclude.js"></script>

  <?php // TODO: find a way to move those styles to a stylesheet. Not sure why it's not working.
  ?>
  <style>
    :root {
      <?php if (IsDarkMode($playerID)) echo ("color-scheme: dark;");
      else echo ("color-scheme: light;");

      ?>
    }

    div,
    span {
      font-family: helvetica;
    }

    td {
      text-align: center;
    }

    .passButton {
      background: url("./Images/passActive.png") no-repeat;
      background-size: contain;
      transition: 150ms ease-in-out;
    }

    .passButton:hover {
      background: url("./Images/passHover.png") no-repeat;
      background-size: contain;
      -webkit-transform: scale(1.1);
      -ms-transform: scale(1.1);
      transform: scale(1.1);
    }

    .passButton:active {
      background: url("./Images/passPress.png") no-repeat;
      background-size: contain;
    }

    .passInactive {
      background: url("./Images/passInactive.png") no-repeat;
      background-size: contain;
    }

    .breakChain {
      background: url("./Images/chainLinkRight.png") no-repeat;
      background-size: contain;
      transition: 150ms ease-in-out;
    }

    .breakChain:hover {
      background: url("./Images/chainLinkBreak.png") no-repeat;
      background-size: contain;
      cursor: pointer;
      -webkit-transform: scale(1.3);
      -ms-transform: scale(1.3);
      transform: scale(1.3);
    }

    .breakChain:focus {
      outline: none;
    }

    .chainSummary {
      cursor: pointer;
      transition: 150ms ease-in-out;
    }

    .chainSummary:hover {
      -webkit-transform: scale(1.4);
      -ms-transform: scale(1.4);
      transform: scale(1.4);
    }

    .chainSummary:focus {
      outline: none;
    }

    .MenuButtons {
      cursor: pointer;
      transition: 150ms ease-in-out;
    }

    .MenuButtons:hover {
      -webkit-transform: scale(1.2);
      -ms-transform: scale(1.2);
      transform: scale(1.2);
    }

    .MenuButtons:focus {
      outline: none;
    }
  </style>

</head>

<body onkeypress='Hotkeys(event)' onload='OnLoadCallback(<?php echo (filemtime("./Games/" . $gameName . "/gamelog.txt")); ?>)'>

  <?php if ($theirCharacter[0] != "DUMMY") echo (CreatePopup("inactivityWarningPopup", [], 0, 0, "⚠️ Inactivity Warning ⚠️", 1, "", "", true, true, "Interact with the screen in the next 10 seconds or you could be kicked for inactivity.")); ?>
  <?php if ($theirCharacter[0] != "DUMMY") echo (CreatePopup("inactivePopup", [], 0, 0, "⚠️ You are Inactive ⚠️", 1, "", "", true, true, "You are inactive. Your opponent is able to claim victory. Interact with the screen to clear this.")); ?>

  <script>
    var IDLE_TIMEOUT = 40; //seconds
    var _idleSecondsCounter = 0;
    var _idleState = 0; //0 = not idle, 1 = idle warning, 2 = idle

    var activityFunction = function() {
      var oldIdleState = _idleState;
      _idleSecondsCounter = 0;
      _idleState = 0;
      var inactivityPopup = document.getElementById('inactivityWarningPopup');
      if (inactivityPopup) inactivityPopup.style.display = "none";
      var inactivePopup = document.getElementById('inactivePopup');
      if (inactivePopup) inactivePopup.style.display = "none";
      if (oldIdleState == 2) SubmitInput("100006", "");
    };

    document.onclick = activityFunction;

    document.onmousemove = activityFunction;

    document.onkeydown = activityFunction;

    window.setInterval(CheckIdleTime, 1000);

    function CheckIdleTime() {
      if (document.getElementById("iconHolder").innerText != "ready.png") return;
      _idleSecondsCounter++;
      if (_idleSecondsCounter >= IDLE_TIMEOUT) {
        if (_idleState == 0) {
          _idleState = 1;
          _idleSecondsCounter = 0;
          var inactivityPopup = document.getElementById('inactivityWarningPopup');
          if (inactivityPopup) inactivityPopup.style.display = "inline";
        } else if (_idleState == 1) {
          _idleState = 2;
          var inactivityPopup = document.getElementById('inactivityWarningPopup');
          if (inactivityPopup) inactivityPopup.style.display = "none";
          var inactivePopup = document.getElementById('inactivePopup');
          if (inactivePopup) inactivePopup.style.display = "inline";
          SubmitInput("100005", "");
        }
      }
    }
  </script>

  <audio id="yourTurnSound" src="./Assets/prioritySound.wav"></audio>

  <script>
    function reload() {
      CheckReloadNeeded(0);
    }

    function CheckReloadNeeded(lastUpdate) {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText.split("REMATCH")[0] == "1234") {
            location.replace('GameLobby.php?gameName=<?php echo ($gameName); ?>&playerID=<?php echo ($playerID); ?>&authKey=<?php echo ($authKey); ?>');
          } else if (parseInt(this.responseText) != 0) {
            HideCardDetail();
            var responseArr = this.responseText.split("ENDTIMESTAMP");
            document.getElementById("mainDiv").innerHTML = responseArr[1];
            CheckReloadNeeded(parseInt(responseArr[0]));
            var readyIcon = document.getElementById("iconHolder").innerText;
            document.getElementById("icon").href = "./HostFiles/" + readyIcon;
            var log = document.getElementById('gamelog');
            if (log !== null) log.scrollTop = log.scrollHeight;
            if (readyIcon == "ready.png") {
              var audio = document.getElementById('yourTurnSound');
              <?php if (!IsMuted($playerID)) echo ("audio.play();"); ?>
            }
            var animations = document.getElementById("animations").innerText;
            //if(animations != "") alert(animations);
          } else {
            CheckReloadNeeded(lastUpdate);
          }
        }
      };
      var dimensions = "&windowWidth=" + window.innerWidth + "&windowHeight=" + window.innerHeight;
      xmlhttp.open("GET", "GetNextTurn.php?gameName=<?php echo ($gameName); ?>&playerID=<?php echo ($playerID); ?>&lastUpdate=" + lastUpdate + "&authKey=<?php echo ($authKey); ?>" + dimensions, true);
      xmlhttp.send();
    }

    function chkSubmit(mode, count) {
      var input = "";
      input += "&gameName=" + document.getElementById("gameName").value;
      input += "&playerID=" + document.getElementById("playerID").value;
      input += "&chkCount=" + count;
      for (var i = 0; i < count; ++i) {
        var el = document.getElementById("chk" + i);
        if (el.checked) input += "&chk" + i + "=" + el.value;
      }
      SubmitInput(mode, input);
    }
  </script>

  <?php
  //Display hidden elements
  echo ("<div id='popupContainer'></div>");
  echo ("<div id=\"cardDetail\" style=\"z-index:100000; display:none; position:fixed;\"></div>");
  echo ("<div id='mainDiv' style='left:0px; top:0px; width:100%;height:100%;'></div>");
  if ($playerID != 3) {
    echo ("<div id='chatbox' style='position:fixed; bottom:0px; right:10px; width:200px; height: 32px;'>");
    echo ("<input style='margin-left: 4px; margin-right: 1px; width:140px; display:inline; border: 2px solid " . $borderColor . "; border-radius: 3px; font-weight: 500;' type='text' id='chatText' name='chatText' value='' autocomplete='off' onkeypress='ChatKey(event)'>");
    echo ("<button style='display:inline; border: 2px solid " . $borderColor . "; width:45px; color: #1a1a1a; border:" . $backgroundColor . "; padding: 0; font: inherit; cursor: pointer; outline: inherit; box-shadow: none;' onclick='SubmitChat()'>Chat</button>");
    echo ("</div>");
  }
  echo ("<input type='hidden' id='gameName' value='" . $gameName . "'>");
  echo ("<input type='hidden' id='playerID' value='" . $playerID . "'>");
  echo ("<input type='hidden' id='authKey' value='" . $authKey . "'>");
  ?>

</body>