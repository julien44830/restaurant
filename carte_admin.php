<?php
if (isset($_POST['delete_menu'])) {
    $id = $_POST['menu_id'];
    $sql = "DELETE FROM carte_menu WHERE id = '$id'";
    $conn->query($sql);
}

if (isset($_POST['delete_plat'])) {
    $id = $_POST['plat_id'];
    $sql = "DELETE FROM carte_plat WHERE id = '$id'";
    $conn->query($sql);
}

$sql_menu = "SELECT * FROM carte_menu";
$result_menu = $conn->query($sql_menu);

$sql_plat = "SELECT * FROM carte_plat";
$result_plat = $conn->query($sql_plat);
?>

<div class="container">
    <h2>Ajouter un menu</h2>
    <form method="POST" action="traitement_carte.php" >
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" name="nom" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="text" class="form-control" name="prix" required>
        </div>
        <button type="submit" name="add_menu" class="btn btn-primary">Ajouter</button>
    </form>
    
    <hr>
    
    <h2>Menus existants</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_menu->num_rows > 0) {
                while($row = $result_menu->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['nom'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>' . $row['prix'] . '€</td>';
                    echo '<td>';
                    echo '<form method="POST">';
                    echo '<input type="hidden" name="menu_id" value="' . $row['id'] . '">';
                    echo '<button type="submit" name="delete_menu" class="btn btn-danger">Supprimer</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>

    <hr>

    <h2>Ajouter un plat</h2>
    <form method="POST" action="traitement_carte.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" name="nom" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" required>
        </div>
        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="text" class="form-control" name="prix" required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" name="image">
        </div>
        <button type="submit" name="add_plat" class="btn btn-primary">Ajouter</button>
    </form>





        <h2>Menus existants</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
if ($result_plat->num_rows > 0) {
    while($row = $result_plat->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['nom'] . '</td>';
        echo '<td>' . $row['description'] . '</td>';
        echo '<td>' . $row['prix'] . '€</td>';
        echo '<td><img src="assets/img/' . $row['image'] . '" class="img-thumbnail img-fluid max-width-1" style="max-width : 100px"></td>';
        echo '<td>';
        echo '<form method="POST">';
        echo '<input type="hidden" name="plat_id" value="' . $row['id'] . '">';
        echo '<button type="submit" name="delete_plat" class="btn btn-danger">Supprimer</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
}
?>

        </tbody>
    </table>



