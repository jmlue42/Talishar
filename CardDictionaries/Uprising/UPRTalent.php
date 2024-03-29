<?php


  function UPRTalentCardType($cardID)
  {
    switch($cardID)
    {
      case "UPR000": return "R";
      case "UPR084": return "E";
      case "UPR085": return "E";
      case "UPR086": return "AA";
      case "UPR087": return "AR";
      case "UPR088": return "A";
      case "UPR089": return "I";
      case "UPR090": return "AA";
      case "UPR091": return "AA";
      case "UPR092": return "AA";
      case "UPR093": return "AA";
      case "UPR094": return "AA";
      case "UPR095": return "AA";
      case "UPR096": return "AA";
      case "UPR097": return "AA";
      case "UPR098": return "AA";
      case "UPR099": return "AA";
      case "UPR100": return "AA";
      case "UPR101": return "AA";
      case "UPR136": return "E";
      case "UPR137": return "E";
      case "UPR138": return "A";
      case "UPR139": return "A";
      case "UPR140": return "A";
      case "UPR141": case "UPR142": case "UPR143": return "A";
      case "UPR144": case "UPR145": case "UPR146": return "A";
      case "UPR147": case "UPR148": case "UPR149": return "A";
      case "UPR150": return "T";
      case "UPR182": return "E";
      case "UPR183": case "UPR184": case "UPR185": case "UPR186": return "E";
      case "UPR187": return "AA";
      case "UPR188": return "AA";
      case "UPR189": return "DR";
      case "UPR190": return "A";
      case "UPR191": case "UPR192": case "UPR193": return "AA";
      case "UPR194": case "UPR195": case "UPR196": return "AA";
      case "UPR197": case "UPR198": case "UPR199": return "A";
      case "UPR200": case "UPR201": case "UPR202": return "A";
      case "UPR203": case "UPR204": case "UPR205": return "AA";
      case "UPR206": case "UPR207": case "UPR208": return "AA";
      case "UPR209": case "UPR210": case "UPR211": return "REPRINT";
      case "UPR212": case "UPR213": case "UPR214": return "AA";
      case "UPR215": case "UPR216": case "UPR217": return "A";
      case "UPR218": case "UPR219": case "UPR220": return "A";
      case "UPR221": case "UPR222": case "UPR223": return "I";
      case "UPR225": return "T";
      default: return "";
    }
  }

  function UPRTalentCardSubType($cardID)
  {
    switch($cardID)
    {
      case "UPR000": return "Gem";
      case "UPR084": return "Chest";
      case "UPR085": return "Chest";
      case "UPR136": return "Head";
      case "UPR137": return "Head";
      case "UPR138": return "Aura";
      case "UPR139": return "Affliction,Aura";
      case "UPR140": return "Aura";
      case "UPR182": return "Head";
      case "UPR183": return "Head";
      case "UPR184": return "Chest";
      case "UPR185": return "Arms";
      case "UPR186": return "Legs";
      case "UPR190": return "Aura";
      case "UPR218": case "UPR219": case "UPR220": return "Aura";
      default: return "";
    }
  }

  //Minimum cost of the card
  function UPRTalentCardCost($cardID)
  {
    switch($cardID)
    {
      case "UPR000": return -1;
      case "UPR086": return 2;
      case "UPR087": return 1;
      case "UPR088": return 0;
      case "UPR089": return 1;
      case "UPR090": return 2;
      case "UPR091": return 1;
      case "UPR092": return 0;
      case "UPR093": return 1;
      case "UPR094": return 0;
      case "UPR095": return 1;
      case "UPR096": return 1;
      case "UPR097": return 0;
      case "UPR098": return 0;
      case "UPR099": return 1;
      case "UPR100": return 1;
      case "UPR101": return 0;
      case "UPR138": return 1;
      case "UPR139": return 0;
      case "UPR140": return 3;
      case "UPR141": case "UPR142": case "UPR143": return 1;
      case "UPR144": case "UPR145": case "UPR146": return 0;
      case "UPR147": case "UPR148": case "UPR149": return 1;
      case "UPR187": return 2;
      case "UPR188": return 0;
      case "UPR189": return 0;
      case "UPR190": return 3;
      case "UPR191": case "UPR192": case "UPR193": return 0;
      case "UPR194": case "UPR195": case "UPR196": return 3;
      case "UPR197": case "UPR198": case "UPR199": return 0;
      case "UPR200": case "UPR201": case "UPR202": return 1;
      case "UPR203": case "UPR204": case "UPR205": return 2;
      case "UPR206": case "UPR207": case "UPR208": return 1;
      case "UPR212": case "UPR213": case "UPR214": return 0;
      case "UPR215": case "UPR216": case "UPR217": return 0;
      case "UPR218": case "UPR219": case "UPR220": return 1;
      case "UPR221": case "UPR222": case "UPR223": return 1;
      default: return 0;
    }
  }

  function UPRTalentPitchValue($cardID)
  {
    switch($cardID)
    {
      case "UPR000": return 1;
      case "UPR086": return 1;
      case "UPR087": return 1;
      case "UPR088": return 1;
      case "UPR089": return 1;
      case "UPR090": return 1;
      case "UPR091": return 1;
      case "UPR092": return 1;
      case "UPR093": return 1;
      case "UPR094": return 1;
      case "UPR095": return 1;
      case "UPR096": return 1;
      case "UPR097": return 1;
      case "UPR098": return 1;
      case "UPR099": return 1;
      case "UPR100": return 1;
      case "UPR101": return 1;
      case "UPR138": return 3;
      case "UPR139": return 3;
      case "UPR140": return 3;
      case "UPR141": case "UPR144": case "UPR147": return 1;
      case "UPR142": case "UPR145": case "UPR148": return 2;
      case "UPR143": case "UPR146": case "UPR149": return 3;
      case "UPR187": return 1;
      case "UPR188": return 1;
      case "UPR189": return 2;
      case "UPR190": return 2;
      case "UPR191": case "UPR194": case "UPR197": case "UPR200": case "UPR203": case "UPR206": case "UPR209": case "UPR212": case "UPR215": case "UPR218": return 1;
      case "UPR192": case "UPR195": case "UPR198": case "UPR201": case "UPR204": case "UPR207": case "UPR210": case "UPR213": case "UPR216": case "UPR219": return 2;
      case "UPR193": case "UPR196": case "UPR199": case "UPR202": case "UPR205": case "UPR208": case "UPR211": case "UPR214": case "UPR217": case "UPR220": return 3;
      case "UPR221": return 1;
      case "UPR222": return 2;
      case "UPR223": return 3;
      default: return 0;
    }
  }

  function UPRTalentBlockValue($cardID)
  {
    switch($cardID)
    {
      case "UPR000": return -1;
      case "UPR084": return 2;
      case "UPR085": return 0;
      case "UPR086": return 2;
      case "UPR087": return 2;
      case "UPR088": return 3;
      case "UPR089": return -1;
      case "UPR090": return 3;
      case "UPR091": return 3;
      case "UPR092": return 2;
      case "UPR093": return 3;
      case "UPR094": return 3;
      case "UPR095": return 2;
      case "UPR096": return 2;
      case "UPR097": return 2;
      case "UPR098": return 3;
      case "UPR099": return 3;
      case "UPR100": return 3;
      case "UPR101": return -1;
      case "UPR136": return 2;
      case "UPR137": return 0;
      case "UPR138": return 2;
      case "UPR139": return 2;
      case "UPR140": return 2;
      case "UPR141": case "UPR142": case "UPR143": return 2;
      case "UPR144": case "UPR145": case "UPR146": return 2;
      case "UPR147": case "UPR148": case "UPR149": return 2;
      case "UPR182": return 2;
      case "UPR183": case "UPR184": case "UPR185": case "UPR186": return 0;
      case "UPR187": return 2;
      case "UPR188": return 3;
      case "UPR189": return 3;
      case "UPR190": return 3;
      case "UPR191": case "UPR192": case "UPR193": return 2;
      case "UPR194": case "UPR195": case "UPR196": return 2;
      case "UPR197": case "UPR198": case "UPR199": return 3;
      case "UPR200": case "UPR201": case "UPR202": return 2;
      case "UPR203": case "UPR204": case "UPR205": return 2;
      case "UPR206": case "UPR207": case "UPR208": return 3;
      case "UPR212": case "UPR213": case "UPR214": return 2;
      case "UPR215": case "UPR216": case "UPR217": return 2;
      case "UPR218": case "UPR219": case "UPR220": return 2;
      default: return -1;
    }
  }

  function UPRTalentAttackValue($cardID)
  {
    switch($cardID)
    {
      case "UPR086": return 6;
      case "UPR090": return 4;
      case "UPR091": return 3;
      case "UPR092": return 4;
      case "UPR093": return 5;
      case "UPR094": return 2;
      case "UPR095": return 3;
      case "UPR096": return 3;
      case "UPR097": return 1;
      case "UPR098": return 2;
      case "UPR099": return 3;
      case "UPR100": return 4;
      case "UPR101": return 0;
      case "UPR187": return 6;
      case "UPR188": return 1;
      case "UPR191": return 4;
      case "UPR192": return 3;
      case "UPR193": return 2;
      case "UPR194": return 7;
      case "UPR195": return 6;
      case "UPR196": return 5;
      case "UPR203": return 6;
      case "UPR204": return 5;
      case "UPR205": return 4;
      case "UPR206": return 5;
      case "UPR207": return 4;
      case "UPR208": return 3;
      case "UPR212": return 3;
      case "UPR213": return 2;
      case "UPR214": return 1;
      default: return 0;
    }
  }

  function UPRTalentPlayAbility($cardID, $from, $resourcesPaid, $target, $additionalCosts)
  {
    global $currentPlayer, $CS_PlayIndex, $CS_NumRedPlayed;
    $rv = "";
    $otherPlayer = ($currentPlayer == 1 ? 2 : 1);
    switch($cardID)
    {
      case "UPR084":
        $pitch = &GetPitch($currentPlayer);
        $numRed = 0;
        for($i=0; $i<count($pitch); $i+=PitchPieces())
        {
          if(PitchValue($pitch[$i]) == 1) ++$numRed;
        }
        GainResources($currentPlayer, $numRed);
        return "Gain 1 resource for each red in your pitch zone.";
      case "UPR085":
        GainResources($currentPlayer, 1);
        return "Gain 1 resource.";
      case "UPR088":
        AddCurrentTurnEffect($cardID, $currentPlayer);
        return "Gives your next 4 Draconic attacks +1.";
      case "UPR089":
        Draw($currentPlayer);
        Draw($currentPlayer);
        return "Draws 2 cards.";
      case "UPR090":
        if(RuptureActive())
        {
          $deck = &GetDeck($currentPlayer);
          $cards = "";
          $numRed = 0;
          for($i=0; $i<NumDraconicChainLinks(); $i+=DeckPieces())
          {
            if($cards != "") $cards .= ",";
            $cards .= $deck[$i];
            if(PitchValue($deck[$i]) == 1) ++$numRed;
          }
          $reveals = RevealCards($cards);
          if($reveals)
          {
            AddDecisionQueue("MULTIZONEINDICES", $currentPlayer, "MYCHAR:type=C&THEIRCHAR:type=C&MYALLY&THEIRALLY", 1);
            AddDecisionQueue("SETDQCONTEXT", $currentPlayer, "Choose a target to deal ". $numRed ." damage.");
            AddDecisionQueue("CHOOSEMULTIZONE", $currentPlayer, "<-", 1);
            AddDecisionQueue("MZDAMAGE", $currentPlayer, $numRed . ",DAMAGE," . $cardID, 1);
            AddDecisionQueue("SHUFFLEDECK", $currentPlayer, "-", 1);
          }
          else return "Cannot reveal cards";
        }
        return CardLink($cardID, $cardID) . " lets you reveal and deal damage.";
      case "UPR091":
        if(RuptureActive())
        {
          AddCurrentTurnEffect($cardID, $currentPlayer);
        }
        return "";
      case "UPR094":
        if($additionalCosts != "-") { AddCurrentTurnEffect($cardID, $currentPlayer); WriteLog("Gains +2 and go again from banishing."); }
        return "";
      case "UPR096":
        AddLayer("TRIGGER", $currentPlayer, $cardID);
        return "";
      case "UPR097":
        if(GetClassState($currentPlayer, $CS_NumRedPlayed) > 1)
        {
          AddDecisionQueue("FINDINDICES", $currentPlayer, "GYCARD,UPR101");
          AddDecisionQueue("CHOOSEDISCARD", $currentPlayer, "<-", 1);
          AddDecisionQueue("REMOVEDISCARD", $currentPlayer, "-", 1);
          AddDecisionQueue("ADDHAND", $currentPlayer, "-", 1);
        }
        return "";
      case "UPR099":
        $rv = "";
        if(RuptureActive())
        {
          AddDecisionQueue("MULTIZONEINDICES", $currentPlayer, "MYCHAR:type=C&THEIRCHAR:type=C&MYALLY&THEIRALLY", 1);
          AddDecisionQueue("SETDQCONTEXT", $currentPlayer, "Choose a target to deal 2 damage.");
          AddDecisionQueue("CHOOSEMULTIZONE", $currentPlayer, "<-", 1);
          AddDecisionQueue("MZDAMAGE", $currentPlayer, "2,DAMAGE," . $cardID, 1);
          AddDecisionQueue("SHUFFLEDECK", $currentPlayer, "-", 1);
        }
        return $rv;
      case "UPR136":
        if (ShouldAutotargetOpponent($currentPlayer)) {
          AddDecisionQueue("CORONETPEAK", $currentPlayer, "Target_Opponent", 1);
        } else {
          AddDecisionQueue("SETDQCONTEXT", $currentPlayer, "Choose target hero");
          AddDecisionQueue("BUTTONINPUT", $currentPlayer, "Target_Opponent,Target_Yourself");
          AddDecisionQueue("CORONETPEAK", $currentPlayer, "<-", 1);
        }
        return "Makes target hero pay 1 or discard a card.";
      case "UPR137":
        AddDecisionQueue("FINDINDICES", $currentPlayer, "SEARCHMZ,THEIRARS", 1);
        AddDecisionQueue("SETDQCONTEXT", $currentPlayer, "Choose which card you want to freeze", 1);
        AddDecisionQueue("CHOOSEMULTIZONE", $currentPlayer, "<-", 1);
        AddDecisionQueue("MZOP", $currentPlayer, "FREEZE", 1);
        AddDecisionQueue("FINDINDICES", $currentPlayer, "SEARCHMZ,THEIRALLY");
        AddDecisionQueue("SETDQCONTEXT", $currentPlayer, "Choose which card you want to freeze", 1);
        AddDecisionQueue("CHOOSEMULTIZONE", $currentPlayer, "<-", 1);
        AddDecisionQueue("MZOP", $currentPlayer, "FREEZE", 1);
        return "Lets you freeze an arsenal card and ally.";
      case "UPR141": case "UPR142": case "UPR143":
        AddCurrentTurnEffect($cardID, $currentPlayer);
        return "Creates frostbites the next time you Ice fuse.";
      case "UPR144": case "UPR145": case "UPR146":
        if($cardID == "UPR144") $numFrostbites = 3;
        else if($cardID == "UPR145") $numFrostbites = 2;
        else $numFrostbites = 1;
        PlayAura("ELE111", ($currentPlayer == 1 ? 2 : 1), $numFrostbites);
        return "Creates frostbites.";
      case "UPR147": case "UPR148": case "UPR149":
        if($cardID == "UPR147") $cost = 3;
        else if($cardID == "UPR148") $cost = 2;
        else $cost = 1;
        $theirAllies = &GetAllies($otherPlayer);
      if (!ArsenalEmpty($otherPlayer) || count($theirAllies) > 0) {        
        AddDecisionQueue("SETDQCONTEXT", $currentPlayer, "Choose if you want to pay $cost to prevent an arsenal or ally from being frozen");
        AddDecisionQueue("BUTTONINPUT", $otherPlayer, "0," . $cost, 0, 1);
        AddDecisionQueue("PAYRESOURCES", $otherPlayer, "<-", 1);
        AddDecisionQueue("GREATERTHANPASS", $otherPlayer, "0", 1);
        AddDecisionQueue("FINDINDICES", $currentPlayer, "SEARCHMZ,THEIRALLY|THEIRARS", 1);
        AddDecisionQueue("SETDQCONTEXT", $currentPlayer, "Choose which card you want to freeze", 1);
        AddDecisionQueue("CHOOSEMULTIZONE", $currentPlayer, "<-", 1);
        AddDecisionQueue("MZOP", $currentPlayer, "FREEZE", 1);
        }
        if($from == "ARS") MyDrawCard();
        return "";
      case "UPR183":
        AddCurrentTurnEffect($cardID, $currentPlayer);
        $char = &GetPlayerCharacter($currentPlayer);
        $char[GetClassState($currentPlayer, $CS_PlayIndex)+7] = 1;
        return "Prevents the next 1 damage.";
      case "UPR191": case "UPR192": case "UPR193":
        AddDecisionQueue("SETDQCONTEXT", $currentPlayer, "Choose how much you want to pay", 1);
        AddDecisionQueue("BUTTONINPUT", $currentPlayer, "0," . 2, 0, 1);
        AddDecisionQueue("PAYRESOURCES", $currentPlayer, "<-", 1);
        AddDecisionQueue("LESSTHANPASS", $currentPlayer, "1", 1);
        AddDecisionQueue("ADDCURRENTEFFECT", $currentPlayer, $cardID, 1);
        return "Lets you pay 2 to give it +2 power.";
      case "UPR194": case "UPR195": case "UPR196":
        $rv = "";
        if(PlayerHasLessHealth($currentPlayer)) { GainHealth(1, $currentPlayer); $rv = "Gained 1 health."; }
        return $rv;
      case "UPR197": case "UPR198": case "UPR199":
        if($cardID == "UPR197") $numCards = 4;
        else if($cardID == "UPR198") $numCards = 3;
        else $numCards = 2;
        AddDecisionQueue("FINDINDICES", $currentPlayer, "HAND");
        AddDecisionQueue("PREPENDLASTRESULT", $currentPlayer, $numCards . "-", 1);
        AddDecisionQueue("MULTICHOOSEHAND", $currentPlayer, "<-", 1);
        AddDecisionQueue("MULTIREMOVEHAND", $currentPlayer, "-", 1);
        AddDecisionQueue("MULTIADDDECK", $currentPlayer, "-", 1);
        AddDecisionQueue("SIFT", $currentPlayer, "-", 1);
        return "Lets you cycle $numCards cards.";
      case "UPR200": case "UPR201": case "UPR202":
        if($cardID == "UPR200") $maxCost = 2;
        else if($cardID == "UPR201") $maxCost = 1;
        else $maxCost = 0;
        AddDecisionQueue("MULTIZONEINDICES", $currentPlayer,"MYDISCARD:maxCost=".$maxCost.";type=AA&MYDISCARD:maxCost=".$maxCost.";type=A&THEIRDISCARD:maxCost=".$maxCost.";type=AA&THEIRDISCARD:maxCost=".$maxCost.";type=A");
        AddDecisionQueue("SETDQCONTEXT", $currentPlayer, "Choose a card from a graveyard", 1);
        AddDecisionQueue("CHOOSEMULTIZONE", $currentPlayer, "<-", 1);
        AddDecisionQueue("MZADDBOTDECK", $currentPlayer, "-", 1);
        AddDecisionQueue("MZREMOVE", $currentPlayer, "-", 1);
        AddCurrentTurnEffect($cardID, $currentPlayer);
        return "Lets you return a card and draw a card.";
      case "UPR212": case "UPR213": case "UPR214":
        if($from == "ARS") GiveAttackGoAgain();
        AddDecisionQueue("FINDINDICES", $currentPlayer, "HAND");
        AddDecisionQueue("MAYCHOOSEHAND", $currentPlayer, "<-", 1);
        AddDecisionQueue("REMOVEMYHAND", $currentPlayer, "-", 1);
        AddDecisionQueue("DISCARDCARD", $currentPlayer, "HAND", 1);
        AddDecisionQueue("DRAW", $currentPlayer, "-", 1);
        return "";
      case "UPR215": case "UPR216": case "UPR217":
        if($cardID == "UPR215") $amount = 3;
        else if($cardID == "UPR216") $amount = 2;
        else $amount = 1;
        GainHealth($amount, $currentPlayer);
        return "Gain $amount health.";
      case "UPR221": case "UPR222": case "UPR223":
        if($target != "-") AddCurrentTurnEffect($cardID, $currentPlayer, $from, GetMZCard(($currentPlayer == 1 ? 2 : 1), $target));
        if(PlayerHasLessHealth($currentPlayer))
        {
          GainHealth(1, $currentPlayer);
          WriteLog("Gain 1 health from " . CardLink($cardID, $cardID) . ".");
        }
        return "Prevents damage this turn.";
      default: return "";
    }
  }

  function UPRTalentHitEffect($cardID)
  {
    global $mainPlayer, $defPlayer;
    switch($cardID)
    {
      case "UPR087":
        if(IsHeroAttackTarget() && RuptureActive())
        {
          $otherPlayer = ($mainPlayer == 1 ? 2 : 1);
          AddDecisionQueue("FINDINDICES", $defPlayer, "EQUIP");
          AddDecisionQueue("CHOOSETHEIRCHARACTER", $mainPlayer, "<-", 1);
          AddDecisionQueue("ADDNEGDEFCOUNTER", $defPlayer, "-", 1);
          AddDecisionQueue("DESTROYEQUIPDEF0", $mainPlayer, "-", 1);
        }
        break;
      case "UPR093":
        if(IsHeroAttackTarget() && RuptureActive())
        {
          WriteLog("Breaking Point destroyed the defending player's arsenal.");
          DestroyArsenal($defPlayer);
        }
        break;
      case "UPR100":
        AddDecisionQueue("FINDINDICES", $mainPlayer, "GYCARD,UPR101");
        AddDecisionQueue("CHOOSEDISCARD", $mainPlayer, "<-", 1);
        AddDecisionQueue("REMOVEDISCARD", $mainPlayer, "-", 1);
        AddDecisionQueue("ADDHAND", $mainPlayer, "-", 1);
        AddDecisionQueue("GIVEATTACKGOAGAIN", $mainPlayer, "-", 1);
        break;
      case "UPR187":
        if(IsHeroAttackTarget())
        {
          AddCurrentTurnEffect($cardID, $defPlayer);
          AddNextTurnEffect($cardID, $defPlayer);
        }
        break;
      case "UPR188":
        if(IsHeroAttackTarget())
        {
          $hand = &GetHand($defPlayer);
          $amount = count($hand)/HandPieces();
          LoseHealth($amount, $defPlayer);
          WriteLog("Vipox made player $defPlayer lose $amount health.");
        }
        break;
      default: break;
    }
  }

  function HasRupture($cardID)
  {
    switch($cardID)
    {
      case "UPR087": case "UPR090": case "UPR091": return true;
      case "UPR093": case "UPR098": case "UPR099": return true;
      default: return false;
    }
  }

  function RuptureActive($beforePlay=false, $notAttack=false)
  {
    global $combatChainState, $CCS_NumChainLinks;
    if($notAttack)
    {
      $target = 4; //Doesn't show rupture border for Attack Reactions and future d.react or instants
    } else {
      $target = ($beforePlay ? 3 : 4);
    }
    if($combatChainState[$CCS_NumChainLinks] >= $target) return true;
    return false;
  }

  function NumDraconicChainLinks()
  {
    global $combatChain, $mainPlayer, $chainLinkSummary;
    $numLinks = 0;
    for($i=0; $i<count($chainLinkSummary); $i+=ChainLinkSummaryPieces())
    {
      if(DelimStringContains($chainLinkSummary[$i+2], "DRACONIC")) ++$numLinks;
    }
    if(count($combatChain) > 0 && TalentContains($combatChain[0], "DRACONIC", $mainPlayer)) ++$numLinks;
    return $numLinks;
  }

  function NumPhoenixFlameChainLinks()
  {
    global $chainLinks, $combatChain;
    $numLinks = 0;
    for($i=0; $i<count($chainLinks); ++$i)
    {
      if($chainLinks[$i][0] == "UPR101") ++$numLinks;
    }
    if(count($combatChain) > 0 && $combatChain[0] == "UPR101") ++$numLinks;
    return $numLinks;
  }

  function ThawIndices($player)
  {
    $iceAfflictions = SearchMultiZoneFormat(SearchAura($player, "", "Affliction", -1, -1, "", "ICE"), "MYAURAS");
    $frostBites = SearchMultiZoneFormat(SearchAurasForCard("ELE111", $player), "MYAURAS");
    $search = CombineSearches($iceAfflictions, $frostBites);
    $myFrozenArsenal = SearchMultiZoneFormat(SearchArsenal($player, frozenOnly:true), "MYARS");
    $search = CombineSearches($search, $myFrozenArsenal);
    $myFrozenAllies = SearchMultiZoneFormat(SearchAllies($player, frozenOnly:true), "MYALLY");
    $search = CombineSearches($search, $myFrozenAllies);
    $myFrozenCharacter = SearchMultiZoneFormat(SearchCharacter($player, frozenOnly:true), "MYCHAR");
    $search = CombineSearches($search, $myFrozenCharacter);
    return $search;
  }

?>
