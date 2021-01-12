<h1> Lista Faktur</h1>
<form action="" method="GET">
    <div>
        <label for="searchSelect">Wyszukaj po:</label>
        <select name="searchSelect" onchange="changeSelector()" value="">
            <option value="id">Identyfikatorze własnym</option>
            <option value="invoice_number">Numerze faktury</option>
            <option value="vat_id">VAT ID kontrahenta</option>
            <option value="name">Nazwie kontrahenta</option>
        </select><br>
        Wyszukaj: <input type="text" class="form-input" name="search" value="<?php echo $_GET['search'] ?? ''?>"/><br>
        <br>Przedział czasowy:<br>


        <input type="date" name="since_date" value="<?php echo $_GET['since_date'] ?>"/>
        <input type="date" name="to_date" value="<?php echo $_GET['to_date'] ?>"/>
        <br><br>

    </div>
    <input type="radio" name="MyRadio" value="First" checked>Kupna<br>
    <input type="radio" name="MyRadio" value="Second">Sprzedaży

    <input type="submit" value="Szukaj.." name="Result">
</form>
<br>
<table>
    <thead>
    <tr>
        <th>Numer faktury</th>
        <th>Kontrahent</th>
        <th>NIP</th>
        <th>Data wystawienia faktury</th>
        <th>Cena Brutto</th>
        <th>Szczegóły</th>
    </tr>
    </thead>
    <tbody>
    <?php
    //dump($results);
    foreach ($results['elements'] as $row) {
        echo '<tr>';
        echo '<td>' . $row->invoice_number . '</td>';
        echo '<td>' . $row->name . '</td>';
        echo '<td>' . $row->vat_id . '</td>';
        echo '<td>' . $row->date_of_invoice . '</td>';
        echo '<td>' . $row->sum_brutto . '</td>';
        echo '<td><a href="'. STARTING_URL . '/' . $_SESSION['user_role'] . '/show-invoice?invoiceId=' . $row->ID . '"' . '>
            <button class="button primary small">Szczegóły</button>
        </a></td>';
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
    $since=$_GET['since_date'] ?? "";
    $to=$_GET['to_date'] ?? "";
}

for ($i = 1; $i <= $results['paginationInfo']; $i++) {
    echo " <a href='?page=" . $i . "&searchSelect=".$searchSelect. "&search=".$search."&since_date=".$since."&to_date=".$to."'>" . $i . "</a>";
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
        "Identyfikator własny",
        "Numer faktury",
        "Vat ID kontrahenta",
        "Nazwa kontrahenta",
    ]


    const selector = document.querySelector('select[name="searchSelect"]');

    function changeSelector(){
        const search = document.querySelector('input[name="search"]');
        search.placeholder = OPTIONS[selector.selectedIndex];
    }
    changeSelector();
</script>