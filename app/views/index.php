<?php require_once 'partials/head.php'; ?>

<body class="w-full h-screen relative flex flex-col">
    <?php require_once 'partials/header.php' ?>

    <div class="hero flex-1 bg-base-200">
        <div class="hero-content flex-col h-full">
            <?php require_once 'partials/search.php' ?>

            <div class="flex-1 w-full">
                <div class="grid md:grid-cols-4 gap-4 grid-cols-1">
                    <?php foreach ($characters as $character) : ?>
                        <a class="card rounded bg-base-100 hover:scale-105 transition-transform shadow-lg" href="/character?id=<?php echo $character['id'] ?>">
                            <div class="card-body">
                                <img src="<?php echo $character['image'] ?>" alt="<?php echo $character['name'] ?>" class="w-full rounded" />
                                <h2 class="card-title"><?php echo $character['name'] ?></h2>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="join">
                <?php if ($page > 1) : ?>
                    <button href="#" class="join-item btn" data-page="<?php echo $page - 1; ?>">Previous</button>
                <?php endif; ?>

                <?php for ($i = $start; $i <= $end; $i++) : ?>
                    <button href="#" class="join-item btn <?php echo ($i == $page) ? 'btn-active' : ''; ?>" data-page="<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </button>
                <?php endfor; ?>

                <?php if ($page < $pages) : ?>
                    <button href="#" class="join-item btn" data-page="<?php echo $page + 1; ?>">Next</button>
                <?php endif; ?>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('.join-item').forEach(function(item) {
                        item.addEventListener('click', function() {
                            const url = new URL(window.location.href);
                            url.searchParams.set('page', this.getAttribute('data-page'));
                            window.location.href = url.toString();
                        });
                    });


                });
            </script>

        </div>
    </div>
</body>