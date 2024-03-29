<?php

UpdateGameState($playerID);

$filename = "./Games/" . $gameName . "/gamestate.txt";
$handler = fopen($filename, "w");

$lockTries = 0;
while (!flock($handler, LOCK_EX) && $lockTries < 10) {
  usleep(100000); //50ms
  ++$lockTries;
}

if ($lockTries == 10) { fclose($handler); exit; }

fwrite($handler, implode(" ", $playerHealths) . "\r\n");

//Player 1
fwrite($handler, implode(" ", $p1Hand) . "\r\n");
fwrite($handler, implode(" ", $p1Deck) . "\r\n");
fwrite($handler, implode(" ", $p1CharEquip) . "\r\n");
fwrite($handler, implode(" ", $p1Resources) . "\r\n");
fwrite($handler, implode(" ", $p1Arsenal) . "\r\n");
fwrite($handler, implode(" ", $p1Items) . "\r\n");
fwrite($handler, implode(" ", $p1Auras) . "\r\n");
fwrite($handler, implode(" ", $p1Discard) . "\r\n");
fwrite($handler, implode(" ", $p1Pitch) . "\r\n");
fwrite($handler, implode(" ", $p1Banish) . "\r\n");
fwrite($handler, implode(" ", $p1ClassState) . "\r\n");
fwrite($handler, implode(" ", $p1CharacterEffects) . "\r\n");
fwrite($handler, implode(" ", $p1Soul) . "\r\n");
fwrite($handler, implode(" ", $p1CardStats) . "\r\n");
fwrite($handler, implode(" ", $p1TurnStats) . "\r\n");
fwrite($handler, implode(" ", $p1Allies) . "\r\n");
fwrite($handler, implode(" ", $p1Permanents) . "\r\n");
fwrite($handler, implode(" ", $p1Settings) . "\r\n");

//Player 2
fwrite($handler, implode(" ", $p2Hand) . "\r\n");
fwrite($handler, implode(" ", $p2Deck) . "\r\n");
fwrite($handler, implode(" ", $p2CharEquip) . "\r\n");
fwrite($handler, implode(" ", $p2Resources) . "\r\n");
fwrite($handler, implode(" ", $p2Arsenal) . "\r\n");
fwrite($handler, implode(" ", $p2Items) . "\r\n");
fwrite($handler, implode(" ", $p2Auras) . "\r\n");
fwrite($handler, implode(" ", $p2Discard) . "\r\n");
fwrite($handler, implode(" ", $p2Pitch) . "\r\n");
fwrite($handler, implode(" ", $p2Banish) . "\r\n");
fwrite($handler, implode(" ", $p2ClassState) . "\r\n");
fwrite($handler, implode(" ", $p2CharacterEffects) . "\r\n");
fwrite($handler, implode(" ", $p2Soul) . "\r\n");
fwrite($handler, implode(" ", $p2CardStats) . "\r\n");
fwrite($handler, implode(" ", $p2TurnStats) . "\r\n");
fwrite($handler, implode(" ", $p2Allies) . "\r\n");
fwrite($handler, implode(" ", $p2Permanents) . "\r\n");
fwrite($handler, implode(" ", $p2Settings) . "\r\n");

fwrite($handler, implode(" ", $landmarks) . "\r\n");
fwrite($handler, $winner . "\r\n");
fwrite($handler, $firstPlayer . "\r\n");
fwrite($handler, $currentPlayer . "\r\n");
fwrite($handler, $currentTurn . "\r\n");
fwrite($handler, implode(" ", $turn) . "\r\n");
fwrite($handler, $actionPoints . "\r\n");
fwrite($handler, implode(" ", $combatChain) . "\r\n");
fwrite($handler, implode(" ", $combatChainState) . "\r\n");
fwrite($handler, implode(" ", $currentTurnEffects) . "\r\n");
fwrite($handler, implode(" ", $currentTurnEffectsFromCombat) . "\r\n");
fwrite($handler, implode(" ", $nextTurnEffects) . "\r\n");
fwrite($handler, implode(" ", $decisionQueue) . "\r\n");
fwrite($handler, implode(" ", $dqVars) . "\r\n");
fwrite($handler, implode(" ", $dqState) . "\r\n");
fwrite($handler, implode(" ", $layers) . "\r\n");
fwrite($handler, implode(" ", $layerPriority) . "\r\n");
fwrite($handler, $mainPlayer . "\r\n");
fwrite($handler, implode(" ", $lastPlayed) . "\r\n");
fwrite($handler, count($chainLinks) . "\r\n");
for ($i = 0; $i < count($chainLinks); ++$i) {
  fwrite($handler, implode(" ", $chainLinks[$i]) . "\r\n");
}
fwrite($handler, implode(" ", $chainLinkSummary) . "\r\n");
fwrite($handler, $p1Key . "\r\n");
fwrite($handler, $p2Key . "\r\n");
fwrite($handler, $permanentUniqueIDCounter . "\r\n");
fwrite($handler, $inGameStatus . "\r\n"); //Game status -- 0 = START, 1 = PLAY, 2 = OVER
fwrite($handler, implode(" ", $animations) . "\r\n"); //Animations
fwrite($handler, $currentPlayerActivity . "\r\n"); //Current Player activity status -- 0 = active, 2 = inactive
fwrite($handler, $p1PlayerRating . "\r\n"); //Player Rating - 0 = not rated, 1 = green (positive), 2 = red (negative)
fwrite($handler, $p2PlayerRating . "\r\n"); //Player Rating - 0 = not rated, 1 = green (positive), 2 = red (negative)
fwrite($handler, $p1TotalTime . "\r\n"); //Player 1 total time
fwrite($handler, $p2TotalTime . "\r\n"); //Player 2 total time
fwrite($handler, $lastUpdateTime . "\r\n"); //Last update time
fwrite($handler, $roguelikeGameID . "\r\n"); //Last update time

flock($handler, LOCK_UN);
fclose($handler);
