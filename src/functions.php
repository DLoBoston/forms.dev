<?php
/**
 * Sets global functions.
 * @author dennis <dennis@ifscore.com>
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
