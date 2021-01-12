<a class="toright" href="<?php echo STARTING_URL . '/' . $_SESSION['user_role'] . '/list-invoice'?>"><button class="button secondary small back">Wróć</button></a>

<div class="box">
    <h1>
        Szczegóły faktury
    </h1>
    <br>

    <div class="info line-bottom">
        <?php
        foreach ($results['headerInvoice'] as $rowHeader) {
            echo '<p><b>Numer faktury:</b> ' . $rowHeader->invoice_number . '</p>';
            echo '<p><b>Kontrahent:</b> ' . $rowHeader->name . '</p>';
            echo '<p><b>NIP:</b> ' . $rowHeader->vat_id . '</p>';
            echo '<p><b>Data wystawienia faktury:</b> ' . $rowHeader->date_of_invoice . '</p>';
            echo '<p><b>Typ faktury:</b> ' . $rowHeader->type . '</p>';
        }
        ?>
    </div>

    <br>
    <br>

    <div class="form-table-container">
        <h2>Licencje</h2>
        <p>Spis licencji przypisanych do faktury</p>
        <div class="table-container">
            <table class="form-table align">
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
        </div>
    </div>


    <div class="form-table-container">
        <h2>Sprzęty</h2>
        <p>Spis sprzętów przypisanych do faktury</p>
        <div class="table-container">
            <table class="form-table align">
                <thead>
                <tr>
                    <th>Sku</th>
                    <th>Nazwa sprzętu</th>
                    <th>Opis</th>
                    <th>Numer seryjny</th>
                    <th>Posiadacz</th>
                    <th>Data zakupu</th>
                    <th>Gwarancja</th>
                    <th>Cena Netto</th>
                    <th>Vat (%)</th>
                    <th>Cena Brutto</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //dump($results);
                foreach ($results['equipementData'] as $rowEquipement) {
                    echo '<tr>';
                    echo '<td>' . $rowEquipement->sku . '</td>';
                    echo '<td>' . $rowEquipement->name . '</td>';
                    echo '<td>' . $rowEquipement->description . '</td>';
                    echo '<td>' . $rowEquipement->serial_number . '</td>';
                    echo '<td>' . $rowEquipement->who_uses . '</td>';
                    echo '<td>' . $rowEquipement->buy_date . '</td>';
                    echo '<td>' . $rowEquipement->warranty_to . '</td>';
                    echo '<td>' . $rowEquipement->price_netto . '</td>';
                    echo '<td>' . $rowEquipement->vat . '</td>';
                    echo '<td>' . $rowEquipement->price_brutto . '</td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="form-table-container">
        <h2>Dokumenty</h2>
        <p>Dokumenty przypisane do faktury</p>
        <table class="form-table">
            <thead>
            <th>Nazwa pliku</th>
            <th>Dodano</th>
            <th>Opis</th>
            <th></th>
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
        <br><br>
        <form action="addfile" method="post" enctype="multipart/form-data" class="small-form">
            <input type="file" name="file">
            <label class="form-input-label input">
                Opis
                <input type="text" placeholder="Wpisz opis do pliku" name="description">
            </label>
            <input type="hidden" name="invoiceId" value="<?php echo $invoiceId; ?>">
            <input type="submit" class="button primary small" value="Dodaj plik" name="addfile">
        </form>
    </div>

    <div class="info">
        <?php
        foreach ($results['headerInvoice'] as $rowHeader) {
            echo '<p><b>Suma netto:</b> ' . $rowHeader->sum_netto . '</p>';
            echo '<p><b>Suma podatku VAT:</b> ' . $rowHeader->sum_vat . '</p>';
            echo '<p><b>Suma brutto:</b> ' . $rowHeader->sum_brutto . '</p>';
        }
        ?>
    </div>





</div>




