<?php
session_start();
$isLoggedIn = isset($_SESSION['usuario_nome']);
$usuarioNome = $isLoggedIn ? $_SESSION['usuario_nome'] : null;