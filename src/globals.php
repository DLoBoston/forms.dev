<?php
/**
 * Sets constants and global functions.
 * @author Digital D.Lo <WebDevDLo@gmaiil.com>
 */

/**
 * Convenience function to set header for redirect and then exit
 * @param string $location URL to redirect to
 */
function redirect_to($location = null)
{
    if ($location != null) {
        header("Location: {$location}");
        exit;
    }
}
