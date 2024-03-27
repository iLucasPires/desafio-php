<form class="w-full flex md:flex-nowrap	flex-wrap justify-center gap-4" method="get">
    <input value="<?=$data['searchDTO']->name;?>" name="name" type="text" class="input w-full" placeholder="Search for a character" />
    <input value="<?=$data['searchDTO']->species;?>" name="species" type="text" class="input" placeholder="Species" />
    <input value="<?=$data['searchDTO']->type;?>" name="type" type="text" class="input" placeholder="Type" />

    <select name="status" id="status" class="select select-bordered">
        <option disabled>Select a status</option>
        <option value="" <?=$data['searchDTO']->status == '' ? 'selected' : '';?>>any</option>
        <option value="alive" <?=$data['searchDTO']->status == 'alive' ? 'selected' : '';?>>alive</option>
        <option value="dead" <?=$data['searchDTO']->status == 'dead' ? 'selected' : '';?>>dead</option>
        <option value="unknown" <?=$data['searchDTO']->status == 'unknown' ? 'selected' : '';?>>unknown</option>
    </select>

    <select name="gender" id="gender" class="select select-bordered">
        <option disabled>Select Gender</option>
        <option value="" <?=$data['searchDTO']->gender == '' ? 'selected' : '';?>>any</option>
        <option value="female" <?=$data['searchDTO']->gender == 'female' ? ' selected' : ''?>>female</option>
        <option value="male" <?=$data['searchDTO']->gender == 'male' ? ' selected' : ''?>>male</option>
        <option value="genderless" <?=$data['searchDTO']->gender == 'genderless' ? ' selected' : ''?>>genderless</option>
        <option value="unknown" <?=$data['searchDTO']->gender == 'unknown' ? ' selected' : ''?>>unknown</option>
    </select>

    <button id="search-button" class="btn btn-primary">Search</button>
</form>