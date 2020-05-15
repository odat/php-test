<?php
include_once(__DIR__ . '/../src/API.php');

$errorMsg = false;
$charactersCount = 0;
$characters = API::getCharacters($_GET);

if(!isset($characters['error']))
{
    $charactersCount = $characters['info']['count'];
    $nextLink = $characters['info']['next'];
    $prevLink = $characters['info']['prev'];
    $result = $characters['results'];
}else{
    $errorMsg = $characters['error'];
}
?>
<?php include('parts/header.php');?>
<main role="main">

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row">
                <div class="col-md-12">


                    <div class="card">
                        <div class="card-body">

                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputName">Name</label>
                                        <input type="text" class="form-control" id="inputName" placeholder="name" name="name" value="<?=(isset($_GET['name']) ? $_GET['name'] : '')?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">species</label>
                                        <input type="text" class="form-control" id="species"
                                               placeholder="species" name="species" <?=(isset($_GET['species']) ? $_GET['species'] : '')?>>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputState">State</label>
                                        <select id="inputState" class="form-control" name="status">
                                            <option value="" selected>Choose...</option>
                                            <option value="alive" <?=(isset($_GET['status']) && $_GET['status'] == 'alive' ? 'selected' : '')?>>Alive</option>
                                            <option value="dead" <?=(isset($_GET['status']) && $_GET['status'] == 'dead' ? 'selected' : '')?>>Dead</option>
                                            <option value="unknown" <?=(isset($_GET['status']) && $_GET['status'] == 'unknown' ? 'selected' : '')?>>Unknown</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputGender">Gender</label>
                                        <select id="inputGender" class="form-control" name="gender">
                                            <option value="" selected>Choose...</option>
                                            <option value="female" <?=(isset($_GET['gender']) && $_GET['gender'] == 'female' ? 'selected' : '')?>>Female</option>
                                            <option value="male" <?=(isset($_GET['gender']) && $_GET['gender'] == 'male' ? 'selected' : '')?>>Male</option>
                                            <option value="genderless" <?=(isset($_GET['gender']) && $_GET['gender'] == 'genderless' ? 'selected' : '')?>>Genderless</option>
                                            <option value="unknown" <?=(isset($_GET['gender']) && $_GET['gender'] == 'unknown' ? 'selected' : '')?>>Unknown</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputType">Type</label>
                                        <input type="text" class="form-control" id="inputType" name="type" <?=(isset($_GET['type']) ? $_GET['type'] : '')?>>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a class="btn btn-secondary" href="?">reset</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <br/>
            Result : <?=$charactersCount?>
            <div class="row">
                <?php
                if(!$errorMsg) {
                    foreach ($result as $item) {
                        ?>
                        <div class="col-md-3">
                            <div class="card mb-3 box-shadow">
                                <img class="card-img-top"
                                     src="<?= $item['image'] ?>"
                                     data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail"
                                     alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="character.php?id=<?= $item['id'] ?>"
                                           class="card-link"><?= $item['name'] ?></a>
                                    </h5>
                                    <p class="card-text">
                                    <ul>
                                        <li>Species: <?= $item['species'] ?></li>
                                        <li>Origin: <?= $item['origin']['name'] ?></li>
                                        <li>First seen in: <?= $item['firstSeenIn'] ?></li>
                                    </ul>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                        </div>
                                        <small class="text-muted"><span
                                                    class="status <?= $item['status'] ?>"></span><?= $item['status'] ?>
                                            - <?= $item['species'] ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }else
                {
                    ?>
                    <div class="col-md-12 alert alert-info" role="alert">
                    <?=$errorMsg?>
                    </div>
                <?php
                }
                ?>
            </div>

            <?php
            if(!$errorMsg && $charactersCount > 20) {
                ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item <?= (is_null($prevLink) ? 'disabled' : '') ?>">
                            <a class="page-link"
                               href="?page=<?= str_replace('https://rickandmortyapi.com/api/character/?page=', '', $prevLink) ?>"
                               tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link"
                               href="?page=<?= str_replace('https://rickandmortyapi.com/api/character/?page=', '', $nextLink) ?>">Next</a>
                        </li>
                    </ul>
                </nav>
                <?php
            }
            ?>
        </div>
    </div>

</main>
<?php
include('parts/footer.php');?>
