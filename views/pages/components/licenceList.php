<h1>Moje licencje</h1>
<form action="" method="GET">
    <div>
        <label for="searchSelect">Wyszukaj po:</label>
        <select name="searchSelect" onchange="changeSelector()">
            <option value="sku">Numer inwentarzowy</option>
            <option value="serial_number">Klucz seryjny</option>
        </select><br>
        Wyszukaj: <input type="text" class="form-input" name="search" value="<?php echo $_GET['search'] ?? ''?>" ><br>

    </div>
    <input type="submit" value="Szukaj.." name="Result">
</form>
<br>
<table>
    <thead>
    <tr>
        <th>Numer inwentarzowy</th>
        <th>Klucz seryjny</th>
        <th>Nazwa</th>
        <th>Opis</th>
        <th>Ważne do</th>
        <th>Cena Netto</th>
        <th>Użytkownik</th>
        <th>Numer faktury</th>

    </tr>
    </thead>
    <tbody>
    <?php

    foreach ($results['elements'] as $row) {
        echo '<tr>';
        echo '<td>' . $row->sku . '</td>';
        echo '<td>' . $row->serial_number . '</td>';
        echo '<td>' . $row->name . '</td>';
        echo '<td>' . $row->description . '</td>';
        echo '<td>' . $row->warranty_to . '</td>';
        echo '<td>' . $row->price_netto . '</td>';
        echo '<td>' . $row->who_uses . '</td>';
        echo '<td>' . $row->invoice_number . '</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>
<br>



<h5>Paginacja <br></h5>
<?php


if($_GET) {
    $search = $_GET['search'] ?? "";
    $searchSelect = $_GET['searchSelect'] ?? "";
}

for ($i = 1; $i <= $results['paginationInfo']; $i++) {
    echo " <a href='?page=" . $i . "&searchSelect=".$searchSelect. "&search=".$search."'>" . $i . "</a>";

}
?>

<br>
<br>
<br>
<a href="<?php echo STARTING_URL ?>">
    <button>Wróć</button>
</a>


<script>
    const OPTIONS = [
        "Numer inwentarzowy",
        "Klucz seryjny",
    ]

    const selector = document.querySelector('select[name="searchSelect"]');

    function changeSelector(){
        const search = document.querySelector('input[name="search"]');
        search.placeholder = OPTIONS[selector.selectedIndex];
    }
    changeSelector();
</script>
