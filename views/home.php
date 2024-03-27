<?php require_once __DIR__ . '/partials/head.php';?>


    <div class="hero flex-1 bg-base-300">
        <div class="hero-content flex-col h-full">
            <div class="flex-1 w-full">
                <div class="grid md:grid-cols-4 gap-4 grid-cols-1">
                    <?php foreach ($characters as $character): ?>
                        <a class="card rounded bg-base-100 hover:scale-105 transition-transform shadow-lg" href="/character?id=<?php echo $character['id'] ?>">
                            <div class="card-body">
                                <img src="<?php echo $character['image'] ?>" alt="<?php echo $character['name'] ?>" class="w-full rounded" />
                                <h2 class="card-title"><?php echo $character['name'] ?></h2>
                            </div>
                        </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>

<?php require_once __DIR__ . '/partials/tail.php';?>