<?php require_once 'partials/head.php'?>

<div class="flex flex-col gap-5 p-5 bg-base-200 h-screen">
    <?php require_once __DIR__ . '/partials/header.php';?>

    <div class="flex flex-1 gap-5  justify-center items-center">
        <div>
            <figure>
                <img
                class="w-96 h-96 rounded-lg shadow-2xl"
                src="<?=$character['image']?>"
                alt="<?=$character['name']?>"
                >
            </figure>
            <div class="mt-5">
                <h2 class="font-bold text-4xl"><?=$character['name']?></h2>
                <ul class="space-y-1">
                    <li><span class="font-bold">Status:</span> <?=$character['status']?></li>
                    <li><span class="font-bold">Species:</span> <?=$character['species']?></li>
                    <li><span class="font-bold">Type:</span> <?=$character['type']?></li>
                    <li><span class="font-bold">Gender:</span> <?=$character['gender']?></li>
                    <li><span class="font-bold">Origin:</span> <?=$character['origin']['name']?></li>
                    <li><span class="font-bold">Location:</span> <?=$character['location']['name']?></li>
                </ul>
            </div>
        </div>
        </div>
    </div>


    <?php require_once 'partials/tail.php';?>