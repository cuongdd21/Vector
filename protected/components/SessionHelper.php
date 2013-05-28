<?php
/**
 * This function to assist in session function, the function is to check
 * if the session slot is available or not.
 * @param day, slot
 * @return boolean
 */

function checkSessionSlot($day, $slot)
{
    $sessions = $day->sessions;
    if (count($sessions) === 0) {
        return false;
    } else {
        for ($i = 0; $i < count($sessions); $i++) {
            if ($sessions[$i]->slot == $slot)
                return true;
        }
    }
    return false;
}
?>