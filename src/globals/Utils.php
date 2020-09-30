<?php


class Utils
{
    /**
     * Redirect to another page on the site, script execution end after a call to this function
     * @param $pageId string ID of the page where to redirect
     * @param $getParameters array Associative array with keys as get parameter name
     */
    public static function redirectTo($pageId, $getParameters)
    {
        $formattedGetParameters = "";
        foreach ($getParameters as $key => $value)
        {
            $formattedGetParameters = $formattedGetParameters . "&$key=$value";
        }

        header("Location: index.php?page=$pageId" . $formattedGetParameters);

        exit(0);
    }
}