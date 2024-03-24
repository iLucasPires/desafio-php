<form class="w-full flex md:flex-nowrap	flex-wrap justify-center gap-4" method="get">
    <input value="<?php echo $name; ?>" name="name" type="text" id="search" class="input w-full" placeholder="Search for a character" />
    <input value="<?php echo $species; ?>" name="species" type="text" id="species" class="input" placeholder="Species" />
    <input value="<?php echo $type; ?>" name="type" type="text" id="type" class="input" placeholder="Type" />
    <select name="status" id="status" class="select select-bordered">
        <option disabled>Select a status</option>
        <option value="" <?php echo ($status == '') ? 'selected' : ''; ?>>any</option>
        <option value="alive" <?php echo ($status == 'alive') ? 'selected' : ''; ?>>alive</option>
        <option value="dead" <?php echo ($status == 'dead') ? 'selected' : ''; ?>>dead</option>
        <option value="unknown" <?php echo ($status == 'unknown') ? 'selected' : ''; ?>>unknown</option>
    </select>

    <select name="gender" id="gender" class="select select-bordered">
        <option disabled>Select Gender</option>
        <option value="" <?php echo ($gender == '') ? 'selected' : ''; ?>>any</option>
        <option value="female" <?php echo ($gender == 'female') ? ' selected' : '' ?>>female</option>
        <option value="male" <?php echo ($gender == 'male') ? ' selected' : '' ?>>male</option>
        <option value="genderless" <?php echo ($gender == 'genderless') ? ' selected' : '' ?>>genderless</option>
        <option value="unknown" <?php echo ($gender == 'unknown') ? ' selected' : '' ?>>unknown</option>
    </select>

    <button id="search-button" class="btn btn-primary">Search</button>
</form>