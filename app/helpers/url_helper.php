<?php

//Url redirect
function redirect($page)
{
    header('Location: ' . URL_ROOT. '/' . $page);
}
