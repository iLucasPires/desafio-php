<?php require_once 'partials/head.php';?>

<body class="w-full h-screen relative flex flex-col">
    <?=require_once 'partials/header.php';?>

    <main class="flex-1 flex items-center justify-center bg-base-200 gap-4">
        <div class="card lg:card-side">
            <figure>
                <img
                    class="w-96 h-96 rounded-lg shadow-2xl"
                    src="<?=$data['character']['image']?>"
                    alt="<?=$data['character']['name']?>"
                >
            </figure>
            <div class="card-body max-w-[46rem]">
                <h2 class="font-bold text-4xl"><?=$data['character']['name']?></h2>
                <ul>
                    <li><span class="font-bold">Status:</span> <?=$data['character']['status']?></li>
                    <li><span class="font-bold">Species:</span> <?=$data['character']['species']?></li>
                    <li><span class="font-bold">Type:</span> <?=$data['character']['type']?></li>
                    <li><span class="font-bold">Gender:</span> <?=$data['character']['gender']?></li>
                    <li><span class="font-bold">Origin:</span> <?=$data['character']['origin']['name']?></li>
                    <li><span class="font-bold">Location:</span> <?=$data['character']['location']['name']?></li>
                </ul>
            </div>
        </div>
    </main>
</body>