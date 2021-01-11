<h1>
    Szczegóły faktury
</h1>
<?php
foreach ($results['headerInvoice'] as $rowHeader) {
    echo '<b>Numer faktury:</b> ' . $rowHeader->invoice_number;
    echo '<br><br><b>Kontrahent:</b> ' . $rowHeader->name;
    echo '<br><br><b>NIP::</b> ' . $rowHeader->vat_id;
    echo '<br><br><b>Data wystawienia faktury:</b> ' . $rowHeader->date_of_invoice;
    echo '<br><br><b>Typ faktury:</b> ' . $rowHeader->type;
}
?>
<br>
<br>
<br>
<table>
    <thead>
    <tr>
        <th>Sku</th>
        <th>Nazwa licencji/uslugi</th>
        <th>Opis</th>
        <th>Numer seryjny</th>
        <th>Posiadacz</th>
        <th>Data zakupu</th>
        <th>Gwarancja</th>
        <th>Ważność</th>
        <th>Cena Netto</th>
        <th>Vat (%)</th>
        <th>Cena Brutto</th>
    </tr>
    </thead>
    <tbody>
    <?php
    //dump($results);
    foreach ($results['licenceData'] as $rowLicence) {
        echo '<tr>';
        echo '<td>' . $rowLicence->sku . '</td>';
        echo '<td>' . $rowLicence->name . '</td>';
        echo '<td>' . $rowLicence->description . '</td>';
        echo '<td>' . $rowLicence->serial_number . '</td>';
        echo '<td>' . $rowLicence->who_uses . '</td>';
        echo '<td>' . $rowLicence->buy_date . '</td>';
        echo '<td>' . $rowLicence->warranty_to . '</td>';
        echo '<td>' . $rowLicence->valid_to . '</td>';
        echo '<td>' . $rowLicence->price_netto . '</td>';
        echo '<td>' . $rowLicence->vat . '</td>';
        echo '<td>' . $rowLicence->price_brutto . '</td>';

        echo '</tr>';
    }


    ?>
    </tbody>
</table>
<br><br>

<?php
foreach ($results['headerInvoice'] as $rowHeader) {
    echo '<b>Suma netto:</b> ' . $rowHeader->sum_netto;
    echo '<br><br><b>Suma podatku VAT:</b> ' . $rowHeader->sum_vat;
    echo '<br><br><b>Suma brutto:</b> ' . $rowHeader->sum_brutto;
}
?>
<br>
<a href="<?php echo STARTING_URL?>/admin/list-invoice"><button>Wroc</button></a>

<br>

<h3>Pliki</h3>
<table>
    <thead>
        <th>Nazwa pliku</th>
        <th>Dodano</th>
        <th>Opis</th>
    </thead>
    <tbody>
    <?php foreach ($files as $file): ?>
        <tr>
            <td><a target="_blank" href="<?php echo STARTING_URL . '/media/' . $dirpath . '/' . $file->name; ?>"><?= $file->name?></a></td>
            <td><?= $file->added_at?></td>
            <td><?= $file->description?></td>
            <td>
                <form action="deletefile" method="post" onsubmit="return confirm('Czy chcesz usunąc ten plik?');">
                    <input type="hidden" name="fileId" value="<?= $file->id?>">
                    <input type="hidden" name="fileName" value="<?= $file->name; ?>">
                    <input type="hidden" name="invoiceId" value="<?= $invoiceId; ?>">
                    <input type="submit" class="button secondary small" value="Usun">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<form action="addfile" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="text" placeholder="Opis" name="description">
    <input type="hidden" name="invoiceId" value="<?php echo $invoiceId; ?>">
    <input type="submit" class="button primary small" value="Dodaj plik" name="addfile">
</form>



