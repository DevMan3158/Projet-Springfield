<?php

// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('create_list_msg')) {
    function create_list_msg(?array $tab_msgs):?string {
        $list = "";
        foreach($tab_msgs as $value) {
            $img_no_lu = "enveloppe.svg";
            $msg_no_lu = "display_msg_no_lu";
            if($value['lu'] == "1") {
                $img_no_lu = "document.svg";
                $msg_no_lu = "display_msg_lu";
            }
            $list .= '<li class="list-group-item display_msg text-left '.$msg_no_lu.'" id="msg_'.$value['Id_msg'].'">';
            $list .= '<img id="img_msg_'.$value['Id_msg'].'" src="./src/img/'.$img_no_lu.'" /> ';
            $list .= $value['Objet'];
            $list .= '</li>';
        }
        return $list;
    }
}

