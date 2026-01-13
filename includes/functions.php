// fonctions générales (bug/debug)

<?php
//Redirige vers la page renseignée
function redirect($url)
{
    header('Location: ' . $url);
    exit;
}

//Debug
function debug($data)
{
    echo '<pre style="background:#222;color:#0f0;padding:8px;">';
    print_r($data);
    echo '</pre>';
}
