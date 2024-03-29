<?php

function IsWeapon($cardID)
{
  return CardType($cardID) == "W";
}

function WeaponIndices($chooser, $player, $subtype = "")
{
  global $mainPlayer;
  $whoPrefix = ($player == $chooser ? "MY" : "THEIR");
  $character = GetPlayerCharacter($player);
  $weapons = "";
  for ($i = 0; $i < count($character); $i += CharacterPieces()) {
    if ($character[$i + 1] != 0 && CardType($character[$i]) == "W" && ($subtype == "" || CardSubType($character[$i]) == $subtype)) {
      if ($weapons != "") $weapons .= ",";
      $weapons .= $whoPrefix . "CHAR-" . $i;
    }
  }
  $auraWeapons = (SearchCharacterForCard($player, "MON003") || SearchCharacterForCard($player, "MON088")) && ($player == $mainPlayer);
  if ($auraWeapons) {
    $auras = GetAuras($player);
    for ($i = 0; $i < count($auras); $i += AuraPieces()) {
      if (ClassContains($auras[$i], "ILLUSIONIST", $player)) {
        if ($weapons != "") $weapons .= ",";
        $weapons .= $whoPrefix . "AURAS-" . $i;
      }
    }
  }
  return $weapons;
}


function GetWeaponChoices($subtype = "")
{
  global $myCharacter;
  $weapons = "";
  for ($i = 0; $i < count($myCharacter); $i += CharacterPieces()) {
    if (CardType($myCharacter[$i]) == "W" && ($subtype == "" || $subtype == CardSubtype($myCharacter[$i]))) {
      if ($weapons != "") $weapons .= ",";
      $weapons .= $i;
    }
  }
  return $weapons;
}

function ApplyEffectToEachWeapon($effectID)
{
  global $myCharacter, $currentPlayer;
  for ($i = 0; $i < count($myCharacter); $i += CharacterPieces()) {
    if (CardType($myCharacter[$i]) == "W") {
      AddCharacterEffect($currentPlayer, $i, $effectID);
    }
  }
}

function isAuraWeapon($cardID, $player, $from)
{
  if ((SearchCharacterForCard($player, "MON003") || SearchCharacterForCard($player, "MON088")) && DelimStringContains(CardSubType($cardID), "Aura") && $from == "PLAY") return true;
  else return false;
}
