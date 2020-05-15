<?php

if (!isset($_GET['id'])) {
    header('Location: index.php');
}

$id = (int)$_GET['id'];

include_once(__DIR__ . '/../src/API.php');

$errorMsg = false;
$charactersCount = 0;
$character = API::getCharacterById($id);

if (!isset($characters['error'])) {
    $charactersCount = $characters['info']['count'];
    $nextLink = $characters['info']['next'];
    $prevLink = $characters['info']['prev'];
    $result = $characters['results'];
} else {
    $errorMsg = $characters['error'];
}
?>

<?php include('parts/header.php'); ?>

<main role="main">

    <div class="album py-5 bg-light">
        <div class="container">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Back</a>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                        <?= $character['name']; ?>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <img src="<?= $character['image'] ?>"/>
                                    <ul>
                                        <li>Status: <?= $character['status']; ?></li>
                                        <li>Species: <?= $character['species']; ?></li>
                                        <li>Type: <?= $character['type']; ?></li>
                                        <li>gender: <?= $character['gender']; ?></li>
                                        <li>origin: <a
                                                    href="<?= $character['origin']['url']; ?>"><?= $character['origin']['name']; ?></a>
                                        </li>
                                        <li>location: <a
                                                    href="<?= $character['location']['url']; ?>"><?= $character['location']['name']; ?></a>
                                        </li>
                                        <li>created: <?= $character['created']; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                        Episode
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                 data-parent="#accordion">
                                <div class="card-body">

                                    <ul>
                                        <?php
                                        foreach ($character['episode'] as $item) {
                                            ?>
                                            <li><a href="<?= $item; ?>"><?= $item; ?></a></li>

                                            <?php

                                        }
                                        ?>

                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<?php include('parts/footer.php'); ?>

