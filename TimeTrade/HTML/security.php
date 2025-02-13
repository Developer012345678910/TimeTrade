<?php

function str_remove_special_char($target) {
    if (isset($_POST[$target])) {
        $_POST[$target] = str_replace("<", "", $_POST[$target]);
        $_POST[$target] = str_replace(">", "", $_POST[$target]);
        $_POST[$target] = str_replace("'", '"', $_POST[$target]);
    }
}

str_remove_special_char("user");
str_remove_special_char("password");
str_remove_special_char("password_verfied");
str_remove_special_char("job");
str_remove_special_char("discribtion");
str_remove_special_char("tel");
str_remove_special_char("position");
str_remove_special_char("to");
str_remove_special_char("message");

?>