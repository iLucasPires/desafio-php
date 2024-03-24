<?php require_once 'partials/head.php'; ?>

<body class="w-full h-screen relative flex flex-col">
    <?php require_once 'partials/header.php'; ?>

    <main class="flex-1 flex items-center justify-center bg-base-200 gap-4">
        <img class="w-96 h-96 rounded-lg shadow-2xl" src="<?php echo $character['image'] ?>" alt="<?php echo $character['name'] ?>" class="w-full" />
        <div class="flex flex-col gap-4 justify-start">
            <h2 class="font-bold text-4xl"><?php echo $character['name'] ?></h2>
            <ul class="list-none">
                <li><span class="font-bold">Status: </span><?php echo $character['status']  ? $character['status'] : 'Unknown' ?></li>
                <li><span class="font-bold">Species: </span><?php echo $character['species'] ? $character['species'] : 'Unknown' ?></li>
                <li><span class="font-bold">Type: </span><?php echo $character['type'] ? $character['type'] : 'Unknown' ?></li>
                <li><span class="font-bold">Gender: </span><?php echo $character['gender'] ? $character['gender'] : 'Unknown' ?></li>
                <li><span class="font-bold">Location: </span><?php echo $character['location']['name'] ? $character['location']['name'] : 'Unknown' ?></li>
                <li><span class="font-bold">Origin: </span><?php echo $character['origin']['name'] ? $character['origin']['name'] : 'Unknown' ?></li>
            </ul>
        </div>
    </main>
</body>