<!DOCTYPE html >
<html lang="pt-br" data-theme="nord">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relativo">
    <div role="alert" class="w-96 fixed bottom-4 right-4 alert alert-warning <?php echo $warning ? 'show' : 'hidden'; ?>">
      <svg
          xmlns="http://www.w3.org/2000/svg"
          class="stroke-current shrink-0 h-6 w-6"
          fill="none" viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
          />
      </svg>
    <div>
      <?=$warning?>
    </div>
    <button 
        onclick="closeAlert()"
        class="btn btn-ghost btn-sm"
      >
        &times;
    </button>
  </div>