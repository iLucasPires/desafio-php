<form class="w-full flex md:flex-nowrap flex-wrap justify-center gap-4" method="get">
    <input value="<?= isset($searchDTO->name) ? $searchDTO->name : ''; ?>" name="name" type="text" class="input w-full" placeholder="Search for a character" />
    <input value="<?= isset($searchDTO->species) ? $searchDTO->species : ''; ?>" name="species" type="text" class="input w-full" placeholder="Species" />
    <input value="<?= isset($searchDTO->type) ? $searchDTO->type : ''; ?>" name="type" type="text" class="input w-full" placeholder="Type" />

    <select name="status" id="status" class="select select-bordered w-full">
        <option disabled>Select a status</option>
        <option value="" <?= (isset($searchDTO->status) && $searchDTO->status == '') ? 'selected' : ''; ?>>any</option>
        <option value="alive" <?= (isset($searchDTO->status) && $searchDTO->status == 'alive') ? 'selected' : ''; ?>>alive</option>
        <option value="dead" <?= (isset($searchDTO->status) && $searchDTO->status == 'dead') ? 'selected' : ''; ?>>dead</option>
        <option value="unknown" <?= (isset($searchDTO->status) && $searchDTO->status == 'unknown') ? 'selected' : ''; ?>>unknown</option>
    </select>

    <select name="gender" id="gender" class="select select-bordered w-full">
        <option disabled>Select Gender</option>
        <option value="" <?= (isset($searchDTO->gender) && $searchDTO->gender == '') ? 'selected' : ''; ?>>any</option>
        <option value="female" <?= (isset($searchDTO->gender) && $searchDTO->gender == 'female') ? ' selected' : ''; ?>>female</option>
        <option value="male" <?= (isset($searchDTO->gender) && $searchDTO->gender == 'male') ? ' selected' : ''; ?>>male</option>
        <option value="genderless" <?= (isset($searchDTO->gender) && $searchDTO->gender == 'genderless') ? ' selected' : ''; ?>>genderless</option>
        <option value="unknown" <?= (isset($searchDTO->gender) && $searchDTO->gender == 'unknown') ? ' selected' : ''; ?>>unknown</option>
    </select>

    <button id="search-button" class="btn btn-primary">Search</button>
</form>
