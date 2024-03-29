<?php

include "WriteLog.php";
include "Libraries/HTTPLibraries.php";
include "Libraries/SHMOPLibraries.php";
include "APIKeys/APIKeys.php";

session_start();
$gameName = $_GET["gameName"];
if (!IsGameNameValid($gameName)) {
  echo ("Invalid game name.");
  exit;
}
$playerID = intval($_GET["playerID"]);
$deck = TryGet("deck");
$decklink = $_GET["fabdb"];
$decksToTry = TryGet("decksToTry");
$favoriteDeck = TryGet("favoriteDeck", "0");
$favoriteDeckLink = TryGet("favoriteDecks", "0");
$set = TryGet("set");

if(GetCachePiece($gameName, $playerID + 6) != "")
{
  $_SESSION['error'] = '⚠️ Another player has already joined the game.';
  header("Location: MainMenu.php");
  die();
}

if ($decklink == "" && $deck == "" && $favoriteDeckLink == "0") {
  switch ($decksToTry) {
    case '1':
      $decklink = "https://fabdb.net/decks/VGkQMojg";
      break;
    case '2':
      $decklink = "https://fabdb.net/decks/eLxddlzb";
      break;
    case '3':
      $decklink = "https://fabdb.net/decks/ydeXXEzW";
      break;
    case '4':
      $decklink = "https://fabdb.net/decks/GnlPKqaO";
      break;
    case '5':
      $decklink = "https://fabdb.net/decks/omKmlPDV";
      break;
    case '6':
      $decklink = "https://fabdb.net/decks/OldYPAwm";
      break;
    case '7':
      $decklink = "https://fabdb.net/decks/WAPZxDEQ";
      break;
    case '8':
      $decklink = "https://fabdb.net/decks/nnlVMAEG";
      break;
    case '9':
      $decklink = "https://fabrary.net/decks/01G7FCP2N7N0MNHWAH6JTP0KFN";
      break;
    case '10':
      $decklink = "https://fabrary.net/decks/01G7B1T1D1M2DAM61K876VJBDK";
      break;
    case '11':
      $decklink = "https://fabrary.net/decks/01G7FD2B3YQAMR8NJ4B3M58H96";
      break;
    case '12':
      $decklink = "https://fabrary.net/decks/01G7FDVRZP35DFWBRK64AG5TKQ";
      break;
    case '13':
      $decklink = "https://fabrary.net/decks/01G7K464J7VS0K7HKW5E395TBK";
      break;
    case '14':
      $decklink = "https://fabrary.net/decks/01G7K4D304QQCZZSBT7ABCX4XC";
      break;
    case '15':
      $decklink = "https://fabrary.net/decks/01G7K3WGPVKVDXG2J013GXSXNP";
      break;
    case '16':
      $decklink = "https://fabrary.net/decks/01G76H7RG7GN5ZA10F3BJBH740";
      break;
    case '17':
      $decklink = "https://fabrary.net/decks/01G76H1R1ERRBRKS7RVCQAB8RX";
      break;
    default:
      $decklink = "https://fabdb.net/decks/VGkQMojg";
      break;
  }
}

if ($favoriteDeckLink != "0" && $decklink == "") $decklink = $favoriteDeckLink;

if ($deck == "" && !IsDeckLinkValid($decklink)) {
  echo '<b>' . "Deck URL is not valid: " . $decklink . '</b>';
  exit;
}

include "HostFiles/Redirector.php";
include "CardDictionary.php";
include "MenuFiles/ParseGamefile.php";
include "MenuFiles/WriteGamefile.php";

if ($playerID == 2 && $gameStatus >= $MGS_Player2Joined) {
  if ($gameStatus >= $MGS_GameStarted) {
    header("Location: " . $redirectPath . "/NextTurn4.php?gameName=$gameName&playerID=3");
  } else {
    header("Location: " . $redirectPath . "/MainMenu.php");
  }
  WriteGameFile();
  exit;
}

if ($decklink != "") {
  if($playerID == 1) $p1DeckLink = $decklink;
  else if($playerID == 2) $p2DeckLink = $decklink;
  $curl = curl_init();
  $isFaBDB = str_contains($decklink, "fabdb");
  if ($isFaBDB) {
    $decklinkArr = explode("/", $decklink);
    $slug = $decklinkArr[count($decklinkArr) - 1];
    $apiLink = "https://api.fabdb.net/decks/" . $slug;
  } else {
    $headers = array(
      "x-api-key: " . $FaBraryKey,
      "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $decklinkArr = explode("/", $decklink);
    $slug = $decklinkArr[count($decklinkArr) - 1];
    $apiLink = "https://5zvy977nw7.execute-api.us-east-2.amazonaws.com/prod/decks/" . $slug;
  }

  curl_setopt($curl, CURLOPT_URL, $apiLink);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $apiDeck = curl_exec($curl);
  curl_close($curl);

  if ($apiDeck === FALSE) {
    echo  '<b>' . "FabDB API for this deck returns no data: " . implode("/", $decklink) . '</b>';
    WriteGameFile();
    exit;
  }
  $deckObj = json_decode($apiDeck);
  $deckName = $deckObj->{'name'};
  $cards = $deckObj->{'cards'};
  $deckCards = "";
  $sideboardCards = "";
  $headSideboard = "";
  $chestSideboard = "";
  $armsSideboard = "";
  $legsSideboard = "";
  $offhandSideboard = "";
  $unsupportedCards = "";
  $character = "";
  $head = "";
  $chest = "";
  $arms = "";
  $legs = "";
  $offhand = "";
  $weapon1 = "";
  $weapon2 = "";
  $weaponSideboard = "";
  $totalCards = 0;

  if (is_countable($cards)) {
    for ($i = 0; $i < count($cards); ++$i) {
      $count = $cards[$i]->{'total'};
      $numSideboard = $cards[$i]->{'sideboardTotal'};
      if ($isFaBDB) {
        $printings = $cards[$i]->{'printings'};
        $printing = $printings[0];
        $sku = $printing->{'sku'};
        $id = $sku->{'sku'};
        $id = explode("-", $id)[0];
      } else {
        $id = $cards[$i]->{'cardIdentifier'};
      }
      $id = GetAltCardID($id);
      $cardType = CardType($id);
      if ($cardType == "") //Card not supported, error
      {
        if ($unsupportedCards != "") $unsupportedCards .= " ";
        $unsupportedCards .= $id;
      } else if ($cardType == "C") {
        $character = $id;
      } else if ($cardType == "W") {
        for ($j = 0; $j < ($count - $numSideboard); ++$j) {
          if ($weapon1 == "") $weapon1 = $id;
          else if ($weapon2 == "") $weapon2 = $id;
          else {
            if ($weaponSideboard != "") $weaponSideboard .= " ";
            $weaponSideboard .= $id;
          }
        }
        for ($j = 0; $j < $numSideboard; ++$j) {
          if ($weaponSideboard != "") $weaponSideboard .= " ";
          $weaponSideboard .= $id;
        }
      } else if ($cardType == "E") {
        $subtype = CardSubType($id);
        if ($numSideboard == 0) {
          switch ($subtype) {
            case "Head":
              if ($head == "") $head = $id;
              else {
                if ($headSideboard != "") $headSideboard .= " ";
                $headSideboard .= $id;
              }
              break;
            case "Chest":
              if ($chest == "") $chest = $id;
              else {
                if ($chestSideboard != "") $chestSideboard .= " ";
                $chestSideboard .= $id;
              }
              break;
            case "Arms":
              if ($arms == "") $arms = $id;
              else {
                $armsSideboard .= " ";
                $armsSideboard .= $id;
              }
              break;
            case "Legs":
              if ($legs == "") $legs = $id;
              else {
                if ($legsSideboard != "") $legsSideboard .= " ";
                $legsSideboard .= $id;
              }
              break;
            case "Off-Hand":
              if ($offhand == "") $offhand = $id;
              else {
                if ($offhandSideboard != "") $offhandSideboard .= " ";
                $offhandSideboard .= $id;
              }
              break;
            default:
              break;
          }
        } else {
          switch ($subtype) {
            case "Head":
              if ($headSideboard != "") $headSideboard .= " ";
              $headSideboard .= $id;
              break;
            case "Chest":
              if ($chestSideboard != "") $chestSideboard .= " ";
              $chestSideboard .= $id;

              break;
            case "Arms":
              if ($armsSideboard != "") $armsSideboard .= " ";
              $armsSideboard .= $id;
              break;
            case "Legs":
              if ($legsSideboard != "") $legsSideboard .= " ";
              $legsSideboard .= $id;
              break;
            case "Off-Hand":
              if ($offhandSideboard != "") $offhandSideboard .= " ";
              $offhandSideboard .= $id;
              break;
            default:
              break;
          }
        }
      } else {
        $numMainBoard = ($isFaBDB ? $count - $numSideboard : $count);
        for ($j = 0; $j < $numMainBoard; ++$j) {
          if ($deckCards != "") $deckCards .= " ";
          $deckCards .= $id;
        }
        for ($j = 0; $j < $numSideboard; ++$j) {
          if ($sideboardCards != "") $sideboardCards .= " ";
          $sideboardCards .= $id;
        }
        $totalCards += $numMainBoard + $numSideboard;
      }
    }
  } else {
    $_SESSION['error'] = '⚠️ The decklist link you have entered might be invalid or contain invalid cards (e.g Tokens).\n\nPlease double-check your decklist link and try again.';
    header("Location: MainMenu.php");
    die();
  }

  if ($unsupportedCards != "") {
    echo ("⚠️ The following cards are not yet supported: " . $unsupportedCards);
  }

  //We have the decklist, now write to file
  $filename = "./Games/" . $gameName . "/p" . $playerID . "Deck.txt";
  $deckFile = fopen($filename, "w");
  $charString = $character;
  if ($weapon1 != "") $charString .= " " . $weapon1;
  if ($weapon2 != "") $charString .= " " . $weapon2;
  if ($offhand != "") $charString .= " " . $offhand;
  if ($head != "") $charString .= " " . $head;
  if ($chest != "") $charString .= " " . $chest;
  if ($arms != "") $charString .= " " . $arms;
  if ($legs != "") $charString .= " " . $legs;
  fwrite($deckFile, $charString . "\r\n");
  fwrite($deckFile, $deckCards . "\r\n");
  fwrite($deckFile, $headSideboard . "\r\n");
  fwrite($deckFile, $chestSideboard . "\r\n");
  fwrite($deckFile, $armsSideboard . "\r\n");
  fwrite($deckFile, $legsSideboard . "\r\n");
  fwrite($deckFile, $offhandSideboard . "\r\n");
  fwrite($deckFile, $weaponSideboard . "\r\n");
  fwrite($deckFile, $sideboardCards);
  fclose($deckFile);
  copy($filename, "./Games/" . $gameName . "/p" . $playerID . "DeckOrig.txt");

  if ($favoriteDeck == "on" && isset($_SESSION["userid"])) {
    //Save deck
    require_once './includes/functions.inc.php';
    include_once "./includes/dbh.inc.php";
    addFavoriteDeck($_SESSION["userid"], $decklink, $deckName, $character);
  }
} else {
  $character = "";
  $deckOptions = explode("-", $deck);
  if ($deckOptions[0] == "DRAFT") {
    if ($set == "WTR") $deckFile = "./WTRDraftFiles/Games/" . $deckOptions[1] . "/LimitedDeck.txt";
    else $deckFile = "./DraftFiles/Games/" . $deckOptions[1] . "/LimitedDeck.txt";
  }
  if ($deckOptions[0] == "SEALED") {
    $deckFile = "./SealedFiles/Games/" . $deckOptions[1] . "/LimitedDeck.txt";
  } else {
    switch ($deck) {
      case "oot":
        $deckFile = "p1Deck.txt";
        break;
      case "shawn":
        $deckFile = "shawnTAD.txt";
        break;
      case "dori":
        $deckFile = "Dori.txt";
        break;
      case "katsu":
        $deckFile = "Katsu.txt";
        break;
      default:
        $deckFile = "p1Deck.txt";
        break;
    }
  }
  copy($deckFile, "./Games/" . $gameName . "/p" . $playerID . "Deck.txt");
  copy($deckFile, "./Games/" . $gameName . "/p" . $playerID . "DeckOrig.txt");
}

if ($playerID == 2) {

  $gameStatus = $MGS_Player2Joined;
  if (file_exists("./Games/" . $gameName . "/gamestate.txt")) unlink("./Games/" . $gameName . "/gamestate.txt");

  $firstPlayerChooser = 1;
  $p1roll = 0;
  $p2roll = 0;
  $tries = 10;
  while ($p1roll == $p2roll && $tries > 0) {
    $p1roll = rand(1, 6) + rand(1, 6);
    $p2roll = rand(1, 6) + rand(1, 6);
    WriteLog("Player 1 rolled $p1roll and Player 2 rolled $p2roll.");
    --$tries;
  }
  $firstPlayerChooser = ($p1roll > $p2roll ? 1 : 2);
  WriteLog("Player $firstPlayerChooser chooses who goes first.");
  $gameStatus = $MGS_ChooseFirstPlayer;
  $joinerIP = $_SERVER['REMOTE_ADDR'];
}

if ($playerID == 1 && isset($_SESSION["useruid"])) $p1uid = $_SESSION["useruid"];
if ($playerID == 2 && isset($_SESSION["useruid"])) $p2uid = $_SESSION["useruid"];
if ($playerID == 1 && isset($_SESSION["userid"])) $p1id = $_SESSION["userid"];
if ($playerID == 2 && isset($_SESSION["userid"])) $p2id = $_SESSION["userid"];
if ($playerID == 1 && isset($_SESSION["isPatron"])) $p1IsPatron = "1";
if ($playerID == 2 && isset($_SESSION["isPatron"])) $p2IsPatron = "1";

if($playerID == 2) $p2Key = hash("sha256", rand() . rand() . rand());

WriteGameFile();
SetCachePiece($gameName, $playerID + 1, strval(round(microtime(true) * 1000)));
SetCachePiece($gameName, $playerID + 3, "0");
SetCachePiece($gameName, $playerID + 6, $character);
GamestateUpdated($gameName);

//$authKey = ($playerID == 1 ? $p1Key : $p2Key);
//$_SESSION["authKey"] = $authKey;
if($playerID == 1) $_SESSION["p1AuthKey"] = $p1Key;
if($playerID == 2) $_SESSION["p2AuthKey"] = $p2Key;
session_write_close();
header("Location: " . $redirectPath . "/GameLobby.php?gameName=$gameName&playerID=$playerID");

function GetAltCardID($cardID)
{
  switch ($cardID) {
    case "OXO001":
      return "WTR155";
    case "OXO002":
      return "WTR156";
    case "OXO003":
      return "WTR157";
    case "OXO004":
      return "WTR158";
    case "BOL002":
      return "MON405";
    case "BOL006":
      return "MON400";
    case "CHN002":
      return "MON407";
    case "CHN006":
      return "MON401";
    case "LEV002":
      return "MON406";
    case "LEV005":
      return "MON400";
    case "PSM002":
      return "MON404";
    case "PSM007":
      return "MON402";
    case "FAB015":
      return "WTR191";
    case "FAB016":
      return "WTR162";
    case "FAB023":
      return "MON135";
    case "FAB024":
      return "ARC200";
    case "FAB030":
      return "DYN030";
    case "FAB057":
      return "EVR063";
    case "DVR026":
      return "WTR182";
    case "RVD008":
      return "WTR006";
    case "UPR209":
      return "WTR191";
    case "UPR210":
      return "WTR192";
    case "UPR211":
      return "WTR193";
    case "HER075": 
      return "DYN025";
    case "LGS112": 
      return "DYN070";
    case "LGS116":
      return "DYN200";
    case "LGS117":
      return "DYN201";
    case "LGS118":
      return "DYN202";
    case "ARC218":
    case "UPR224":
    case "MON306":
    case "ELE237": //Cracked Baubles
      return "WTR224";
  }
  return $cardID;
}
