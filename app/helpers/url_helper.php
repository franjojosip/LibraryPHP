<?php

//Url redirect
function redirect($page)
{
    header('Location: ' . $_SERVER["DOCUMENT_ROOT"] . '/' . $page);
}
