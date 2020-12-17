<h1> Lista Faktur</h1>
<table>
    <thead>
    <tr>
        <th>Numer faktury</th>
        <th>Kontrahent</th>
        <th>NIP</th>
        <th>Data wystawienia faktury</th>
        <th>Cena NETTO</th>
    </tr>
    </thead>
    <tbody>
    <?php
    //dump($results);
    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . $row->invoice_number . '</td>';
        echo '<td>' . $row->name . '</td>';
        echo '<td>' . $row->vat_id . '</td>';
        echo '<td>' . $row->date_of_invoice . '</td>';
        echo '<td>' . $row->price_netto . '</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>
<br>
<a href="<?php echo STARTING_URL?>"><button>Wróć</button></a>