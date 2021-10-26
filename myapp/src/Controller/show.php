<?php


$userRepository = $entityManager->getRepository('User');
$user = $userRepository->findAll();

foreach ($users as $user) {
    echo sprintf("-%s\n", $user->getFirstName());
    echo sprintf("-%s\n", $user->getLastName());
    echo sprintf("-%s\n", $user->getEmail());
    echo sprintf("-%s\n", $user->getBirthDate());
}
