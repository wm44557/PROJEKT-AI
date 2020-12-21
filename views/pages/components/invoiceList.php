<h1> Lista Faktur</h1>
<form action="" method="GET">
    <div>
        <label>Wyszukaj: <input type="text" name="search"  placeholder="Nr faktury.."/></label>
    </div>
    <input type="radio" name="MyRadio" value="First" checked>First<br> //This one is automatically checked when the user opens the page
    <input type="radio" name="MyRadio" value="Second">Second
    <input type="submit" value="Result" name="Result">
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

if($_GET) $search=$_GET['search'] ?? "";
else $search="";

for ($i = 1; $i <= $results['paginationInfo']; $i++) {
    echo " <a href='?page=" . $i . "&search=".$search."'>" . $i . "</a>";
}
?>

<br>
<br>
<br>
<a href="<?php echo STARTING_URL ?>">
    <button>Wróć</button>
</a>