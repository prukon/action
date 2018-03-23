<?php
function colorcount($a)
{
    if ($a > 0) {
        $a = "<b><span style='color:red;'>$a</span></b>";
    } else {
        $a = "<b><span style='color:green;'>$a</span></b>";
    }
    return $a;
}

?>

<?php
function colorcount2($a)
{
    if ($a > 0) {
        $a = "<b><span style='color:green;'>$a</span></b>";
    } else {
        $a = "<b><span style='color:red;'>$a</span></b>";
    }
    return $a;
}

function html($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function htmlout($text)
{
    echo html($text);
}

?>