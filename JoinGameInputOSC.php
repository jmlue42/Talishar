<?php

exit;

include "HostFiles/Redirector.php";
include "CardDictionary.php";

$gameName = $_GET["gameName"];
$playerID = $_GET["playerID"];
$deck = $_GET["deck"];
$decklink = $_GET["fabdb"];

if ($decklink != "") {
  $decklink = explode("/", $decklink);
  $slug = $decklink[count($decklink) - 1];
  $apiLink = "https://api.fabdb.net/decks/" . $slug . "/osc";
  $apiDeck = file_get_contents($apiLink);
  $deckObj = json_decode($apiDeck);
  //$cards = $deckObj->{'cards'};
  $character = $deckObj->{'hero_id'};
  $head = "";
  $chest = "";
  $arms = "";
  $legs = "";
  $offhand = "";
  $headSideboard = "";
  $chestSideboard = "";
  $armsSideboard = "";
  $legsSideboard = "";
  $offhandSideboard = "";
  $equipment = $deckObj->{'equipment'};
  for ($i = 0; $i < count($equipment); ++$i) {
    $id = $equipment[$i]->{'id'};
    $subtype = CardSubType($id);
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
          if ($armsSideboard != "") $armsSideboard .= " ";
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
  }
  $weapons = $deckObj->{'weapons'};
  $weapon1 = "";
  $weapon2 = "";
  for ($i = 0; $i < count($weapons); ++$i) {
    if ($weapon1 == "") $weapon1 = $weapons[$i]->{'id'};
    else if ($weapon2 == "") $weapon2 = $weapons[$i]->{'id'};
  }
  $deckCards = "";
  $sideboardCards = "";
  $unsupportedCards = "";

  $maindeck = $deckObj->{'maindeck'};
  for ($i = 0; $i < count($maindeck); ++$i) {
    $id = $maindeck[$i]->{'id'};
    $cardType = CardType($id);
    if ($cardType == "") //Card not supported, error
    {
      if ($unsupportedCards != "") $unsupportedCards .= " ";
      $unsupportedCards .= $id;
    } else {
      $count = $maindeck[$i]->{'count'};
      for ($j = 0; $j < $count; ++$j) {
        if ($deckCards != "") $deckCards .= " ";
        $deckCards .= $id;
      }
    }
  }

  $sideboard = $deckObj->{'sideboard'};
  for ($i = 0; $i < count($sideboard); ++$i) {
    $id = $sideboard[$i]->{'id'};
    $cardType = CardType($id);
    if ($cardType == "") //Card not supported, error
    {
      if ($unsupportedCards != "") $unsupportedCards .= " ";
      $unsupportedCards .= $id;
    } else {
      $count = $sideboard[$i]->{'count'};
      for ($j = 0; $j < $count; ++$j) {
        if ($sideboardCards != "") $sideboardCards .= " ";
        $sideboardCards .= $id;
      }
    }
  }

  /*
    for($i=0; $i<count($cards); ++$i)
    {
      $count = $cards[$i]->{'total'};
      //$numSideboard = $cards[$i]->{'totalSideboard'};
      $numSideboard = $cards[$i]->{'sideboardTotal'};
      $printings = $cards[$i]->{'printings'};
      $printing = $printings[0];
      $sku = $printing->{'sku'};
      //$id = $sku->{'number'};
      $id = $sku->{'sku'};
      $id = explode("-", $id)[0];
      $cardType = CardType($id);
      if($cardType == "") //Card not supported, error
      {
          if($unsupportedCards != "") $unsupportedCards .= " ";
          $unsupportedCards .= $id;
      }
      else if($cardType == "C")
      {
        $character = $id;
      }
      else if($cardType == "W")
      {
        if($weapon1 == "") $weapon1 = $id;
        else $weapon2 = $id;
      }
      else if($cardType == "E")
      {

      }
      else
      {
        for($j=0; $j<($count-$numSideboard); ++$j)
        {
          if($deckCards != "") $deckCards .= " ";
          $deckCards .= $id;
        }
        for($j=0; $j<$numSideboard; ++$j)
        {
          if($sideboardCards != "") $sideboardCards .= " ";
          $sideboardCards .= $id;
        }
      }
    }
*/

  if ($unsupportedCards != "") {
    echo ("The following cards are not yet supported: " . $unsupportedCards);
  }
  //We have the decklist, now write to file
  $filename = "./Games/" . $gameName . "/p" . $playerID . "Deck.txt";
  $deckFile = fopen($filename, "a");
  fwrite($deckFile, $character . " " . $weapon1 . " " . ($weapon2 != "" ? $weapon2 . " " : "") . ($offhand != "" ? $offhand . " " : "") . $head . " " . $chest . " " . $arms . " " . $legs . "\r\n");
  fwrite($deckFile, $deckCards . "\r\n");
  fwrite($deckFile, $headSideboard . "\r\n");
  fwrite($deckFile, $chestSideboard . "\r\n");
  fwrite($deckFile, $armsSideboard . "\r\n");
  fwrite($deckFile, $legsSideboard . "\r\n");
  fwrite($deckFile, $offhandSideboard . "\r\n");
  fwrite($deckFile, $sideboardCards);
  fclose($deckFile);
} else {
  switch ($deck) {
    case "oot":
      $deckFile = "p1Deck.txt";
      break;
    case "shane":
      $deckFile = "shaneDeck.txt";
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
  copy($deckFile, "./Games/" . $gameName . "/p" . $playerID . "Deck.txt");
}

if ($playerID == 2) {
  $filename = "./Games/" . $gameName . "/GameFile.txt";
  $gameFile = fopen($filename, "w");

  $attemptCount = 0;
  while (!flock($gameFile, LOCK_EX) && $attemptCount < 5) {  // acquire an exclusive lock
    sleep(1);
    ++$attemptCount;
  }
  if ($attemptCount >= 5) {
    header("Location: " . $redirectorPath . "MainMenu.php"); //We never actually got the lock
  }

  //fwrite($gameFile, "\r\n");
  fwrite($gameFile, "1\r\n2\r\n4");
  flock($gameFile, LOCK_UN);    // release the lock
  fclose($gameFile);
}

header("Location: " . $redirectPath . "/GameLobby.php?gameName=$gameName&playerID=$playerID");
