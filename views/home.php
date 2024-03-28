<?php require_once __DIR__ . '/partials/head.php'?>



<div class="space-y-5 w-full p-5 bg-base-200 min-h-screen">
    <?php
        require_once __DIR__ . '/partials/header.php';
        require_once __DIR__ . '/partials/search.php';
    ?>
    <div class="flex-1 w-full">
        <div class="grid md:grid-cols-5 gap-4 grid-cols-1">
            <?php foreach ($characters as $character): ?>
                <a
                    href="/character?id=<?php echo $character['id'] ?>"
                    class="card rounded bg-base-100 hover:scale-105 transition-transform shadow-lg"
                >
                    <div class="card-body">
                        <img
                            src="<?php echo $character['image'] ?>"
                            alt="<?php echo $character['name'] ?>"
                            class="w-full rounded"
                        />
                        <h2 class="card-title"><?php echo $character['name'] ?></h2>
                    </div>
                </a>
            <?php endforeach;?>
        </div>
    </div>
    <div class="join bg-base-100">
        <?php if ($page > 1): ?>
            <button 
                href="#" 
                class="join-item btn btn-ghost"
                data-page="<?php echo $page - 1; ?>"
            >
                Previous
            </button>
        <?php endif;?>

        <?php for ($i = $start; $i <= $end; $i++): ?>
            <button 
                href="#" 
                class="join-item btn <?php echo ($i == $page) ? 'btn-primary' : 'btn-ghost'; ?>"
                data-page="<?php echo $i; ?>"
            >
                <?php echo $i; ?>
            </button>
        <?php endfor;?>

        <?php if ($page < $pages): ?>
            <button 
                href="#" 
                class="join-item btn btn-ghost"
                data-page="<?php echo $page + 1; ?>"
            >
                Next
            </button>
        <?php endif;?>
    </div>
    </div>
</div>


<?php require_once __DIR__ . '/partials/tail.php';?>