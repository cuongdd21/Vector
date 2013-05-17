<?php
	function checkSessionSlot($day, $slot)
    {
        $sessions = $day->sessions;
        if (count($sessions)===0)
        {
            return false;
        }
        else
        {
            for ($i=0;$i<count($sessions);$i++)
            {
                if ($sessions[$i]->slot==$slot)
                return true;
            }
        }
        return false;
    }
?>