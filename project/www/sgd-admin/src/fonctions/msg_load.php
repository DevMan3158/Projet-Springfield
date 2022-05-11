<?php

// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('create_list_msg')) {
    function create_list_msg(?array $tab_msgs):?string {
        $list = "";
        foreach($tab_msgs as $value) {
            $img_no_lu = "enveloppe.svg";
            if($value['lu'] == "1") {
                $img_no_lu = "document.svg";
            }
            $list .= '<li class="list-group-item display_msg text-left" id="msg_'.$value['Id_msg'].'">';
            $list .= '<img src="src/img/'.$img_no_lu.'" /> ';
            $list .= $value['Objet'];
            $list .= '</li>';
        }
        return $list;
    }
}

