<?php
namespace Services;

function isUser() : bool {
    return !empty($_SESSION['user']);
}

