

<a style="text-align: right" href="<?php echo STARTING_URL . '/' . $_SESSION['user_role']?>"><button class="button secondary small">Wróć</button></a>
<br><br>
<form class="form-box" method="post">
    <div class="form-info">
        <h2>Dane podstawowe:</h2>
        <p>Podstawowe dane dotyczące faktury.</p>
    </div>

    <div class="form-fields">

        <label class="form-input-label text">
            Numer faktury
            <input type="text" name="invoiceNumber" placeholder="Wprowadź numer faktury">
        </label>

        <label class="form-input-label text">
            Nazwa kontrahenta
            <input type="text" name="contractor" placeholder="Wprowadź nazwę kontrahenta">
        </label>

        <label class="form-input-label text">
            Vat ID kontrahenta
            <input type="text" name="contractorVatId" placeholder="Wprowadź vat id kontrahenta">
        </label>

        <label class="form-input-label text">
            Data wystawienia faktury
            <input type="date" name="dateInvoice" placeholder="Podaj datę wystawienia faktury">
        </label>

        <label class="form-input-label text">
            Typ faktury
            <input type="text" name="type" placeholder="Wprowadź typ">
        </label>
    </div>

    <div class="form-info">
        <h2>Licence:</h2>

    </div>
    <div class="form-fields">

        <label class="form-input-label text">
            <input type="text" name="sku" placeholder="Sku.." size="10">&nbsp;
        </label>

        <label class="form-input-label text">
            <input type="text" name="name" placeholder="Name licence..">
        </label>

        <label class="form-input-label text">
            <input type="text" name="description" placeholder="Description..">
        </label>

        <label class="form-input-label text">
            <input type="text" name="serialNumber" placeholder="serialNumber..">
        </label>

        <label class="form-input-label text">
            <input type="date" name="buyDate" placeholder="Date of purchase..">
        </label>

        <label class="form-input-label text">
            <input type="date" name="warranty" placeholder="Warranty to..">
        </label>&nbsp;

        <label class="form-input-label text">
            <input type="date" name="valid" placeholder="Valid to..">
        </label>&nbsp

        <label class="form-input-label text">
            <input type="text" name="owner" placeholder="Owner..">
        </label>
        <label class="form-input-label text">
            <input type="number" name="priceNetto" placeholder="Price (netto)..">
        </label>

        <label class="form-input-label text">
            <input type="number" name="vat" placeholder="Amount VAT..">
        </label>&nbsp;

        <label class="form-input-label text">
            <input type="number" name="priceBrutto" placeholder="Price (brutto)..">
        </label>
    </div>

    <div class="form-info">
        <h2>Podsumowanie</h2>
        <p>Informacje podsumowujące całą fakturę.</p>
    </div>

    <div class="form-fields">

        <label class="form-input-label text">
            Wartość netto
            <input type="number" name="sumNetto" placeholder="Wprowadź wartość netto">
        </label>

        <label class="form-input-label text">
            Vat
            <input type="number" name="sumVAT" placeholder="Wprowadź VAT">
        </label>

        <label class="form-input-label text">
            Wartość brutto
            <input type="number" name="sumBrutto" placeholder="Wprowadź wartość brutto">
        </label>
    </div>
    <input style="grid-column: span 2; justify-self: center; margin-top: 2rem;" class="button primary big" type="submit" value="Wyślij"><br>
</form>
<br>
