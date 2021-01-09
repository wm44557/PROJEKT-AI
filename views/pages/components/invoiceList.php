<h1> Lista Faktur</h1>
<form action="" method="GET">
    <div>
        <label for="searchSelect">Wyszukaj po:</label>
        <select id="cars" name="searchSelect">
            <option value="id">Identyfikatorze własnym</option>
            <option value="invoice_number">Numerze faktury</option>
            <option value="vat_id">VAT ID kontrahenta</option>
            <option value="name">Nazwie kontrahenta</option>
        </select><br>
        Wyszukaj: <input type="text" name="search" value="<?php echo $_GET['search'] ?? ''?>"  placeholder="Invoice number.."/><br>
        <br>Przedział czasowy:<br>


        <input type="date" name="since_date" value="<?php echo $_GET['since_date'] ?>"/>
        <input type="date" name="to_date" value="<?php echo $_GET['to_date'] ?>"/>


        <br><br>


    </div>

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
        echo "<td> 
          <form method='POST'>
             <input type='hidden' value='$row->ID' name='invoiceId'/>
             <input class='submit' type='submit' value='Details'>
          </form>
        </td>";
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
    $since=$_GET['since_date'] ?? "";
    $to=$_GET['to_date'] ?? "";
}

for ($i = 1; $i <= $results['paginationInfo']; $i++) {
    echo " <a href='?page=" . $i . "&search=".$search."&since_date=".$since."&to_date=".$to."'>" . $i . "</a>";
}
?>

<br>
<br>
<br>
<a href="<?php echo STARTING_URL ?>">
    <button>Wróć</button>
</a>