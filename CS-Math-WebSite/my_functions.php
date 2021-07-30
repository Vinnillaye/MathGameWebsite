<?php


    function my_session_start(){
        if(session_status()!==PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    
    function logout() {
        if(session_status()==PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

    ?>